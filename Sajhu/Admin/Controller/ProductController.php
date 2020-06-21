<?php

namespace Module\Admin\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Admin\Models\Product;
use Module\Admin\Models\ProductImage;
use Module\Admin\Requests\ProductRequest;
use Module\Admin\Services\BrandServices;
use Module\Admin\Services\CategoryServices;
use AppHelper;
use Module\Admin\Services\ProductServices;
use DB;

class ProductController extends Controller
{
    private $module = 'Admin::';
    private $viewPath = 'Admin::product';
    private $title = 'Product';
    private $baseRoute = 'admin.product';
    private $productServices;
    private $categoryServices;
    private $brandServices;

    public function __construct(
        ProductServices $productServices,
        CategoryServices $categoryServices,
        BrandServices $brandServices
    )
    {

        AppHelper::setModule($this->module);
        AppHelper::setViewPath($this->viewPath);
        AppHelper::setTitle($this->title);
        AppHelper::setBaseRoute($this->baseRoute);
        $this->productServices = $productServices;
        $this->categoryServices = $categoryServices;
        $this->brandServices = $brandServices;

    }

    public function index()
    {
        $products = $this->productServices->allDatas();
        return view(AppHelper::getViewPath('index'), compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryServices->getAllChildCategory();
        $brands = $this->brandServices->getDatas();
        return view(AppHelper::getViewPath('create'), compact('categories', 'brands'));
    }

    public function store(ProductRequest $request)
    {
        dd(request()->all());
        $data = $request->except('_token', 'images');
        $images = $request->images;
        $data['main_product_image'] = $request->main_product_image;
        $success = Product::Create($data);

        if (isset($images)) {
            foreach ($images as $key => $image) {
                $is_main = 0;
                if ($image == $data['main_product_image']) {
                    $is_main = 1;
                }
                DB::table('product_images')->insert([
                    'product_id' => $success->id,
                    'image' => $image,
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d'),
                    'is_main' => $is_main
                ]);
            }
            //$get_cover_id = DB::table('tbl_villa_images')->where('villa_id',$success->id)->where('is_cover',1)->first();
        }
//        if(isset($get_cover_id)){
//            Villa::where('id',$success->id)->update(['cover_id'=>$get_cover_id->id]);
//        }
        // $result = $this->productServices->create($request);
        return AppHelper::returnBack($success);
    }

    public function show(Product $product)
    {
        $folderPath = 'upload/product';
        return view(AppHelper::getViewPath('detail'), compact('product', 'folderPath'));
    }

    public function edit(Product $product)
    {
        $categories = $this->categoryServices->getDatas();
        $product = Product::where('id',$product->id)->with('images')->first();
        $product_images =ProductImage::where('product_id',$product->id)->get();
        return view(AppHelper::getViewPath('edit'), compact('product', 'categories','product_images'));
    }

    public function update(ProductRequest $request, Product $product)
    {
//        dd(request()->all());
        $data = $request->except('_token', 'images','_method','uploader_count','deleted_image');
        $images = $request->images;
        $main_product_image = $request->main_product_image;
        $deleted_image = $request->deleted_image;
        $all_image_stored = DB::table('product_images')->where('product_id',$product->id)->get();
        $image_collection = array();
        foreach($all_image_stored as $key => $value){
            $image_collection[] = $value->image;
        }

        foreach ($deleted_image as $ke => $val) {
            if(in_array($val, $image_collection)){
                DB::table('product_images')->where('product_id',$product->id)->where('image',$val)->delete();
            }
        }

        if(isset($images)){
            foreach ($images as $k => $v) {
                $is_main = 0;
                if($v == $main_product_image){
                    $is_main = 1;
                }
                if(in_array($v, $image_collection)){
                    DB::table('product_images')
                        ->where('product_id',$product->id)
                        ->where('image',$v)
                        ->update(['is_main'=>$is_main]);
                }
                else{
                    DB::table('product_images')->insert([
                        'product_id' =>$product->id,
                        'image' => $v,
                        'created_at'=>now(),
                        'updated_at'=>now(),
                        'is_main' => $is_main,
                    ]);
                }
            }
        }
        $success = Product::where('id',$product->id)->update($data);
        return AppHelper::returnBack(true);
    }

    public function destroy($id)
    {
        $this->productServices->id = $id;
        $result = $this->productServices->delete();
        return AppHelper::returnBack($result);
    }

    public function attribute($id)
    {
        $this->categoryServices->id = $id;
        $category = $this->categoryServices->find();
        if ($category->have_child == 1) {
//            dd('categhories',$category->child);
            $html = view('Admin::product.ajax_request.category', ['categories' => $category->child,'uid'=>$id])->render();
        } else {
//            dd('attributes',$category->attributes);
            $html = view('Admin::product.ajax_request.attribute', ['attributes' => $category->attributes,'unit' => $category->unit])->render();
        }

        return response()->json($html, 200);
    }

    public function storeImage(Request $request)
    {
        if (!ini_get('date.timezone')) {
            date_default_timezone_set('GMT');
        }
        // Make sure file is not cached (as it happens for example on iOS devices)
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        // 5 minutes execution time
        @set_time_limit(5 * 60);

        // Uncomment this one to fake upload time
        // usleep(5000);

        // Settings
        $targetDir = public_path('storage/images/products');
        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        // Create target dir
        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }
        // Get a file name
        if ($request->input('name')) {
            $fileName = $request->input('name');
        } elseif (!empty($_FILES)) {
            $fileName = $request->image->getClientOriginalName();
        } else {
            $fileName = uniqid("file_");
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

        // Chunking might be enabled
        $chunk = $request->input("chunk") ? intval($request->input("chunk")) : 0;
        $chunks = $request->input("chunks") ? intval($request->input("chunks")) : 0;


        // Remove old temp files
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                $data = '{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}';
            }

            while (($file = readdir($dir)) !== false) {

                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}.part") {

                    continue;
                }

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }


        // Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
            $data = '{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}';
        }
        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                $data = '{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}';
            }

            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                $data = '{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}';
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                $data = '{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}';
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off
            rename("{$filePath}.part", $filePath);
        }

        echo json_encode(array('filename' => $fileName));
    }

    public function deleteImage(Request $request)
    {
//        dd($request->all());
        $data = $request->except('_token');
        // dd($data);
        $targetDir = public_path('storage/images/products');
        if ($data['status'] == 0) {
            @unlink($targetDir . '/' . $data['image']);

            $success = TRUE;
        }

        if ($data['status'] == 1) {
            @unlink($targetDir . '/' . $data['image']);
            $page = Process::findOrFail($data['id']);
            $images = json_decode($page->images, TRUE);
            foreach ($images as $key => $value) {
                if ($value['image'] == $data['image'])
                    unset($images[$key]);
            }
            $page->images = json_encode($images);
            $page->save();
            $success = TRUE;
        }
        echo json_encode(array('success' => $success));
    }

}

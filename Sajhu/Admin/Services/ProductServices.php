<?php

namespace Module\Admin\Services;


use Module\Admin\Models\Product;
use Module\Admin\Repository\ProductImageRepository;
use Module\Admin\Repository\ProductRepository;
use AppHelper, ImageHelper;

class ProductServices
{

    private $productRepository;
    private $productImageRepository;
    public $id;
    private $idResult;

    public function __construct(ProductRepository $productRepository, ProductImageRepository $productImageRepository)
    {
        $this->productRepository = $productRepository;
        $this->productImageRepository = $productImageRepository;
    }

    public function allDatas()
    {
        return $this->productRepository->all();
    }

    public function getDatas()
    {
        return $this->productRepository->getBy('vendor_id', auth()->id());
    }

    public function create($request)
    {
        try {
            $product = $this->productRepository->store($this->fillable($request));
//            foreach ($request->back_image as $image) {
//                $this->productImageRepository->store([
//                    //'product_id' => $product->id,
//                  //  'image' => $this->imageUpload($image)
//                ]);
//            }
            return AppHelper::createMessage();
        } catch (\Exception $e) {
            dd($e);
            return serverErrorMessage();
        }
    }

    public function update($request)
    {
        try {

//            $this->checkData();
            if ($this->idResult) {
                return notFoundErrorMessage();
            }
            $product = Product::find($this->id);
            $arr = $request->all();
            unset($arr['main_product_image']);
            $product->update($arr);
//            $this->productRepository->update($this->id, $this->fillable($request));
            return AppHelper::updateMessage();
        } catch (\Exception $e) {
            dd($e);
            return serverErrorMessage();
        }
    }

    public function delete()
    {
        try {

//            $this->checkData();
            if ($this->idResult) {
                return notFoundErrorMessage();
            }

            $this->productRepository->delete($this->id);
            return AppHelper::deleteMessage();
        } catch (\Exception $e) {
            return serverErrorMessage();
        }
    }

    public function fillable($request):array
    {
        $all = $request->except(['status', 'in_stock']);
        //$all['product_id'] = str_pad(mt_rand(0, 999999), 4, '0', STR_PAD_LEFT);
//        $all['main_product_image'] = $this->imageUpload($all['main_product_image']);
        $all['vendor_id'] = auth('vendor')->id();
        return $all;
    }

    public function imageUpload($image):string
    {
        ImageHelper::folder('product', ['100_100', '500_500']);
        return ImageHelper::saveImage($image);
    }

    public function deleteImage($image)
    {
        ImageHelper::folder('product', ['100_100', '500_500']);
        ImageHelper::deleteImage($image);
    }

    public function checkData()
    {
        if ($this->productRepository->find($this->id)) {
            $this->idResult = true;
        } else {
            $this->idResult = false;
        }
    }

}

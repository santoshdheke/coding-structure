<?php

namespace Module\Admin\Services;


use App\Models\Vendor;
use Illuminate\Http\Request;
use Module\Admin\Repository\VendorRepository;
use AppHelper;

class VendorServices
{

    /**
     * @var VendorRepository
     */
    private $vendorRepository;

    /**
     * VendorServices constructor.
     * @param VendorRepository $vendorRepository
     */
    public function __construct(VendorRepository $vendorRepository)
    {
        $this->vendorRepository = $vendorRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getDatas()
    {
        return $this->vendorRepository->all();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create($request):array
    {
        try {
            $user = $this->vendorRepository->store($this->fillable($request));
            sendEmail('mails.vendor_register', $this->emailData($user));
            return AppHelper::createMessage();
        } catch (\Exception $e) {
            dd($e);
            return serverErrorMessage();
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function fillable($request):array
    {

        $all = $request->only(['first_name', 'last_name', 'middle_name', 'email', 'phone_no' , 'company_name',
        'company_phone_no', 'address', 'mobile_no', 'company_pan_no', 'status','logo']);
        if(isset($all['logo'])){
            $all['logo'] =$all['logo']->store('public/images/vendor/logo');
        }
        $all['username'] = explode('@', $request->email)[0] . rand(111, 999);
        $all['password'] = rand(111111, 999999);
        $all['token'] = uniqid(rand(1111, 99999));
        return $all;
    }

    /**
     * @param Vendor $user
     * @return array
     */
    public function emailData($user):array
    {
        return [
            'email' => $user->email,
            'token' => $user->token,
            'subject' => 'Create Vendor at Omlot Ecommerce'
        ];
    }

}

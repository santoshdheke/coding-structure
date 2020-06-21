<?php

namespace Module\Admin\Repository;

use Module\Vendor\Models\Vendor;
use SsGroup\Repo\Repository;

class VendorRepository extends Repository
{

    /**
     * @return Vendor mixed
     */
    public function getModel()
    {
        return Vendor::class;
    }
}

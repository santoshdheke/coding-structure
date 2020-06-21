<?php

namespace Module\Admin\Repository;

use Module\Admin\Models\Brand;
use SsGroup\Repo\Repository;

class BrandRepository extends Repository
{

    /**
     * @return Brand mixed
     */
    public function getModel()
    {
        return Brand::class;
    }
}

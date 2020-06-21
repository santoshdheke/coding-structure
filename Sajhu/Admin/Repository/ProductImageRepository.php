<?php

namespace Module\Admin\Repository;

use Module\Admin\Models\ProductImage;
use SsGroup\Repo\Repository;

class ProductImageRepository extends Repository
{

    /**
     * @return ProductImage mixed
     */
    public function getModel()
    {
        return ProductImage::class;
    }
}

<?php

namespace Module\Admin\Repository;

use Module\Admin\Models\Product;
use SsGroup\Repo\Repository;

class ProductRepository extends Repository
{

    /**
     * @return Product mixed
     */
    public function getModel()
    {
        return Product::class;
    }
}

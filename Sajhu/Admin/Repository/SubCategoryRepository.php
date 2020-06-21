<?php

namespace Module\Admin\Repository;

use Module\Admin\Models\SubCategory;
use SsGroup\Repo\Repository;

class SubCategoryRepository extends Repository
{

    /**
     * @return SubCategory mixed
     */
    public function getModel()
    {
        return SubCategory::class;
    }
}

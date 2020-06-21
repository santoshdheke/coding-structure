<?php

namespace Module\Admin\Repository;

use Module\Admin\Models\MiniSubCategory;
use SsGroup\Repo\Repository;

class MiniSubCategoryRepository extends Repository
{

    /**
     * @return MiniSubCategory mixed
     */
    public function getModel()
    {
        return MiniSubCategory::class;
    }
}

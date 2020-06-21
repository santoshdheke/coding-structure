<?php

namespace Module\Admin\Repository;

use Module\Admin\Models\Category;
use SsGroup\Repo\Repository;

class CategoryRepository extends Repository
{

    /**
     * @return Category mixed
     */
    public function getModel()
    {
        return Category::class;
    }
}

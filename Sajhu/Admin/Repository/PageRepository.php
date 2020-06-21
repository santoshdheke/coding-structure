<?php

namespace Module\Admin\Repository;

use Module\Admin\Models\Page;
use SsGroup\Repo\Repository;

class PageRepository extends Repository
{

    /**
     * @return Page mixed
     */
    public function getModel()
    {
        return Page::class;
    }
}

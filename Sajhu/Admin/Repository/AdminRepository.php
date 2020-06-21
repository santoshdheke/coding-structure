<?php

namespace Module\Admin\Repository;

use Module\Admin\Models\Admin;
use SsGroup\Repo\Repository;

class AdminRepository extends Repository
{
    /**
     * @return Admin mixed
     */
    public function getModel()
    {
        return Admin::class;
    }
}

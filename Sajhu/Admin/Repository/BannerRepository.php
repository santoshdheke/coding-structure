<?php

namespace Module\Admin\Repository;

use Module\Admin\Models\Banner;
use SsGroup\Repo\Repository;

class BannerRepository extends Repository
{

    /**
     * @return Banner mixed
     */
    public function getModel()
    {
        return Banner::class;
    }
}

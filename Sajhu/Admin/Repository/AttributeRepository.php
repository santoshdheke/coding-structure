<?php

namespace Module\Admin\Repository;

use Module\Admin\Models\Attribute;
use SsGroup\Repo\Repository;

class AttributeRepository extends Repository
{

    /**
     * @return Attribute mixed
     */
    public function getModel()
    {
        return Attribute::class;
    }
}

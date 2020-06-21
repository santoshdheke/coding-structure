<?php

namespace Module\Admin\Repository;

use Module\Admin\Models\Currency;
use SsGroup\Repo\Repository;

class CurrencyRepository extends Repository
{

    /**
     * @return Currency mixed
     */
    public function getModel()
    {
        return Currency::class;
    }
}

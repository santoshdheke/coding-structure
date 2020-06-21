<?php

namespace Module\Admin\Repository;

use Module\Admin\Models\Language;
use SsGroup\Repo\Repository;

class LanguageRepository extends Repository
{

    /**
     * @return Language mixed
     */
    public function getModel()
    {
        return Language::class;
    }
}

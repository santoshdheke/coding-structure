<?php

namespace Module\Admin\Repository;

use Module\Admin\Models\Measurement;
use SsGroup\Repo\Repository;

class MeasurementRepository extends Repository
{

    /**
     * @return Measurement mixed
     */
    public function getModel()
    {
        return Measurement::class;
    }
}

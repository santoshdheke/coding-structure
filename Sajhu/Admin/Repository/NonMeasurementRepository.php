<?php

namespace Module\Admin\Repository;

use Module\Admin\Models\NonMeasurement;
use SsGroup\Repo\Repository;

class NonMeasurementRepository extends Repository
{

    /**
     * @return NonMeasurement mixed
     */
    public function getModel()
    {
        return NonMeasurement::class;
    }
}

<?php

namespace Module\Admin\Rules;

use Illuminate\Contracts\Validation\Rule;
use Module\Admin\Models\NonMeasurement;

class ParentMeasurementCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $result = $this->parentCheck();
        return $result;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid :attribute.';
    }

    public function parentCheck()
    {
        $allAttributes = NonMeasurement::where('parent_id',0)->pluck('id')->toarray();
        array_push($allAttributes, 0);
        if (isset($allAttributes) && count($allAttributes)>0 && !in_array(request()->parent_id, $allAttributes)) {
            return false;
        }
        return true;
    }
}

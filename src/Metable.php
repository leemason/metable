<?php

namespace LeeMason\Metable;

use Illuminate\Support\Collection;

trait Metable
{
    /**
     * Handles formatting the model value when in use.
     *
     * @param $value
     * @return Collection|mixed
     */
    public function getValueAttribute($value)
    {
        return $this->getValue($value);
    }

    /**
     * Handles setting the 'type' attribute based on the incoming value type.
     *
     * @param $value
     */
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = $this->setValue($value);
    }

    /**
     * Internal function utilized by setValueAttribute to find the value type and set the attribute accordingly.
     *
     * @param $value
     * @return bool|float|int|string
     */
    private function setValue($value)
    {
        switch (gettype($value)) {
            case 'int':
            case 'integer':
                $this->attributes['type'] = 'int';

                return (int) $value;
            case 'real':
            case 'float':
            case 'double':
                $this->attributes['type'] = 'float';

                return (float) $value;
            case 'bool':
            case 'boolean':
                $this->attributes['type'] = 'bool';

                return (bool) $value;
            case 'object':
                if ($value instanceof Collection) {
                    $this->attributes['type'] = 'collection';

                    return json_encode($value);
                }
                $this->attributes['type'] = 'object';

                return json_encode($value);
            case 'array':
                $this->attributes['type'] = 'array';

                return json_encode($value);
            default:
                $this->attributes['type'] = 'string';

                return $value;
        }
    }

    /**
     * Internal function utilized by getValueAttribute to get raw results from the db and format as they were set during insertion.
     *
     * @param $value
     * @return bool|float|Collection|int|mixed
     */
    private function getValue($value)
    {
        switch ($this->attributes['type']) {
            case 'int':
            case 'integer':
                return (int) $value;
            case 'real':
            case 'float':
            case 'double':
                return (float) $value;
            case 'bool':
            case 'boolean':
                return (bool) $value;
            case 'collection':
                return new Collection(json_decode($value, true));
            case 'object':
                return json_decode($value);
            case 'array':
                return json_decode($value, true);
            default:
                return $value;
        }
    }
}

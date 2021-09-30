<?php

namespace App\Traits;

trait MapStd
{
    /**
     * Convert User model from array to stdClass
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @param [type] $std
     * @param array $fill
     * @param boolean $exists
     * @return Object
     */
    public static function mapStd($std, $fill = ['*'], $exists = true)
    {
        if (get_class($std) == 'App\Models\User') {
            return $std;
        }

        $instance = new static;

        $values = ($fill == ['*'])
            ? (array) $std
            : array_intersect_key( (array) $std, array_flip($fill));

        // fill attributes and original arrays
        $instance->setRawAttributes($values, true);

        $instance->exists = $exists;

        return $instance;
    }
}

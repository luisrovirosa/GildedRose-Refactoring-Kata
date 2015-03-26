<?php

namespace LuisRovirosa\GildedRose\Rules;

/**
 * Description of Default
 *
 * @author Luis Rovirosa <luisrovirosa@gmail.com>
 */
class DefaultRule extends BaseRule
{

    const DECREASE_AT_NORMAL_SPEED = -1;
    const DECREASE_AT_DOUBLE_SPEED = -2;

    protected function getQualityIncrement($item)
    {
        if ($this->isExpired($item)) {
            return self::DECREASE_AT_DOUBLE_SPEED;
        } else {
            return self::DECREASE_AT_NORMAL_SPEED;
        }
    }

    public function match($item)
    {
        return true;
    }
}

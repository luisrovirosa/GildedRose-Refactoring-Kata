<?php

namespace LuisRovirosa\GildedRose\Rules;

/**
 * Description of Backstage
 *
 * @author Luis Rovirosa <luisrovirosa@gmail.com>
 */
class Backstage extends BaseRule
{

    const INCREASE_QUALITY_BY_1 = 1;
    const INCREASE_QUALITY_BY_2 = 2;
    const INCREASE_QUALITY_BY_3 = 3;

    const LESS_THAN_0_DAYS = -99999999999999999999999999999;
    const MORE_THAN_0_DAYS = 0;
    const MORE_THAN_5_DAYS = 5;
    const MORE_THAN_10_DAYS = 10;

    public function match($item)
    {
        return $item->name == 'Backstage passes to a TAFKAL80ETC concert';
    }

    protected function getQualityIncrement($item)
    {
        $increaseQualityByDays = array(
            self::MORE_THAN_10_DAYS => self::INCREASE_QUALITY_BY_1,
            self::MORE_THAN_5_DAYS => self::INCREASE_QUALITY_BY_2,
            self::MORE_THAN_0_DAYS => self::INCREASE_QUALITY_BY_3,
            self::LESS_THAN_0_DAYS => -$item->quality,
        );

        foreach ($increaseQualityByDays as $days => $qualityIncreasedBy) {
            if ($this->expireInMoreThanOrEquals($item, $days)) {
                return $qualityIncreasedBy;
            }
        }
    }

    /**
     * @param $item
     * @param $days
     * @return bool
     */
    protected function expireInMoreThanOrEquals($item, $days)
    {
        return $item->sell_in >= $days;
    }
}

<?php

namespace LuisRovirosa\GildedRose\Test;

class AgedBrieTest extends GildedRoseTest
{
    /**
     * @dataProvider typeOfDays
     * @test
     */
    public function shouldIncreaseTheQualityThenTheProductIsAgedBrie($days)
    {
        $this->createProduct(self::PRODUCT_AGED_BRIE, $days, self::QUALITY_NORMAL);
        $this->nextDay();
        $this->assertQuality(self::QUALITY_NORMAL + 1, "Aged Brie increase quality every day");
    }

    /**
     * @dataProvider typeOfDays
     * @test
     */
    public function shouldNotIncreaseTheQualityWhenGetsTheMaximum($days)
    {
        $this->createProduct(self::PRODUCT_AGED_BRIE, $days, self::QUALITY_MAXIMUM);
        $this->nextDay();
        $this->assertQuality(self::QUALITY_MAXIMUM, "Aged brie never has more quality than the maximum");
    }

    public function typeOfDays()
    {
        return array(
            array(self::SELL_IN_POSITIVE_DAYS),
            array(self::SELL_IN_EXPIRED_DATE)
        );
    }
}

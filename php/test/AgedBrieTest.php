<?php

namespace LuisRovirosa\GildedRose\Test;

class AgedBrieTest extends BaseTest
{
    /**
     * @dataProvider possibleDays
     * @test
     */
    public function shouldIncreaseTheQualityThenTheProductIsAgedBrie($days)
    {
        $this->createProduct(self::PRODUCT_AGED_BRIE, $days, self::QUALITY_NORMAL);
        $this->nextDay();
        $this->assertQuality(self::QUALITY_NORMAL + 1, "Aged Brie increase quality every day");
    }

    /**
     * @dataProvider possibleDays
     * @test
     */
    public function shouldNotIncreaseTheQualityWhenGetsTheMaximum($days)
    {
        $this->createProduct(self::PRODUCT_AGED_BRIE, $days, self::QUALITY_MAXIMUM);
        $this->nextDay();
        $this->assertQuality(self::QUALITY_MAXIMUM, "Aged brie never has more quality than the maximum");
    }

    /**
     * @dataProvider possibleDays
     * @test
     */
    public function shouldDecreaseTheDaysByOne($days)
    {
        $this->createProduct(self::PRODUCT_NORMAL, $days, self::QUALITY_NORMAL);
        $this->nextDay();
        $this->assertExpectedDays($days - 1, "Normal product should decrease the days to expire by 1");
    }
}

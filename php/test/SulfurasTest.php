<?php


namespace LuisRovirosa\GildedRose\Test;

class SulfurasTest extends GildedRoseTest
{

    /**
     * @dataProvider possibleDays
     * @test
     */
    public function shouldNotChangeTheDate($days)
    {
        $this->createProduct(self::PRODUCT_SULFURAS, $days, self::QUALITY_NORMAL);
        $this->nextDay();
        $this->assertExpectedDays($days, 'Sulfuras does not change days');
    }

    /**
     * @dataProvider possibleQualities
     * @test
     */
    public function shouldNotChangeTheQuality($quality)
    {
        $this->createProduct(self::PRODUCT_SULFURAS, self::SELL_IN_POSITIVE_DAYS, $quality);
        $this->nextDay();
        $this->assertQuality($quality, "Sulfuras does not change quality");
    }

    public function possibleDays()
    {
        return array(
            array(self::SELL_IN_EXPIRED_DATE),
            array(self::SELL_IN_POSITIVE_DAYS),
            array(self::SELL_IN_0_DAYS),
        );
    }

    public function possibleQualities()
    {
        return array(
            array(self::QUALITY_NORMAL),
            array(self::QUALITY_ZERO),
            array(self::QUALITY_MAXIMUM),
        );
    }
}

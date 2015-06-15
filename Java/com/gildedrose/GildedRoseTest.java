package com.gildedrose;

import static org.junit.Assert.assertEquals;

import org.junit.Test;

public class GildedRoseTest {

	private static final int DEFAULT_QUALITY_CHANGE = -1;
	private static final int NORMAL_ITEM_QUALITY = 5;

	private static final int DEFAULT_SELL_IN_CHANGE = -1;
	private static final int EXPIRED_SELL_IN = 0;
	private static final int NORMAL_ITEM_SELL_IN = 10;

	@Test
	public void sell_in_decreases_every_day() {
		verifySellIn(NORMAL_ITEM_SELL_IN + DEFAULT_SELL_IN_CHANGE, normalItem());
	}

	@Test
	public void quality_decreases_every_day() {
		verifyQuality(NORMAL_ITEM_QUALITY + DEFAULT_QUALITY_CHANGE, normalItem());
	}

	// - Once the sell by date has passed, Quality degrades twice as fast
	@Test
	public void quality_decreases_twice_as_fast_one_sell_in_has_passed() {
		Item expiredItem = new Item("foo", EXPIRED_SELL_IN, NORMAL_ITEM_QUALITY);
		verifyQuality(NORMAL_ITEM_QUALITY + 2 * DEFAULT_QUALITY_CHANGE, expiredItem);
	}

	// - The Quality of an item is never negative
	// - "Aged Brie" actually increases in Quality the older it gets
	// - The Quality of an item is never more than 50
	// - "Sulfuras", being a legendary item, never has to be sold or decreases in Quality
	// - "Backstage passes",
	// - Increases in Quality as it's SellIn value approaches
	// - Quality increases by 2 when there are 10 days or less
	// - By 3 when there are 5 days or less but
	// - Quality drops to 0 after the concert

	private void verifySellIn(int expectedSellIn, Item item) {
		GildedRose gildedRose = gildedRose(item);
		gildedRose.updateQuality();
		assertSellIn(expectedSellIn, gildedRose);
	}

	private void verifyQuality(int expectedQuality, Item normalItem) {
		GildedRose gildedRose = gildedRose(normalItem);
		gildedRose.updateQuality();
		assertQuality(expectedQuality, gildedRose);
	}

	private GildedRose gildedRose(Item item) {
		Item[] items = new Item[] { item };
		GildedRose app = new GildedRose(items);
		return app;
	}

	private Item normalItem() {
		Item item = new Item("foo", NORMAL_ITEM_SELL_IN, NORMAL_ITEM_QUALITY);
		return item;
	}

	private void assertSellIn(int expectedSellIn, GildedRose app) {
		assertEquals(expectedSellIn, app.items[0].sellIn);
	}

	private void assertQuality(int expectedQuality, GildedRose gildedRose) {
		assertEquals(expectedQuality, gildedRose.items[0].quality);
	}

}

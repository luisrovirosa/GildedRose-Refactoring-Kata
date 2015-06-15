package com.gildedrose;

import static org.junit.Assert.assertEquals;

import org.junit.Test;

public class GildedRoseTest {

	// Every day:
	// - Sell in decreases every day
	@Test
	public void sell_in_decreases_every_day() {
		verifySellIn(9, normalItem());
	}

	private void verifySellIn(int expectedSellIn, Item item) {
		GildedRose gildedRose = gildedRose(item);
		gildedRose.updateQuality();
		assertSellIn(expectedSellIn, gildedRose);
	}

	// - Quality decreases every day
	@Test
	public void quality_decreases_every_day() {
		Item[] items = new Item[] { new Item("foo", 10, 5) };
		GildedRose app = new GildedRose(items);
		app.updateQuality();
		assertEquals(4, app.items[0].quality);
	}

	// - Once the sell by date has passed, Quality degrades twice as fast
	// - The Quality of an item is never negative
	// - "Aged Brie" actually increases in Quality the older it gets
	// - The Quality of an item is never more than 50
	// - "Sulfuras", being a legendary item, never has to be sold or decreases in Quality
	// - "Backstage passes",
	// - Increases in Quality as it's SellIn value approaches
	// - Quality increases by 2 when there are 10 days or less
	// - By 3 when there are 5 days or less but
	// - Quality drops to 0 after the concert

	private GildedRose gildedRose(Item item) {
		Item[] items = new Item[] { item };
		GildedRose app = new GildedRose(items);
		return app;
	}

	private Item normalItem() {
		Item item = new Item("foo", 10, 5);
		return item;
	}

	private void assertSellIn(int expectedSellIn, GildedRose app) {
		assertEquals(expectedSellIn, app.items[0].sellIn);
	}

}

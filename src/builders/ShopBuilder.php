<?php

namespace jugger\yandexYml\builders;

use jugger\yandexYml\Shop;
use jugger\yandexYml\SimpleOffer;

class ShopBuilder
{
	protected $dom;
	protected $shop;
	protected $element;

	public function build(Shop $shop): string
	{
		$dom = $this->buildDOM($shop);
		$node = $dom->getElementsByTagName('shop')->item(0);
		return $dom->saveXML($node);
	}

	public function buildDOM(Shop $shop): \DOMDocument
	{
		$this->initBeforeBuild($shop);

		$this->elementAppendChildShopProperty("name");
		$this->elementAppendChildShopProperty("company");
		$this->elementAppendChildShopProperty("url");
		$this->elementAppendChildShopPropertyIsSet("platform");
		$this->elementAppendChildShopPropertyIsSet("version");
		$this->elementAppendChildShopPropertyIsSet("agency");
		$this->elementAppendChildShopPropertyIsSet("email");
		$this->elementAppendChildCurrencies();
		$this->elementAppendChildCategories();
		$this->elementAppendChildDeliveryOptions();
		$this->elementAppendChildShopPropertyIsSet("cpa");

		$this->elementAppendChildOffers();

		return $this->dom;
	}

	protected function initBeforeBuild(Shop $shop)
	{
		$this->dom = new \DOMDocument;
		$this->shop = $shop;
		$this->element = $this->dom->createElement("shop");
		$this->dom->appendChild($this->element);
	}

	protected function elementAppendChildShopProperty(string $name)
	{
		$value = $this->shop->$name;
		if (is_scalar($value)) {
			$value = (string) $value;
		}
		else {
			$value = "";
		}
		$child = $this->dom->createElement($name, $value);
		$this->element->appendChild($child);
	}

	protected function elementAppendChildShopPropertyIsSet(string $name)
	{
		if (isset($this->shop->$name)) {
			$this->elementAppendChildShopProperty($name);
		}
	}

	protected function elementAppendChildCurrencies()
	{
		$items = $this->shop->getCurrencies();
		if (empty($items)) {
			return;
		}

		$itemsElement = $this->dom->createElement('currencies');
		foreach ($items as $item) {
			$itemDom = (new CurrencyBuilder)->buildDOM($item);
			$itemsElement->appendChild(
				$this->dom->importNode(
					$itemDom->getElementsByTagName('currency')->item(0),
					true
				)
			);
		}
		$this->element->appendChild($itemsElement);
	}

	protected function elementAppendChildCategories()
	{
		$items = $this->shop->getCategories();
		if (empty($items)) {
			return;
		}

		$itemsElement = $this->dom->createElement('categories');
		foreach ($items as $item) {
			$itemDom = (new CategoryBuilder)->buildDOM($item);
			$itemsElement->appendChild(
				$this->dom->importNode(
					$itemDom->getElementsByTagName('category')->item(0),
					true
				)
			);
		}
		$this->element->appendChild($itemsElement);
	}

	protected function elementAppendChildOffers()
	{
		$items = $this->shop->getOffers();
		if (empty($items)) {
			return;
		}

		$itemsElement = $this->dom->createElement('offers');
		foreach ($items as $item) {
			if ($item instanceof SimpleOffer) {
				$itemDom = (new SimpleOfferBuilder)->buildDOM($item);
			}
			else {
				$itemDom = (new ArbitraryOfferBuilder)->buildDOM($item);
			}
			$itemsElement->appendChild(
				$this->dom->importNode(
					$itemDom->getElementsByTagName('offer')->item(0),
					true
				)
			);
		}
		$this->element->appendChild($itemsElement);
	}

	protected function elementAppendChildDeliveryOptions()
	{
		$options = $this->shop->getDeliveries();
		if (empty($options)) {
			return;
		}

		$deliveryDom = $this->dom->createElement('delivery-options');
		foreach ($options as $item) {
			$optionDom = (new DeliveryBuilder)->buildDOM($item);
			$deliveryDom->appendChild(
				$this->dom->importNode(
					$optionDom->getElementsByTagName('option')->item(0),
					true
				)
			);
		}
		$this->element->appendChild($deliveryDom);
	}
}

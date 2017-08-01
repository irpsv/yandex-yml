<?php

namespace jugger\yandexYml\builders;

use jugger\yandexYml\Price;
use jugger\yandexYml\Offer;

abstract class OfferBuilder
{
	protected $dom;
	protected $offer;
	protected $element;

	public function build(Offer $model): string
	{
		$dom = $this->buildDOM($model);
		$node = $dom->getElementsByTagName('offer')->item(0);
		// короче какая то шляпа
		// <param name=""> - не кушает русские символы (кодирует в HTML тэги)
		return html_entity_decode($dom->saveXML($node));
	}

	abstract public function buildDOM(Offer $offer): \DOMDocument;

	protected function initBeforeBuild(Offer $offer)
	{
		$this->dom = new \DOMDocument;
		$this->offer = $offer;
		$this->element = $this->dom->createElement("offer");
		$this->dom->appendChild($this->element);
	}

	protected function elementInitAttributes()
	{
		$this->elementSetAttribute("id");
		if (!is_null($this->offer->available)) {
			$this->elementSetAttribute("available");
		}
		if ($this->offer->cbid) {
			$this->elementSetAttribute("cbid");
		}
		if ($this->offer->bid) {
			$this->elementSetAttribute("bid");
		}
		if ($this->offer->fee) {
			$this->elementSetAttribute("fee");
		}
	}

	protected function elementInitGeneralProperties()
	{
		$this->elementAppendChildProperty("url");
		$this->elementAppendChildPrice();
		$this->elementAppendChildOldPrice();
		$this->elementAppendChildProperty("currencyId");
		$this->elementAppendChildProperty("categoryId");
		$this->elementAppendChildPropertyIsSet("picture");
		$this->elementAppendChildPropertyBoolean("delivery");
		$this->elementAppendChildDeliveryOptions();
		$this->elementAppendChildPropertyBoolean("pickup");
		$this->elementAppendChildPropertyBoolean("store");
		$this->elementAppendChildDeliveryOutlets();
		$this->elementAppendChildDescription();
		$this->elementAppendChildPropertyIsSet("sales_notes");

		$this->elementAppendChildQuantity();

		$this->elementAppendChildPropertyBoolean("manufacturer_warranty");
		$this->elementAppendChildPropertyIsSet("country_of_origin");
		$this->elementAppendChildPropertyBoolean("adult");
		$this->elementAppendChildPropertyIsSet("age");
		$this->elementAppendChildPropertyIsSet("barcode");
		$this->elementAppendChildPropertyIsSet("cpa");
		$this->elementAppendChildParams();
		$this->elementAppendChildPropertyIsSet("expiry");
		$this->elementAppendChildPropertyIsSet("weight");
		$this->elementAppendChildPropertyIsSet("dimensions");
		$this->elementAppendChildPropertyBoolean("downloadable");
		$this->elementAppendChildRecs();
	}

	protected function elementSetAttribute(string $name)
	{
		$value = $this->offer->$name;
		if (is_bool($value)) {
			$value = $value ? "true" : "false";
		}
		$this->element->setAttribute($name, $value);
	}

	protected function elementAppendChildProperty(string $name)
	{
		$value = $this->offer->$name;
		if (is_scalar($value)) {
			$value = (string) $value;
		}
		else {
			$value = "";
		}
		$child = $this->dom->createElement($name, $value);
		$this->element->appendChild($child);
	}

	protected function elementAppendChildPropertyBoolean(string $name)
	{
		$value = $this->offer->$name;
		if (is_null($value)) {
			return;
		}
		else {
			 $value = $value ? "true" : "false";
		}
		$this->element->appendChild(
			$this->dom->createElement($name, $value)
		);
	}

	protected function elementAppendChildPropertyIsSet(string $name)
	{
		if (isset($this->offer->$name)) {
			$this->elementAppendChildProperty($name);
		}
	}

	protected function elementAppendChildPrice()
	{
		$child = (new PriceBuilder)->buildDOM($this->offer->price);
		$this->element->appendChild(
			$this->dom->importNode(
				$child->getElementsByTagName('price')->item(0),
				true
			)
		);
	}

	protected function elementAppendChildOldPrice()
	{
		$value = $this->offer->oldprice;
		if (!$value) {
			return;
		}
		elseif ($value instanceof Price) {
			$value = $value->amount;
		}
		$this->element->appendChild(
			$this->dom->createElement("oldprice", $value)
		);
	}

	protected function elementAppendChildQuantity()
	{
		if ($this->offer->minQuantity) {
			$this->element->appendChild(
				$this->dom->createElement(
					"min-quantity",
					$this->offer->minQuantity
				)
			);
		}

		if ($this->offer->stepQuantity) {
			$this->element->appendChild(
				$this->dom->createElement(
					"step-quantity",
					$this->offer->stepQuantity
				)
			);
		}
	}

	protected function elementAppendChildDescription()
	{
		$desc = $this->offer->description ?? null;
		if ($desc) {
			$descDom = $this->dom->createElement('description');
			$descDom->appendChild(
				$this->dom->createCDATASection($desc)
			);
			$this->element->appendChild($descDom);
		}
	}

	protected function elementAppendChildDeliveryOptions()
	{
		$options = $this->offer->getDeliveries();
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

	protected function elementAppendChildDeliveryOutlets()
	{
		$items = $this->offer->getOutlets();
		if (empty($items)) {
			return;
		}

		$outletsDom = $this->dom->createElement('outlets');
		foreach ($items as $item) {
			$itemDom = (new OutletBuilder)->buildDOM($item);
			$outletsDom->appendChild(
				$this->dom->importNode(
					$itemDom->getElementsByTagName('outlet')->item(0),
					true
				)
			);
		}
		$this->element->appendChild($outletsDom);
	}

	protected function elementAppendChildParams()
	{
		$items = $this->offer->getParams();
		if (empty($items)) {
			return;
		}

		foreach ($items as $item) {
			$node = $this->dom->createElement('param');
			$node->setAttribute('name', $item['name']);
			$node->appendChild(
				$this->dom->createTextNode($item['value'])
			);
			if ($item['unit']) {
				$node->setAttribute('unit', $item['unit']);
			}
			$this->element->appendChild($node);
		}
	}

	protected function elementAppendChildRecs()
	{
		$items = $this->offer->getRec();
		if (empty($items)) {
			return;
		}

		$items = array_map('strval', $items);
		$this->element->appendChild(
			$this->dom->createElement('rec', join($items, ","))
		);
	}
}

<?php

namespace jugger\yandexYml\builders;

use jugger\yandexYml\Shop;

class ShopBuilder
{
	protected $dom;
	protected $shop;
	protected $element;

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

	public function buildDOM(Shop $shop): \DOMDocument
	{
		$this->initBeforeBuild($shop);

		$shop->cpa = $shop->cpa ? (int) $shop->cpa : 0;

		$this->elementAppendChildShopProperty("name");
		$this->elementAppendChildShopProperty("company");
		$this->elementAppendChildShopProperty("url");
		$this->elementAppendChildShopProperty("cpa");
		$this->elementAppendChildShopPropertyIsSet("platform");
		$this->elementAppendChildShopPropertyIsSet("version");
		$this->elementAppendChildShopPropertyIsSet("agency");
		$this->elementAppendChildShopPropertyIsSet("email");

		return $this->dom;
	}

	public function build(Shop $shop): string
	{
		$dom = $this->buildDOM($shop);
		$node = $dom->getElementsByTagName('shop')->item(0);
		return $dom->saveXML($node);
	}
}

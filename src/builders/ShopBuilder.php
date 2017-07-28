<?php

namespace jugger\yandexYml\builders;

use jugger\yandexYml\Shop;

class ShopBuilder
{
	protected $shop;
	protected $dom;

	public function __construct(Shop $shop)
	{
		$this->shop = $shop;
		$this->dom = new \DOMDocument;
	}

	protected function appendChildProperty(\DOMElement $element, string $name)
	{
		$value = $this->shop->$name;
		if (is_scalar($value)) {
			$value = (string) $value;
		}
		else {
			$value = "";
		}
		$child = $this->dom->createElement($name, $value);
		$element->appendChild($child);
	}

	protected function appendChildPropertyIsSet(\DOMElement $element, string $name)
	{
		if (isset($this->shop->$name)) {
			$this->appendChildProperty($element, $name);
		}
	}

	public function buildDOM(): \DOMDocument
	{
		$this->dom = new \DOMDocument;
		$element = $this->dom->createElement("shop");
		$this->dom->appendChild($element);

		$this->appendChildProperty($element, "name");
		$this->appendChildProperty($element, "company");
		$this->appendChildProperty($element, "url");
		$this->appendChildPropertyIsSet($element, "platform");
		$this->appendChildPropertyIsSet($element, "version");
		$this->appendChildPropertyIsSet($element, "agency");
		$this->appendChildPropertyIsSet($element, "email");

		return $this->dom;
	}

	public function build(): string
	{
		$dom = $this->buildDOM();
		$node = $dom->getElementsByTagName('shop')->item(0);
		return $dom->saveXML($node);
	}
}

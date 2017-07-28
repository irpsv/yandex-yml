<?php

namespace jugger\yandexYml\builders;

use jugger\yandexYml\Delivery;

class DeliveryBuilder
{
	public function buildDOM(Delivery $model): \DOMDocument
	{
		$dom = new \DOMDocument;
		$element = $dom->createElement("option");
		$element->setAttribute('cost', $model->cost);
		if ($model->days) {
			$element->setAttribute('days', $model->days);
		}
		if ($model->orderBefore) {
			$element->setAttribute('order-before', $model->orderBefore);
		}

		$dom->appendChild($element);
		return $dom;
	}

	public function build(Delivery $model): string
	{
		$dom = $this->buildDOM($model);
		$node = $dom->getElementsByTagName('option')->item(0);
		return $dom->saveXML($node);
	}
}

<?php

namespace jugger\yandexYml\builders;

use jugger\yandexYml\Category;

class CategoryBuilder
{
	public function buildDOM(Category $model): \DOMDocument
	{
		$dom = new \DOMDocument;
		$element = $dom->createElement("category", $model->name);
		$element->setAttribute('id', $model->id);
		if ($model->parentId) {
			$element->setAttribute('parentId', $model->parentId);
		}

		$dom->appendChild($element);
		return $dom;
	}

	public function build(Category $model): string
	{
		$dom = $this->buildDOM($model);
		$node = $dom->getElementsByTagName('category')->item(0);
		return $dom->saveXML($node);
	}
}

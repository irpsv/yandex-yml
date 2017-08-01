<?php

namespace jugger\yandexYml;

class SimpleOffer extends Offer
{
	public $name;
	public $model;
	public $vendor;
	public $vendorCode;

	public function __construct(string $id, string $url, Price $price, string $currencyId, string $categoryId, string $name)
	{
		$this->id = $id;
		$this->name = $name;
		$this->url = $url;
		$this->price = $price;
		$this->currencyId = $currencyId;
		$this->categoryId = $categoryId;
	}
}

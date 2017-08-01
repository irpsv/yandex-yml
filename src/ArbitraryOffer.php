<?php

namespace jugger\yandexYml;

class ArbitraryOffer extends Offer
{
	public $type = "vendor.model";
	public $model;
	public $vendor;
	public $vendorCode;
	public $typePrefix;

	public function __construct(string $id, string $url, Price $price, string $currencyId, string $categoryId, string $model, string $vendor)
	{
		$this->id = $id;
		$this->url = $url;
		$this->price = $price;
		$this->model = $model;
		$this->vendor = $vendor;
		$this->currencyId = $currencyId;
		$this->categoryId = $categoryId;
	}
}

<?php

namespace jugger\yandexYml;

abstract class Offer
{
	public $id;
	public $cbid;
	public $bid;
	public $fee;
	public $url;
	public $categoryId;
	public $currencyId;
	public $price;
	public $oldprice;
	public $picture;
	public $delivery;
	public $pickup;
	public $available;
	public $store;
	public $description;
	public $sales_notes;
	public $minQuantity;
	public $stepQuantity;
	public $manufacturer_warranty;
	public $country_of_origin;
	public $adult;
	public $age;
	public $barcode;
	public $cpa;
	public $expiry;
	public $weight;
	public $dimensions;
	public $downloadable;

	protected $deliveryOptions = [];
	protected $outlets = [];
	protected $params = [];
	protected $rec = [];

	public function __construct(string $id)
	{
		$this->id = $id;
	}

	public function addDelivery(Delivery $item)
	{
		$this->delivery = true;
		$this->deliveryOptions[] = $item;
	}

	public function getDeliveries(): array
	{
		return $this->deliveryOptions;
	}

	public function addOutlet(Outlet $item)
	{
		$this->outlets[] = $item;
	}

	public function getOutlets(): array
	{
		return $this->outlets;
	}

	public function addParam(string $name, string $value, string $unit = null)
	{
		$this->params[] = compact('name', 'value', 'unit');
	}

	public function getParams(): array
	{
		return $this->params;
	}

	public function setRec(array $items)
	{
		$this->rec = $items;
	}

	public function getRec(): array
	{
		return $this->rec;
	}
}

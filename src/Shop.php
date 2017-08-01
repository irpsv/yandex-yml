<?php

namespace jugger\yandexYml;

class Shop
{
	public $name;
	public $company;
	public $url;
	public $platform;
	public $version;
	public $agency;
	public $email;
	public $cpa;

	protected $offers = [];
	protected $currencies = [];
	protected $categories = [];
	protected $deliveryOptions = [];

	public function __construct(string $name, string $company, string $url)
	{
		$this->name = $name;
		$this->company = $company;
		$this->url = $url;
	}

	public function addCurrency(Currency $item)
	{
		$this->currencies[] = $item;
	}

	public function getCurrencies(): array
	{
		return $this->currencies;
	}

	public function addCategory(Category $item)
	{
		$this->categories[] = $item;
	}

	public function getCategories(): array
	{
		return $this->categories;
	}

	public function addOffer(Offer $item)
	{
		$this->offers[] = $item;
	}

	public function getOffers(): array
	{
		return $this->offers;
	}

	public function addDelivery(Delivery $item)
	{
		$this->deliveryOptions[] = $item;
	}

	public function getDeliveries(): array
	{
		return $this->deliveryOptions;
	}
}

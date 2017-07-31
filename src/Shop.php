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

	public function __construct(string $name, string $company, string $url)
	{
		$this->name = $name;
		$this->company = $company;
		$this->url = $url;
	}
}

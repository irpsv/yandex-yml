<?php
//
// namespace tests;
//
// use PHPUnit\Framework\TestCase;
// use jugger\yandexYml\Shop;
// use jugger\yandexYml\Category;
// use jugger\yandexYml\Category;
// use jugger\yandexYml\Category;
// use jugger\yandexYml\Category;
//
// class GeneralTest extends TestCase
// {
// 	public function testMain()
// 	{
// 		$shop = new Shop("BestSeller", "Tne Best inc.", "http://best.seller.ru");
// 		// currency
// 		$shop->addCurrency(
// 			new Currency("RUR", 1)
// 		);
// 		$shop->addCurrency(
// 			new Currency(Currency::ID_USD, 60)
// 		);
// 		// category
// 		$shop->addCategory(
// 			new Category(1, "Бытовая техника")
// 		);
// 		$shop->addCategory(
// 			new Category(10, "Мелкая техника для кухни", 1)
// 		);
// 		$shop->addCategory(
// 			new Category(101, "Сэндвичницы и приборы для выпечки", 10)
// 		);
// 		$shop->addCategory(
// 			new Category(102, "Мороженицы", 10)
// 		);
// 		// offers
// 		$offer = new Offer(12346, true, 80, 90, 325);
// 		$offer->url = "http://best.seller.ru/product_page.asp?pid=12348";
//     	$offer->price = 1490;
//         $offer->oldprice = 1620;
// 		$offer->currencyId = Currency::ID_RUR;
// 		$offer->categoryId = 101;
//         $offer->picture = "http://best.seller.ru/img/large_12348.jpg";
// 		$offer->store = false;
//         $offer->pickup = true;
//         $offer->delivery = true;
//         <delivery-options>
//           <option cost="300" days="0" order-before="12"/>
//         </delivery-options>
//         <name>Вафельница First FA-5300</name>
//         <vendor>First</vendor>
//         <vendorCode>A1234567B</vendorCode>
//         <description>
//         <![CDATA[
//           <p>Отличный подарок для любителей венских вафель.</p>
//         ]]>
//         </description>
//         <sales_notes>Необходима предоплата.</sales_notes>
//         <manufacturer_warranty>true</manufacturer_warranty>
//         <country_of_origin>Россия</country_of_origin>
//         <barcode>0156789012</barcode>
//         <cpa>1</cpa>
//         <rec>123,456</rec>
// 		$shop->addOffer($offer);
// 		// build
// 		$builder = new CatalogBuilder();
// 		$example = file_get_contents(__DIR__.'/example.xml');
// 		$this->assertEquals(
// 			$builder->build($shop, "2017-02-05 17:22"),
// 			trim($example)
// 		);
// 	}
// }

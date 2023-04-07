<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use Illuminate\Support\Facades\Hash;

class CountrySeeder extends Seeder
{
    /**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$country = [
            ["name" => "India","slug" => "india", "code" => "IN", "flag" => "india-flag.svg", "currency" => "indian_rupee", "currency_code" => "INR", "symbol" => "&#8377;", "rate" => "1", "sort_order" => "1"],
            ["name" => "United States","slug" => "united-states", "code" => "US", "flag" => "united-states-flag.svg", "currency" => "us_dollar", "currency_code" => "USD", "symbol" => "&#36;", "rate" => "81.58", "sort_order" => "2"],
			["name" => "United Kingdom","slug" => "united-kingdom", "code" => "GB", "flag" => "united-kingdom-flag.svg", "currency" => "british_pound", "currency_code" => "GBP", "symbol" => "&#163;", "rate" => "88.29", "sort_order" => "3"],
            ["name" => "Europe","slug" => "europe", "code" => "EU", "flag" => "europe-flag.svg", "currency" => "euro", "currency_code" => "EUR", "symbol" => "&#8364;", "rate" => "78.58", "sort_order" => "4"],
			["name" => "Australia","slug" => "australia", "code" => "AU", "flag" => "australia-flag.svg", "currency" => "australian_dollar", "currency_code" => "USD", "symbol" => "&#36;", "rate" => "81.58", "sort_order" => "5"],
            ["name" => "Canada","slug" => "canada", "code" => "CA", "flag" => "canada-flag.svg", "currency" => "canadian_dollar", "currency_code" => "USD", "symbol" => "&#36;", "rate" => "81.58", "sort_order" => "6"],
			["name" => "South Africa","slug" => "south-africa", "code" => "ZAR", "flag" => "south-africa-flag.svg", "currency" => "rand", "currency_code" => "ZAR", "symbol" => "&#82;", "rate" => "4.65", "sort_order" => "7"]
        ];

		Country::insert($country);
	}
}

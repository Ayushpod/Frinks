<?php
	namespace App\Traits;
	
	trait Countries {
		
		public function getAllCountries()
		{
			$opts = array(
			'http'=>array(
			'method'=>"GET",
			'header'=>"User-Agent: collegeassignment api script\r\n"
			));

			$context = stream_context_create($opts);
			$base = ENV('GEO_API_URL');
			$url = 'https://restcountries.eu/rest/v2/all';
			$countryList = file_get_contents($url, false, $context);
			if (!empty($countryList)){
				$countryList =json_decode($countryList);
			}
			return $countryList;
		}
	}
?>
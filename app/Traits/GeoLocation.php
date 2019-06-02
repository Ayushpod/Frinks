<?php	
namespace App\Traits;

trait GeoLocation {
	
	public function getLatLonByAddress($address)
	{
		$opts = array(
		'http'=>array(
		'method'=>"GET",
		'header'=>"User-Agent: collegeassignment api script\r\n"
		));

		$context = stream_context_create($opts);
		$base = ENV('GEO_API_URL');
		$url = $base . 'search?q=' . urlencode($address) . '&format=json';
		$coordinates = file_get_contents($url, false, $context);
		if (!empty($coordinates)){
			$coordinates =json_decode($coordinates);
		}
		
		return $coordinates;
	}
}
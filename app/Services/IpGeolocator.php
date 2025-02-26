<?php

namespace App\Services;

class IpGeolocator
{
    public function getGeolocation($ip = FALSE)
    {
        if (!$ip) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $apiKey = env('IPGEO_KEY');

        $url = "https://api.ipgeolocation.io/ipgeo?apiKey=" . $apiKey . "&ip=" . $ip . "&lang=en&fields=*&excludes=";
        $cURL = curl_init();

        curl_setopt($cURL, CURLOPT_URL, $url);
        curl_setopt($cURL, CURLOPT_HTTPGET, true);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json',
            'User-Agent: ' . $_SERVER['HTTP_USER_AGENT']
        ));
        $retorno = curl_exec($cURL);
        return json_decode($retorno);
    }
}

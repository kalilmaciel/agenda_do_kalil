<?php

namespace App\Services;

class CepService
{
    public function getEndereco($cep = FALSE)
    {
        if (!$cep) {
            return FALSE;
        }

        $cep = Funcoes::onlyNumbers($cep, 5, '0');

        $url = "https://viacep.com.br/ws/$cep/json/";;
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

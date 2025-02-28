<?php

namespace App\Services;

class MapaService
{
    public function getLocalizacao($endereco = FALSE)
    {
        if (!$endereco) {
            return FALSE;
        }

        $endereco = urlencode($endereco);

        $api_key = env('LOCATIONIQ_API_KEY');

        $url = "https://us1.locationiq.com/v1/search?key=$api_key&q=$endereco&format=json&";
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

    public function getLocalizacaoReversa($latitude, $longitude)
    {
        if (!$latitude || !$longitude) {
            return FALSE;
        }

        $api_key = env('LOCATIONIQ_API_KEY');

        $url = "https://us1.locationiq.com/v1/reverse?key=$api_key&lat=$latitude&lon=$longitude&format=json&";
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

        $retorno = json_decode($retorno);

        //Correção para poder exibir corretamente a UF
        if ($retorno->address) {
            switch ($retorno->address->state) {
                case 'Acre':
                    $retorno->address->uf = 'AC';
                    break;
                case 'Alagoas':
                    $retorno->address->uf = 'AL';
                    break;
                case 'Amapá':
                    $retorno->address->uf = 'AP';
                    break;
                case 'Amazonas':
                    $retorno->address->uf = 'AM';
                    break;
                case 'Bahia':
                    $retorno->address->uf = 'BA';
                    break;
                case 'Ceará':
                    $retorno->address->uf = 'CE';
                    break;
                case 'Federal District':
                    $retorno->address->uf = 'DF';
                    break;
                case 'Espírito Santo':
                    $retorno->address->uf = 'ES';
                    break;
                case 'Goiás':
                    $retorno->address->uf = 'GO';
                    break;
                case 'Maranhão':
                    $retorno->address->uf = 'MA';
                    break;
                case 'Mato Grosso':
                    $retorno->address->uf = 'MT';
                    break;
                case 'Mato Grosso do Sul':
                    $retorno->address->uf = 'MS';
                    break;
                case 'Minas Gerais':
                    $retorno->address->uf = 'MG';
                    break;
                case 'Pará':
                    $retorno->address->uf = 'PA';
                    break;
                case 'Paraíba':
                    $retorno->address->uf = 'PB';
                    break;
                case 'Paraná':
                    $retorno->address->uf = 'PR';
                    break;
                case 'Pernambuco':
                    $retorno->address->uf = 'PE';
                    break;
                case 'Piauí':
                    $retorno->address->uf = 'PI';
                    break;
                case 'Rio de Janeiro':
                    $retorno->address->uf = 'RJ';
                    break;
                case 'Rio Grande do Norte':
                    $retorno->address->uf = 'RN';
                    break;
                case 'Rio Grande do Sul':
                    $retorno->address->uf = 'RS';
                    break;
                case 'Rondônia':
                    $retorno->address->uf = 'RO';
                    break;
                case 'Roraima':
                    $retorno->address->uf = 'RR';
                    break;
                case 'Santa Catarina':
                    $retorno->address->uf = 'SC';
                    break;
                case 'São Paulo':
                    $retorno->address->uf = 'SP';
                    break;
                case 'Sergipe':
                    $retorno->address->uf = 'SE';
                    break;
                case 'Tocantins':
                    $retorno->address->uf = 'TO';
                    break;
            }
        }

        return $retorno;
    }
}

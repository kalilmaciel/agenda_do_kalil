<?php

namespace App\Services;

use DateInterval;
use DateTime;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Exceptions\RuntimeException;
use Intervention\Image\Laravel\Facades\Image;

class Funcoes
{

    /**
     * Retorna a URL de uma imagem
     * @param string $imagem Nome da Imagem
     * @param bool|string $pasta Nome da pasta ou FALSE caso seja na pasta raiz
     * @param bool $miniatura Indica se a imagem é a miniatura ou a original
     * @return string
     * @throws InvalidArgumentException
     */
    public static function getImagem($imagem, $pasta = FALSE, $miniatura = FALSE)
    {
        return env('IMAGE_LOCATION') . ($pasta ? $pasta . '/' : '/') . ($miniatura ? 't_' : '') . $imagem;
    }

    /**
     * Desencripta dados
     * @param mixed $dados
     * @return mixed
     */
    public static function decrypt($dados)
    {
        try {
            return Crypt::decrypt($dados);
        } catch (DecryptException $de) {
            return NULL;
        }
    }

    /**
     * Encripta dados
     * @param mixed $dados
     * @return mixed
     */
    public static function encrypt($dados)
    {
        try {
            return Crypt::encrypt($dados);
        } catch (DecryptException $de) {
            return NULL;
        }
    }

    /**
     * Converte dada do padrão d/m/Y para o padrão Y-m-d
     * @param mixed $data
     * @param bool $remover_segundos
     * @return string
     */
    public static function desconverterData($data, $remover_segundos = false)
    {
        if (!$data) {
            return FALSE;
        }
        if ($data === "" || $data === "nulo" || $data === "vazio" || $data === "null") {
            return $data;
        }
        $datahora = explode(" ", $data);
        if (count($datahora) > 1) {
            $data = $datahora[0];
            if (self::validarData($data, 'd/m/Y')) {
                $novadata = explode("/", $data);
                $hora = $datahora[1];
                if ($remover_segundos) {
                    $hora = explode(":", $hora);
                    array_pop($hora);
                    $hora = implode(":", $hora);
                }
                return $novadata[2] . '-' . $novadata[1] . '-' . $novadata[0] . " " . $hora;
            }
        } else {
            $novadata = explode("/", $data);
            $data = $novadata[2] . '-' . $novadata[1] . '-' . $novadata[0];
            if (self::validarData($data, 'Y-m-d')) {
                return $data;
            }
        }
        return '';
    }

    /**
     * Converte dada do padrão Y-m-d para o padrão d/m/Y
     * @param string $data Data a ser convertida
     * @param bool $remover_segundos Se deve remover os segundos do resultado
     * @return string
     */
    public static function converterData($data, $remover_segundos = FALSE)
    {
        if (!$data) {
            return "";
        }
        if ($data === "" || $data === "0000-00-00" || $data === "nulo" || $data === "vazio" || $data === "null") {
            return "";
        }
        $datahora = explode(" ", $data);
        if (count($datahora) > 1) {
            $data = $datahora[0];
            if (self::validarData($data, 'Y-m-d')) {
                $novadata = explode("-", $data);
                $hora = $datahora[1];
                if ($remover_segundos) {
                    $hora = explode(":", $hora);
                    array_pop($hora);
                    $hora = implode(":", $hora);
                }
                return $novadata[2] . '/' . $novadata[1] . '/' . $novadata[0] . " " . $hora;
            }
        } else {
            $novadata = explode("-", $data);
            $data = $novadata[2] . '/' . $novadata[1] . '/' . $novadata[0];
            if (self::validarData($data, 'd/m/Y')) {
                return $data;
            }
        }
        return '';
    }

    /**
     * Verifica se uma data é válida
     * @param string $date Data a ser verificada
     * @param string $format Formato da data informada
     * @return bool
     */
    public static function validarData($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any
        // number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }

    /**
     * Método para setar o value em um input
     * @param array $objeto Um array que contem o objeto do formulário
     * @param string $atributo O nome do parametro a ser buscado dentro do objeto
     * @param string $old_value Caso o atributo esteja vazio, usa este valor
     * @return string
     */
    public static function setValue($objeto, $atributo, $old_value = '')
    {
        if (!is_array($objeto)) {
            $objeto = (array) $objeto;
        }
        if (!array_key_exists($atributo, $objeto)) {
            return '';
        }
        return !empty($objeto[$atributo]) ? $objeto[$atributo] : $old_value;
    }

    /**
     * Método para setar o value em um checkbox
     * @param array $objeto Um array que contem o objeto do formulário
     * @param string $atributo O nome do parametro a ser buscado dentro do objeto
     * @param string $old_value Caso o atributo esteja vazio, usa este valor
     * @return string
     */
    public static function setChecked($objeto, $atributo, $old_value = '-1')
    {
        if (!is_array($objeto)) {
            $objeto = (array) $objeto;
        }
        if (!array_key_exists($atributo, $objeto)) {
            return '';
        }
        return !empty($objeto[$atributo]) ?
            ($objeto[$atributo] == '1' ? 'checked="checked"' : '') : ($old_value == '1' ? 'checked="checked"' : '');
    }

    /**
     * Método para setar o value em um select dropdown
     * @param array $objeto Um array que contem o objeto do formulário
     * @param string $atributo O nome do parametro a ser buscado dentro do objeto
     * @param string $valor Valor a ser comparado para retornar o atributo de selected
     * @param string $old_value Caso o atributo esteja vazio, usa este valor
     * @return string
     */
    public static function setSelected($objeto, $atributo, $valor, $old_value = '')
    {
        if (!is_array($objeto)) {
            $objeto = (array) $objeto;
        }
        if (!array_key_exists($atributo, $objeto)) {
            return '';
        }
        return !empty($objeto[$atributo] && $objeto[$atributo] == $valor) ?
            'selected' : ($old_value == $valor ? 'selected' : '');
    }

    /**
     *
     * @param mixed $foto
     * @param mixed $destino
     * @param bool $gerarThumbnail
     * @return string|void
     * @throws BindingResolutionException
     * @throws RuntimeException
     */
    public static function uploadImagem($foto, $destino, $gerarThumbnail = FALSE)
    {
        if ($foto && $foto->isValid()) {

            //Gerando nome único da imagem
            $imageName = time() . '.' . $foto->extension();

            //Sobe o arquivo original para o S3
            Storage::disk('s3')->putFileAs($destino, $foto, $imageName);

            //Criando Thumbnail localmente
            if ($gerarThumbnail) {
                //Definindo pasta temporária
                $destinationPath = public_path('images');

                //Gerando Thumbnail
                $thumbnail = Image::read($foto->path());
                $thumbnail->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/t_' . $imageName);

                //Sobe o thumbnail para o S3
                Storage::disk('s3')->putFileAs($destino, $destinationPath . '/t_' . $imageName, 't_' . $imageName);

                // Apaga os arquivos temporários
                unlink($destinationPath . '/t_' . $imageName);
            }

            return $imageName;
        }
    }

    /**
     * Limpa uma string para que ela retorne apenas números
     * @param mixed $number String a ser limpa
     * @param int $qtdPad Se maior que zero, preenche a string com a quantidade de caracteres passados
     * @param string $stringPad Caracter a ser usado para preencher caso $qtdPad > 0
     * @return string|string[]|null
     */
    public static function onlyNumbers($number, $qtdPad = 0, $stringPad = '0')
    {
        if (!empty($number)) {
            $number = preg_replace("/[^0-9]/", "", $number);
            if ($qtdPad > 0) {
                $number = str_pad($number, $qtdPad, $stringPad, STR_PAD_LEFT);
            }
            return $number;
        }
        return FALSE;
    }

    /**
     * Valida um valor de CPF
     * @param mixed $cpf String do CPF a ser validado. Pode ser passado com traço e ponto
     * @return false|string Retorna a string limpa ou FALSE caso inválida
     */
    public static function validaCPF($cpf = null)
    {

        // Verifica se um número foi informado
        if (empty($cpf)) {
            return FALSE;
        }

        // Elimina possivel mascara
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados é igual a 11
        if (strlen($cpf) != 11) {
            return FALSE;
        }
        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        else if (
            $cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999'
        ) {
            return FALSE;
            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        } else {

            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    return FALSE;
                }
            }

            return $cpf;
        }
    }

    /**
     * Valida um valor de CNPJ
     * @param mixed $cpf String do CNPJ a ser validado. Pode ser passado com traço e ponto
     * @return false|string Retorna a string limpa ou FALSE caso inválida
     */
    public static function validaCNPJ($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

        // Valida tamanho
        if (strlen($cnpj) != 14)
            return FALSE;
        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj))
            return FALSE;
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return FALSE;
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj[13] == ($resto < 2 ? 0 : 11 - $resto)) {
            return $cnpj;
        }
        return FALSE;
    }

    /**
     * Valida CPF ou CNPJ de acordo com a quantidade de caracteres
     * @param mixed $value String do CPF/CNPJ a ser validado. TEM QUE SER PASSADO COM PONTO E TRAÇO
     * @return false|string Retorna a string limpa ou FALSE caso inválida
     */
    public static function validaCpfCnpj($value)
    {
        $cpfcnpj = preg_replace('/[^0-9]/', '', (string) $value);

        // Valida tamanho
        if (strlen($cpfcnpj) != 14) {
            return self::validaCPF($value);
        } else {
            return self::validaCNPJ($value);
        }
    }

    /**
     *
     * @param mixed $data Data que será comparada no formato Y-m-d
     * @param bool|int $dias Caso informado, soma a data informada e retorna a diferença em dias a partir de hoje
     * @return int|false|string Retorna os dias restantes ou LIBERADO caso a quantidade de dias seja menor que 0
     */
    public static function diasRestantes($data, $dias = FALSE)
    {
        $date = new DateTime($data);
        $hoje = new DateTime();
        if ($dias) {
            $intervalo = new DateInterval('P' . $dias . 'D');
            $date->add($intervalo);
        }
        $diferenca = $date->diff($hoje);
        return $diferenca->days > 0 ? $diferenca->days : 'LIBERADO';
    }

    /**
     * Transforma uma string em um slug
     * @param string $string
     * @return string
     */
    public static function createSlug($string)
    {
        if (is_string($string)) {
            $string = self::limparCaracteresEspeciais($string);

            $replace = array(
                '/[^a-z0-9-]/'    => '-',
                '/-+/'            => '-',
                '/\-{2,}/'        => ''
            );
            $string = preg_replace(array_keys($replace), array_values($replace), $string);
        }
        return $string;
    }

    /**
     * Remove todos os emojis de uma string
     * @param string $string
     * @return string
     */
    public static function limparEmoji($string)
    {
        ini_set('memory_limit', '512M');
        $string = preg_replace_callback(
            '/./u',
            function (array $match) {
                return strlen($match[0]) >= 4 ? '' : $match[0];
            },
            $string
        );
        return $string;
    }

    /**
     * Transforma todos os caracteres especiais em caracteres alfa numéricos de uma string
     * @param string $string
     * @return string
     */
    public static function limparCaracteresEspeciais($string)
    {
        if (is_string($string)) {
            $string = self::removerCaracteresEspeciais($string);
            $string = strtolower(trim(utf8_decode($string)));

            $before = 'ÜüÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRrºª\'\"´`./°';
            $after  = 'uuaaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr         ';
            $string = strtr($string, utf8_decode($before), $after);
            $string = preg_replace('/[^a-z0-9_ ]/i', '', $string);
        }
        return $string;
    }

    /**
     * Remove todos os caracteres especiais de uma string
     * @param string $string
     * @return string
     */
    public static function removerCaracteresEspeciais($string)
    {
        $search =  explode(",", "°,õ,Õ,ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u,ã,Ã,Ç,Á,É,Í,Ó,Ú,À,È,Ì,Ò,Ù,Ä,Ë,Ï,Ö,Ü,Ÿ,Â,Ê,Î,Ô,Û,Å,E,I,Ø,U,&,?");
        $replace = explode(",", "o,o,O,c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u,a,A,C,A,E,I,O,U,A,E,I,O,U,A,E,I,O,U,Y,A,E,I,O,U,A,E,I,O,U,E, ");

        $string = str_replace($search, $replace, $string);
        return $string;
    }

    /**
     * Formatador para todas as situações
     * @param mixed $valor Valor a ser formatado
     * @param mixed $tipo Tipo de formatação
     * @return mixed|void
     */
    public static function formatar($valor, $tipo)
    {
        switch ($tipo) {
            case 'telefone':
                return self::formataTelefone($valor);
                break;
            case 'dinheiro':
                return self::formataDinheiro($valor);
                break;
            case 'extenso':
                return self::formataPorExtenso($valor);
                break;
            case 'cpfcnpj':
                return self::formataCnpjCpf($valor);
                break;
            case 'cep':
                return self::formataCep($valor);
                break;
            default:
                return $valor;
        }
    }

    private static function formataTelefone($phone)
    {
        $formatedPhone = preg_replace('/[^0-9]/', '', $phone);
        $matches = [];
        preg_match('/^([0-9]{2})([0-9]{4,5})([0-9]{4})$/', $formatedPhone, $matches);
        if ($matches) {
            return '(' . $matches[1] . ') ' . $matches[2] . '-' . $matches[3];
        }

        return $phone;
    }

    private static function formataCep($cep)
    {
        $formatedCep = preg_replace('/[^0-9]/', '', $cep);
        $matches = [];
        preg_match('/^([0-9]{2})([0-9]{3})([0-9]{3})$/', $formatedCep, $matches);
        if ($matches) {
            return  $matches[1] . '.' . $matches[2] . '-' . $matches[3];
        }

        return $cep;
    }

    private static function formataPorExtenso($value = 0, $uppercase = 0)
    {
        if (strpos($value, ",") > 0) {
            $value = str_replace(".", "", $value);
            $value = str_replace(",", ".", $value);
        }
        $singular = ["centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão"];
        $plural = ["centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões"];

        $c = ["", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos"];
        $d = ["", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa"];
        $d10 = ["dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove"];
        $u = ["", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove"];

        $z = 0;

        $value = number_format($value, 2, ".", ".");
        $integer = explode(".", $value);
        $cont = count($integer);
        for ($i = 0; $i < $cont; $i++)
            for ($ii = strlen($integer[$i]); $ii < 3; $ii++)
                $integer[$i] = "0" . $integer[$i];

        $fim = $cont - ($integer[$cont - 1] > 0 ? 1 : 2);
        $rt = '';
        for ($i = 0; $i < $cont; $i++) {
            $value = $integer[$i];
            $rc = (($value > 100) && ($value < 200)) ? "cento" : $c[$value[0]];
            $rd = ($value[1] < 2) ? "" : $d[$value[1]];
            $ru = ($value > 0) ? (($value[1] == 1) ? $d10[$value[2]] : $u[$value[2]]) : "";

            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd &&
                $ru) ? " e " : "") . $ru;
            $t = $cont - 1 - $i;
            $r .= $r ? " " . ($value > 1 ? $plural[$t] : $singular[$t]) : "";
            if (
                $value == "000"
            )
                $z++;
            elseif ($z > 0)
                $z--;
            if (($t == 1) && ($z > 0) && ($integer[0] > 0))
                $r .= (($z > 1) ? " de " : "") . $plural[$t];
            if ($r)
                $rt = $rt . ((($i > 0) && ($i <= $fim) &&
                    ($integer[0] > 0) && ($z < 1)) ? (($i < $fim) ? ", " : " e ") : " ") . $r;
        }

        if (!$uppercase) {
            return trim($rt ? $rt : "zero");
        } elseif ($uppercase == "2") {
            return trim(strtoupper($rt) ? strtoupper(strtoupper($rt)) : "Zero");
        } else {
            return trim(ucwords($rt) ? ucwords($rt) : "Zero");
        }
    }

    private static function formataCnpjCpf($value)
    {
        $cnpj_cpf = preg_replace("/\D/", '', $value);

        if (strlen($cnpj_cpf) === 11) {
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
        }

        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
    }

    private static function formataDinheiro($valor)
    {
        return number_format($valor, 2, ',', '.');
    }

    /**
     * Calcula a distância entre dois pontos GPS em Km
     * @param float $lat1
     * @param float $lon1
     * @param float $lat2
     * @param float $lon2
     * @return float
     */
    public static function distanciaGPS(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        if ($lat1 && $lon1 && $lat2 && $lon2) {
            $lat1 = deg2rad($lat1);
            $lat2 = deg2rad($lat2);
            $lon1 = deg2rad($lon1);
            $lon2 = deg2rad($lon2);

            $distancia = (6371 * acos(cos($lat1) * cos($lat2) * cos($lon2 - $lon1) + sin($lat1) * sin($lat2)));
            $distancia = number_format($distancia, 2, ".", "");
            return floatval($distancia);
        }
        return FALSE;
    }
}

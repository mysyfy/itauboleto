<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 03/05/18
 * Time: 10:37
 */

namespace MatheusHack\ItauBoleto\Helpers;

/**
 * Class Boleto
 * @package MatheusHack\ItauBoleto\Helpers
 */
class Boleto
{
    public static function value($value) {
         return $value;
    }

    public static function data_get($target, $key, $default = null) {

        if (is_null($key)) return $target;

        foreach (explode('.', $key) as $segment) {

            if (is_array($target)) {

                if ( ! array_key_exists($segment, $target)) {
                    return Boleto::value($default);
                }

                $target = $target[$segment];

            } elseif (is_object($target)) {

                if ( ! isset($target->{$segment})) {
                    return Boleto::value($default);
                }

                $target = $target->{$segment};

            } else {

                return Boleto::value($default);

            }

        }

        return $target;
        
    }


    /**
     * @param $num
     * @return int
     */
    public static function mod10($num)
    {
        $numtotal10 = 0;
        $fator = 2;

        for ($i = strlen($num); $i > 0; $i--) {
            $numeros[$i] = substr($num, $i-1, 1);
            $temp = $numeros[$i] * $fator;
            $temp0=0;

            foreach (preg_split('//', $temp, -1, PREG_SPLIT_NO_EMPTY) as $k => $v) {
                $temp0+=$v;
            }

            $parcial10[$i] = $temp0;
            $numtotal10 += $parcial10[$i];

            if ($fator == 2) {
                $fator = 1;
            } else {
                $fator = 2;
            }
        }

        $resto = $numtotal10 % 10;
        $digito = 10 - $resto;

        if ($resto == 0) {
            $digito = 0;
        }

        return $digito;
    }

    /**
     * @param $value
     * @param int $amount
     * @return string
     */
    public static function formatMoney($value, $amount = 1)
    {
        $money = str_replace(',', '', $value);
        $money = str_replace('.', '', $money);
        return str_pad($money, $amount, '0', STR_PAD_LEFT);
    }

    public static function formatDecimal($value, $amount = 1, $decimal = 2)
    {
        $money = str_replace(',', '', $value);
        $money = str_replace('.', '', $money);
        $money = str_pad($money, $amount, '0', STR_PAD_LEFT);
        $money = str_pad($money, $decimal, '0', STR_PAD_RIGHT);

        return $money;
    }

    /**
     * @param $value
     * @param int $amount
     * @return string
     */
    public static function formatString($value, $amount = 1)
    {
        return (string) str_pad($value, $amount, '0', STR_PAD_LEFT);
    }

    /**
     * @param $object
     * @return object
     */
    public static function removeNullValue($object)
    {
        return (object) array_filter((array) $object, function($var){
            return !is_null($var);
        });
    }

    /**
     * @param $cnpj
     * @return string
     */
    public static function formatCnpj($cnpj) {
        $cnpj = trim($cnpj);
        if(preg_match('/^[0-9]+$/', $cnpj)) {
            $aux = str_split($cnpj);
            array_splice($aux, 2, 0, '.');
            array_splice($aux, 6, 0, '.');
            array_splice($aux, 10, 0, '/');
            array_splice($aux, 15, 0, '-');
            return implode('', $aux);
        }

        return $cnpj;
    }

}
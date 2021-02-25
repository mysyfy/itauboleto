<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 19/04/18
 * Time: 11:14
 */

namespace MatheusHack\ItauBoleto\Validates;


use MatheusHack\ItauBoleto\Exceptions\ValidationException;

/**
 * Class BoletoValidate
 * @package MatheusHack\ItauBoleto\Validates
 */
class BoletoValidate
{
    /**
     * @param array $config
     * @throws ValidationException
     */
    public function config($config = [])
    {
        
        if(empty($config))
            throw new ValidationException('Necessário passar os dados de configuração para geração do boleto');

        if(!isset($config, 'clientId']))
            throw new ValidationException('A configuração clientId é obrigatória');

        if(!isset($config, 'clientSecret']))
            throw new ValidationException('A configuração clientSecret é obrigatória');

        if(!isset($config['itauKey']))
            throw new ValidationException('A configuração itauKey é obrigatória');

        if(!isset($config['cnpj']))
            throw new ValidationException('A configuração CNPJ é obrigatória');
    }
}
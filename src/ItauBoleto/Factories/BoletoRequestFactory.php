<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 18/04/18
 * Time: 11:23
 */

namespace MatheusHack\ItauBoleto\Factories;

use MatheusHack\ItauBoleto\Helpers\Boleto;
use MatheusHack\ItauBoleto\Requests\JurosRequest;
use MatheusHack\ItauBoleto\Requests\MoedaRequest;
use MatheusHack\ItauBoleto\Requests\MultaRequest;
use MatheusHack\ItauBoleto\Requests\BoletoRequest;
use MatheusHack\ItauBoleto\Requests\DebitoRequest;
use MatheusHack\ItauBoleto\Requests\PagadorRequest;
use MatheusHack\ItauBoleto\Requests\GrupoRateioRequest;
use MatheusHack\ItauBoleto\Requests\BeneficiarioRequest;
use MatheusHack\ItauBoleto\Requests\GrupoDescontoRequest;
use MatheusHack\ItauBoleto\Requests\SacadorAvalistaRequest;
use MatheusHack\ItauBoleto\Requests\GrupoEmailPagadorRequest;
use MatheusHack\ItauBoleto\Requests\RecebimentoDivergenteRequest;
use MatheusHack\ItauBoleto\Helpers;

/**
 * Class BoletoRequestFactory
 * @package MatheusHack\ItauBoleto\Factories
 */
class BoletoRequestFactory
{
    /**
     * @param array $boleto
     * @return object
     */
    public function make(array $boleto)
    {
        $boletoRequest = new BoletoRequest();

        $boletoRequest->tipo_ambiente = (int) Boleto::data_get($boleto, 'tipo_ambiente', $boletoRequest->tipo_ambiente);
        $boletoRequest->tipo_registro = (int) Boleto::data_get($boleto, 'tipo_registro', $boletoRequest->tipo_registro);
        $boletoRequest->tipo_cobranca = (int) Boleto::data_get($boleto, 'tipo_cobranca', $boletoRequest->tipo_cobranca);
        $boletoRequest->tipo_produto = Boleto::data_get($boleto, 'tipo_produto', $boletoRequest->tipo_produto);
        $boletoRequest->subproduto = Boleto::data_get($boleto, 'subproduto', $boletoRequest->subproduto);
        $boletoRequest->identificador_titulo_empresa = Boleto::data_get($boleto, 'identificador_titulo_empresa', $boletoRequest->identificador_titulo_empresa);
        $boletoRequest->uso_banco = Boleto::data_get($boleto, 'uso_banco', $boletoRequest->uso_banco);
        $boletoRequest->titulo_aceite = Boleto::data_get($boleto, 'titulo_aceite', $boletoRequest->titulo_aceite);
        $boletoRequest->tipo_carteira_titulo = Boleto::data_get($boleto, 'tipo_carteira_titulo', $boletoRequest->tipo_carteira_titulo);
        $boletoRequest->nosso_numero = Boleto::data_get($boleto, 'nosso_numero', $boletoRequest->nosso_numero);
        $boletoRequest->codigo_barras = Boleto::data_get($boleto, 'codigo_barras', $boletoRequest->codigo_barras);
        $boletoRequest->data_vencimento = Boleto::data_get($boleto, 'data_vencimento', $boletoRequest->data_vencimento);
        $boletoRequest->valor_cobrado = Boleto::formatMoney(Boleto::data_get($boleto, 'valor_cobrado', $boletoRequest->valor_cobrado), 17);
        $boletoRequest->seu_numero = Boleto::formatString(Boleto::data_get($boleto, 'seu_numero', $boletoRequest->seu_numero), 10);
        $boletoRequest->especie = Boleto::data_get($boleto, 'especie', $boletoRequest->especie);
        $boletoRequest->data_emissao = Boleto::data_get($boleto, 'data_emissao', $boletoRequest->data_emissao);
        $boletoRequest->data_limite_pagamento = Boleto::data_get($boleto, 'data_limite_pagamento', $boletoRequest->data_limite_pagamento);
        $boletoRequest->tipo_pagamento = Boleto::data_get($boleto, 'tipo_pagamento', $boletoRequest->tipo_pagamento);
        $boletoRequest->indicador_pagamento_parcial = Boleto::data_get($boleto, 'indicador_pagamento_parcial', $boletoRequest->indicador_pagamento_parcial);
        $boletoRequest->quantidade_pagamento_parcial = Boleto::data_get($boleto, 'quantidade_pagamento_parcial', $boletoRequest->quantidade_pagamento_parcial);
        $boletoRequest->quantidade_parcelas = Boleto::data_get($boleto, 'quantidade_parcelas', $boletoRequest->quantidade_parcelas);
        $boletoRequest->instrucao_cobranca_1 = Boleto::data_get($boleto, 'instrucao_cobranca_1', $boletoRequest->instrucao_cobranca_1);
        $boletoRequest->quantidade_dias_1 = Boleto::data_get($boleto, 'quantidade_dias_1', $boletoRequest->quantidade_dias_1);
        $boletoRequest->data_instrucao_1 = Boleto::data_get($boleto, 'data_instrucao_1', $boletoRequest->data_instrucao_1);
        $boletoRequest->instrucao_cobranca_2 = Boleto::data_get($boleto, 'instrucao_cobranca_2', $boletoRequest->instrucao_cobranca_2);
        $boletoRequest->quantidade_dias_2 = Boleto::data_get($boleto, 'quantidade_dias_2', $boletoRequest->quantidade_dias_2);
        $boletoRequest->data_instrucao_2 = Boleto::data_get($boleto, 'data_instrucao_2', $boletoRequest->data_instrucao_2);
        $boletoRequest->instrucao_cobranca_3 = Boleto::data_get($boleto, 'instrucao_cobranca_3', $boletoRequest->instrucao_cobranca_3);
        $boletoRequest->quantidade_dias_3 = Boleto::data_get($boleto, 'quantidade_dias_3', $boletoRequest->quantidade_dias_3);
        $boletoRequest->data_instrucao_3 = Boleto::data_get($boleto, 'data_instrucao_3', $boletoRequest->data_instrucao_3);
        $boletoRequest->valor_abatimento = Boleto::formatMoney(Boleto::data_get($boleto, 'valor_abatimento', $boletoRequest->valor_abatimento), 17);
        $boletoRequest->moeda = $this->setMoeda(Boleto::data_get($boleto, 'moeda', []));
        $boletoRequest->beneficiario =  $this->setBeneficiario(Boleto::data_get($boleto, 'beneficiario', []));
        $boletoRequest->pagador = $this->setPagador(Boleto::data_get($boleto, 'pagador', []));
        $boletoRequest->grupo_desconto = $this->setGrupoDesconto(Boleto::data_get($boleto, 'grupo_desconto', []));
        $boletoRequest->juros = $this->setJuros(Boleto::data_get($boleto, 'juros', []));
        $boletoRequest->multa = $this->setMulta(Boleto::data_get($boleto, 'multa', []));
        $boletoRequest->recebimento_divergente = $this->setRecebimentoDivergente(Boleto::data_get($boleto, 'recebimento_divergente', []));
        $boletoRequest->digito_verificador_nosso_numero = $this->makeDigitoVerificadorNossoNumero($boletoRequest);

        if(Boleto::data_get($boleto, 'debito'))
            $boletoRequest->debito =  $this->setDebito(Boleto::data_get($boleto, 'debito', []));

        if(Boleto::data_get($boleto, 'sacador_avalista'))
            $boletoRequest->sacador_avalista = $this->setSacadorAvalista(Boleto::data_get($boleto, 'sacador_avalista', []));

        if(Boleto::data_get($boleto, 'grupo_rateio'))
            $boletoRequest->grupo_rateio = $this->setGrupoRateio(Boleto::data_get($boleto, 'grupo_rateio', []));



        return Boleto::removeNullValue($boletoRequest);
    }

    /**
     * @param BoletoRequest $boletoRequest
     * @return int
     */
    private function makeDigitoVerificadorNossoNumero(BoletoRequest $boletoRequest)
    {
        $number = $boletoRequest->beneficiario->agencia_beneficiario.$boletoRequest->beneficiario->conta_beneficiario.$boletoRequest->tipo_carteira_titulo.$boletoRequest->nosso_numero;
        return Boleto::mod10($number);
    }

    /**
     * @param array $data
     * @return object
     */
    private function setBeneficiario($data = [])
    {
        $beneficiario = new BeneficiarioRequest();
        $beneficiario->cpf_cnpj_beneficiario = Boleto::data_get($data, 'documento_identificacao', $beneficiario->cpf_cnpj_beneficiario);
        $beneficiario->agencia_beneficiario = Boleto::formatString(Boleto::data_get($data, 'agencia', $beneficiario->agencia_beneficiario), 4);
        $beneficiario->conta_beneficiario = Boleto::formatString(Boleto::data_get($data, 'conta', $beneficiario->conta_beneficiario), 7);
        $beneficiario->digito_verificador_conta_beneficiario = Boleto::formatString(Boleto::data_get($data, 'digito_conta', $beneficiario->digito_verificador_conta_beneficiario), 1);

        return Boleto::removeNullValue($beneficiario);
    }

    /**
     * @param array $data
     * @return object
     */
    private function setDebito($data = [])
    {
        $debito = new DebitoRequest();
        $debito->agencia_debito = Boleto::formatString(Boleto::data_get($data, 'agencia', $debito->agencia_debito), 4);
        $debito->conta_debito = Boleto::formatString(Boleto::data_get($data, 'conta', $debito->conta_debito), 7);
        $debito->digito_verificador_conta_debito = Boleto::data_get($data, 'digito_conta', $debito->digito_verificador_conta_debito);

        return Boleto::removeNullValue($debito);
    }

    /**
     * @param array $data
     * @return object
     */
    private function setPagador($data = [])
    {
        $pagador = new PagadorRequest();
        $pagador->cpf_cnpj_pagador = Boleto::data_get($data, 'documento_identificacao', $pagador->cpf_cnpj_pagador);
        $pagador->nome_pagador = Boleto::data_get($data, 'nome', $pagador->nome_pagador);
        $pagador->logradouro_pagador = Boleto::data_get($data, 'logradouro', $pagador->logradouro_pagador);
        $pagador->bairro_pagador = Boleto::data_get($data, 'bairro', $pagador->bairro_pagador);
        $pagador->cidade_pagador = Boleto::data_get($data, 'cidade', $pagador->cidade_pagador);
        $pagador->uf_pagador = Boleto::data_get($data, 'uf', $pagador->uf_pagador);
        $pagador->cep_pagador = Boleto::data_get($data, 'cep', $pagador->cep_pagador);

        if(Boleto::data_get($data, 'emails'))
            $pagador->grupo_email_pagador = $this->setGrupoEmailPagador($data['emails']);

        return Boleto::removeNullValue($pagador);
    }

    /**
     * @param array $data
     * @return array
     */
    private function setGrupoEmailPagador($data = [])
    {
        $emails = [];

        foreach ($data as $email){
            $grupoEmailPagador = new GrupoEmailPagadorRequest();
            $grupoEmailPagador->email_pagador = $email;
            $emails[] = $grupoEmailPagador;
        }

        return $emails;
    }

    /**
     * @param array $data
     * @return object
     */
    private function setSacadorAvalista($data = [])
    {
        $sacadorAvalista = new SacadorAvalistaRequest();
        $sacadorAvalista->cpf_cnpj_sacador_avalista = Boleto::data_get($data, 'documento_identificacao', $sacadorAvalista->cpf_cnpj_sacador_avalista);
        $sacadorAvalista->nome_sacador_avalista = Boleto::data_get($data, 'nome', $sacadorAvalista->nome_sacador_avalista);
        $sacadorAvalista->logradouro_sacador_avalista = Boleto::data_get($data, 'logradouro', $sacadorAvalista->logradouro_sacador_avalista);
        $sacadorAvalista->bairro_sacador_avalista = Boleto::data_get($data, 'bairro', $sacadorAvalista->bairro_sacador_avalista);
        $sacadorAvalista->cidade_sacador_avalista = Boleto::data_get($data, 'cidade', $sacadorAvalista->cidade_sacador_avalista);
        $sacadorAvalista->uf_sacador_avalista = Boleto::data_get($data, 'uf', $sacadorAvalista->uf_sacador_avalista);
        $sacadorAvalista->cep_sacador_avalista = Boleto::data_get($data, 'cep', $sacadorAvalista->cep_sacador_avalista);

        return Boleto::removeNullValue($sacadorAvalista);
    }

    /**
     * @param array $data
     * @return object
     */
    private function setMoeda($data = [])
    {
        $moeda = new MoedaRequest();
        $moeda->codigo_moeda_cnab = Boleto::formatString(Boleto::data_get($data, 'codigo', $moeda->codigo_moeda_cnab), 2);

        return Boleto::removeNullValue($moeda);
    }

    /**
     * @param array $data
     * @return object
     */
    private function setJuros($data = [])
    {
        $juros = new JurosRequest();
        $juros->data_juros = Boleto::data_get($data, 'data', $juros->data_juros);
        $juros->tipo_juros = Boleto::data_get($data, 'tipo', $juros->tipo_juros);
        $juros->valor_juros = Boleto::formatDecimal(Boleto::data_get($data, 'valor', $juros->valor_juros),15, 2);
        $juros->percentual_juros = Boleto::formatDecimal(Boleto::data_get($data, 'percentual', $juros->percentual_juros),7, 5);

        return Boleto::removeNullValue($juros);
    }

    /**
     * @param array $data
     * @return object
     */
    private function setMulta($data = [])
    {
        $multa = new MultaRequest();
        $multa->data_multa = Boleto::data_get($data, 'data', $multa->data_multa);
        $multa->tipo_multa = Boleto::data_get($data, 'tipo', $multa->tipo_multa);
        $multa->valor_multa = Boleto::formatDecimal(Boleto::data_get($data, 'valor', $multa->valor_multa), 15, 2);
        $multa->percentual_multa = Boleto::formatDecimal(Boleto::data_get($data, 'percentual', $multa->percentual_multa),7, 5);

        return Boleto::removeNullValue($multa);
    }

    /**
     * @param array $data
     * @return array
     */
    private function setGrupoDesconto($data = [])
    {
        $returnGrupoDesconto = [];
        $grupoArray = (array_key_exists(0, $data) ? $data : [$data]);

        foreach($grupoArray as $grupo){
            $grupoDesconto = new GrupoDescontoRequest();
            $grupoDesconto->data_desconto = Boleto::data_get($grupo, 'data', $grupoDesconto->data_desconto);
            $grupoDesconto->tipo_desconto = Boleto::data_get($grupo, 'tipo', $grupoDesconto->tipo_desconto);
            $grupoDesconto->valor_desconto = Boleto::data_get($grupo, 'valor', $grupoDesconto->valor_desconto);
            $grupoDesconto->percentual_desconto = Boleto::data_get($grupo, 'percentual', $grupoDesconto->percentual_desconto);

            $returnGrupoDesconto[] = Boleto::removeNullValue($grupoDesconto);
        }

        return $returnGrupoDesconto;
    }

    /**
     * @param array $data
     * @return object
     */
    private function setRecebimentoDivergente($data = [])
    {
        $recebimentoDivergente = new RecebimentoDivergenteRequest();
        $recebimentoDivergente->tipo_autorizacao_recebimento = Boleto::formatString(Boleto::data_get($data, 'tipo_autorizacao', $recebimentoDivergente->tipo_autorizacao_recebimento), 1);
        $recebimentoDivergente->tipo_valor_percentual_recebimento = Boleto::data_get($data, 'tipo_valor_percentual', $recebimentoDivergente->tipo_valor_percentual_recebimento);
        $recebimentoDivergente->valor_minimo_recebimento = Boleto::data_get($data, 'valor_minimo', $recebimentoDivergente->valor_minimo_recebimento);
        $recebimentoDivergente->percentual_minimo_recebimento = Boleto::data_get($data, 'percentual_minimo', $recebimentoDivergente->percentual_minimo_recebimento);
        $recebimentoDivergente->valor_maximo_recebimento = Boleto::data_get($data, 'valor_maximo', $recebimentoDivergente->valor_maximo_recebimento);
        $recebimentoDivergente->percentual_maximo_recebimento = Boleto::data_get($data, 'percentual_maximo', $recebimentoDivergente->percentual_maximo_recebimento);

        return Boleto::removeNullValue($recebimentoDivergente);
    }

    /**
     * @param array $data
     * @return object
     */
    private function setGrupoRateio($data = [])
    {
        $grupoRateio = new GrupoRateioRequest();
        $grupoRateio->agencia_grupo_rateio = Boleto::data_get($data, 'agencia', $grupoRateio->agencia_grupo_rateio);
        $grupoRateio->conta_grupo_rateio = Boleto::data_get($data, 'conta', $grupoRateio->conta_grupo_rateio);
        $grupoRateio->digito_verificador_conta_grupo_rateio = Boleto::data_get($data, 'digito_conta', $grupoRateio->digito_verificador_conta_grupo_rateio);
        $grupoRateio->tipo_rateio = Boleto::data_get($data, 'tipo', $grupoRateio->tipo_rateio);
        $grupoRateio->valor_percentual_rateio = Boleto::data_get($data, 'valor_percentual', $grupoRateio->valor_percentual_rateio);

        return Boleto::removeNullValue($grupoRateio);
    }
}
<?php
    /**
     * Classe de funcoes para auxilio
     * 
     * @autor juscelino
     */

//função que converte ponto para insert em Banco de Dados
function convertePonto($valor) {
    //trocando virgula por ponto e ponto por ponto
    //if(!strpos($valor,".")&&(strpos($valor,","))){

    $valor = (($valor != '') ? $valor : 0);
    //troca o ponto por vazio
    $valor = str_replace(".", "", $valor);
    //$valor = substr_replace($valor, '.', strpos($valor, ","), 1);
    //troca virgula por ponto
    $valor = str_replace(",", ".", $valor);

    //}
    return $valor;
}

// função para inversão de data
function inverteData($data, $separar = '/', $juntar = '/') {
    if (!empty($data)) {
        return implode($juntar, array_reverse(explode($separar, $data)));
    } else {
        return NULL;
    }
}

function inverteDataUsuario($data, $separar = '-', $juntar = '/') {
    if (!empty($data)) {
        return implode($juntar, array_reverse(explode($separar, $data)));
    } else {
        return NULL;
    }
}

// função que retorna data personalizada
function dt_hoje($cidade, $uf) {
    $meses = array(1 => "Janeiro",
        2 => "Fevereiro",
        3 => "Março",
        4 => "Abril",
        5 => "Maio",
        6 => "Junho",
        7 => "Julho",
        8 => "Agosto",
        9 => "Setembro",
        10 => "Outubro",
        11 => "Novembro",
        12 => "Dezembro");

    $hoje = getdate();
    $dia = $hoje["mday"];
    $mes = $hoje["mon"];
    $nomeMes = $meses[$mes];
    $ano = $hoje["year"];

    $data1 = $cidade . ", " . $uf . ", " . $dia . " de " . $nomeMes . " de " . $ano;

    return $data1;
}

/**
 * Função para calcular o próximo dia útil de uma data
 * Formato de entrada da $data: AAAA-MM-DD
 */
function proximoDiaUtil($data, $saida = 'd/m/Y') {
    // Converte $data em um UNIX TIMESTAMP
    $timestamp = strtotime($data);

    // Calcula qual o dia da semana de $data
    // O resultado será um valor numérico:
    // 1 -> Segunda ... 7 -> Domingo
    $dia = date('N', $timestamp);

    // Se for sábado (6) ou domingo (7), calcula a próxima segunda-feira
    if ($dia >= 6) {
        $timestamp_final = $timestamp + ((8 - $dia) * 3600 * 24);
    } else {
        // Não é sábado nem domingo, mantém a data de entrada
        $timestamp_final = $timestamp;
    }

    return date($saida, $timestamp_final);
}

/**
 * Função para calcular uma data a partir de um número de dias fornecido
 * Formato de entrada da $data: NrDias, AAAA-MM-DD
 */
function adcDiasData($dias, $data, $saida = 'd/m/Y') {
    // Converte $data em um UNIX TIMESTAMP
    $timestamp = strtotime($data);
    // converte o número de dias para o formato UNIX e adicionando a data informada
    $timestamp_final = $timestamp + (($dias) * 3600 * 24);

    return date($saida, $timestamp_final);
}

function adcDiasData2($dias, $data, $saida = 'Y/m/d') {
    // Converte $data em um UNIX TIMESTAMP
    $timestamp = strtotime($data);
    // converte o número de dias para o formato UNIX e adicionando a data informada
    $timestamp_final = $timestamp + (($dias) * 3600 * 24);

    return date($saida, $timestamp_final);
}

function rcount($array) {
    $count = 0;
    if (is_array($array)) {
        foreach ($array as $id => $sub) {
            if (!is_array($sub)) {
                $count++;
            } else {
                $count = ($count + rcount($sub));
            }
        }
        return $count;
    }
    return FALSE;
}

function calculaDiasEntreDatas($de, $ate) {
    //formato de data Y/m/d naentrada e na saida
    // Converte $data em um UNIX TIMESTAMP
    $timestampDe = strtotime($de);
    $timestampAte = strtotime($ate);
    // converte o número de dias para o formato UNIX e adicionando a data informada
    $dias = ($timestampAte - $timestampDe) / (3600 * 24);

    return $dias;
}

function adcMinutosData($min, $data, $saida = 'Y/m/d H:i:s') {
    // Converte $data em um UNIX TIMESTAMP
    $timestamp = strtotime($data);
    // converte o número de dias para o formato UNIX e adicionando a data informada
    $timestamp_final = $timestamp + (($min) * 60);

    return date($saida, $timestamp_final);
}
?>



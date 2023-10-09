<?php
function calcularDistancia($cepInicial, $cepFinal, $apiKey) {
    // Obtenha as coordenadas do CEP inicial
    $coordenadasInicial = obterCoordenadasPorCEP($cepInicial, $apiKey);

    // Obtenha as coordenadas do CEP final
    $coordenadasFinal = obterCoordenadasPorCEP($cepFinal, $apiKey);

    // Calcule a distância entre as coordenadas
    $distanciaMetros = calcularDistanciaEntreCoordenadas($coordenadasInicial, $coordenadasFinal);

    // Converta a distância para quilômetros
    $distanciaKm = $distanciaMetros / 1000;

    // Arredonde para 1 casa decimal
    $distanciaKm = round($distanciaKm, 1);

    return $distanciaKm;
}

function obterCoordenadasPorCEP($cep, $apiKey) {
    // Formate o CEP removendo caracteres não numéricos
    $cepFormatado = preg_replace('/[^0-9]/', '', $cep);

    // Construa a URL da API do Google Maps Geocoding
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$cepFormatado}&key={$apiKey}";

    // Faça uma requisição HTTP para obter os dados
    $response = file_get_contents($url);

    // Decodifique a resposta JSON
    $data = json_decode($response);

    // Verifique se a solicitação foi bem-sucedida
    if ($data->status === 'OK') {
        // Obtenha as coordenadas
        $coordenadas = $data->results[0]->geometry->location;

        return $coordenadas;
    } else {
        // Retorne false se a solicitação falhar
        return false;
    }
}

function calcularDistanciaEntreCoordenadas($coordenadasInicial, $coordenadasFinal) {
    // Raio da Terra em metros
    $raioTerra = 6371000;

    // Converte graus para radianos
    $lat1 = deg2rad($coordenadasInicial->lat);
    $lon1 = deg2rad($coordenadasInicial->lng);
    $lat2 = deg2rad($coordenadasFinal->lat);
    $lon2 = deg2rad($coordenadasFinal->lng);

    // Calcula as diferenças nas coordenadas
    $dlat = $lat2 - $lat1;
    $dlon = $lon2 - $lon1;

    // Fórmula de Haversine para calcular a distância
    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    // Distância em metros
    $distancia = $raioTerra * $c;

    return $distancia;
}

function calcularTaxa($distancia, $cupom = null) {
    // Define o valor mínimo por km
    $valorPorKM = 1.50;

    // Define o valor mínimo
    $valorMinimo = 5;

    // Define a distância mínima para cobrança
    $distanciaMinima = 2;

    // Calcula o valor base
    $valorBase = 0;

    if ($distancia <= $distanciaMinima) {
        // Se a distância for menor ou igual à distância mínima, cobra o valor mínimo
        $valorBase = $valorMinimo;
    } else {
        // Se a distância for maior que a distância mínima, calcula o valor com base na taxa por km
        $valorBase = $valorMinimo + (($distancia - $distanciaMinima) * $valorPorKM);
    }

    // Aplicar desconto do cupom se fornecido
    if ($cupom) {
        $desconto = obterDescontoCupom($cupom, $valorBase);
        $valorBase -= $desconto;
    }

    return number_format($valorBase, 2, ',', '.'); // Formata o valor para exibição
}

function obterDescontoCupom($cupom, $valorBase) {
    // Array associativo de cupons e seus respectivos descontos
    $cupons = [
        'FAZOELI5' => ['tipo' => 'valor', 'valor' => 5],
        'FAZOELI10' => ['tipo' => 'valor', 'valor' => 10],
        'FAZOELI20' => ['tipo' => 'valor', 'valor' => 20],
        'FAZOELI30' => ['tipo' => 'valor', 'valor' => 30],
        'FAZOELI50' => ['tipo' => 'valor', 'valor' => 50],
        'CUPOM5P' => ['tipo' => 'porcentagem', 'valor' => 5],
        'CUPOM10P' => ['tipo' => 'porcentagem', 'valor' => 10],
        'CUPOM15P' => ['tipo' => 'porcentagem', 'valor' => 15],
        'CUPOM20P' => ['tipo' => 'porcentagem', 'valor' => 20],
        'FAZOELI50OFF' => ['tipo' => 'porcentagem', 'valor' => 50],
    ];

    // Verificar se o cupom existe no array
    if (array_key_exists($cupom, $cupons)) {
        $tipo = $cupons[$cupom]['tipo'];
        $valorDesconto = $cupons[$cupom]['valor'];

        // Aplicar desconto conforme o tipo
        if ($tipo === 'valor') {
            return $valorDesconto;
        } elseif ($tipo === 'porcentagem') {
            // Calcular o desconto em porcentagem
            $descontoPorcentagem = ($valorDesconto / 100) * $valorBase;
            return $descontoPorcentagem;
        }
    }

    // Retorna 0 se o cupom não for válido
    return 0;
}

function obterEnderecoPorCEP($cep, $apiKey) {
    // Formate o CEP removendo caracteres não numéricos
    $cepFormatado = preg_replace('/[^0-9]/', '', $cep);

    // Construa a URL da API do Google Maps Geocoding
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$cepFormatado}&key={$apiKey}";

    // Faça uma requisição HTTP para obter os dados
    $response = file_get_contents($url);

    // Decodifique a resposta JSON
    $data = json_decode($response);

    // Verifique se a solicitação foi bem-sucedida
    if ($data->status === 'OK') {
        // Obtenha o endereço
        $endereco = $data->results[0]->formatted_address;

        return $endereco;
    } else {
        // Retorne false se a solicitação falhar
        return false;
    }
}
?>

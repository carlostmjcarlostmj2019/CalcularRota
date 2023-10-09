# CalcularRota
Codigo em PHP pra Calcular Rota

Atenção o codigo foi criado por mim utilizando ChatGPT pra possiveis correçoes entre outros


Lembre-se de alterar as variaveis das funçao de calcular taxa para seus valores corretos
valor por km
valor por rota
km minimo etc

em caso de melhorias e soluçoes me envie pra atualizar!
obs: da mesma forma que ajudei voce, espero que ajude os outros!







Cálculo de Distância entre CEPs e Taxa com Cupom
Este código PHP fornece funções para calcular a distância entre dois CEPs e calcular uma taxa com a opção de aplicar um cupom de desconto. Ele utiliza a API do Google Maps Geocoding para obter as coordenadas geográficas a partir dos CEPs e, em seguida, calcula a distância entre essas coordenadas usando a fórmula de Haversine. Além disso, ele calcula uma taxa com base na distância e no cupom de desconto (se aplicável).

Uso do Código
Configuração da API Key do Google Maps:
Antes de usar este código, você deve fornecer uma chave de API válida do Google Maps. Substitua 'SUA_API_KEY' pelo seu valor na chamada da função obterCoordenadasPorCEP.

Exemplo de Uso:

php
Copy code
$cepInicial = 'CEP_INICIAL';
$cepFinal = 'CEP_FINAL';
$apiKey = 'SUA_API_KEY';

// Calcular a distância entre os CEPs
$distanciaKm = calcularDistancia($cepInicial, $cepFinal, $apiKey);

// Calcular a taxa com um cupom de desconto (opcional)
$cupom = 'SEU_CUPOM';
$taxaComCupom = calcularTaxa($distanciaKm, $cupom);

// Obter o endereço a partir de um CEP
$cepParaEndereco = 'CEP_PARA_ENDERECO';
$endereco = obterEnderecoPorCEP($cepParaEndereco, $apiKey);
Funções Disponíveis:

calcularDistancia($cepInicial, $cepFinal, $apiKey): Calcula a distância em quilômetros entre dois CEPs.
obterCoordenadasPorCEP($cep, $apiKey): Obtém as coordenadas geográficas a partir de um CEP.
calcularTaxa($distancia, $cupom = null): Calcula uma taxa com base na distância (em quilômetros) e um cupom de desconto opcional.
obterDescontoCupom($cupom, $valorBase): Obtém o valor de desconto com base em um cupom.
obterEnderecoPorCEP($cep, $apiKey): Obtém o endereço a partir de um CEP.
Cupons Disponíveis:
O código inclui uma lista de cupons e seus respectivos descontos. Você pode adicionar, remover ou modificar os cupons no array associativo $cupons.

Notas Importantes
Este código depende da disponibilidade e funcionamento da API do Google Maps Geocoding.
Certifique-se de que sua chave de API do Google Maps esteja configurada corretamente.
Certifique-se de que todas as funções sejam chamadas com os parâmetros corretos.
Lembre-se de substituir 'SUA_API_KEY', 'CEP_INICIAL', 'CEP_FINAL', 'SEU_CUPOM' e 'CEP_PARA_ENDERECO' pelos valores reais que deseja utilizar.

Este código é uma ferramenta útil para calcular distâncias entre locais com base em CEPs e calcular taxas com cupons de desconto. Certifique-se de testar e adaptar conforme necessário para atender aos requisitos específicos do seu projeto.

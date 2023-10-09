<h1>Calculadora de Rotas em PHP</h1>

<p>Este código em PHP foi desenvolvido para calcular rotas com base em CEPs, utilizando a API do Google Maps Geocoding. Ele também inclui funcionalidades para calcular a taxa da rota, considerando valores como preço por quilômetro, preço mínimo por rota, entre outros. O código foi inicialmente criado com a assistência do ChatGPT e está aberto a contribuições para melhorias.</p>

<h2>Uso</h2>

<h4>Configuração da Chave da API do Google Maps:</h4>
<p> usar este código, substitua <code>'SUA_CHAVE_API'</code> pelo valor da sua chave de API do Google Maps na chamada da função <code>obterCoordenadasPorCEP</code>.</p>
<h4>Variáveis de Configuração:</h4>
       <p> No código, você encontrará variáveis relacionadas ao cálculo da taxa, como <code>valorPorKM</code>, <code>valorMinimoPorRota</code>, e <code>distanciaMinimaParaCobranca</code>. Certifique-se de ajustar esses valores de acordo com os requisitos do seu sistema.</p>

<h4>Exemplo de Uso:</h4><br>
        

<pre>
<code>
$cepInicial = 'CEP_INICIAL';
$cepFinal = 'CEP_FINAL';
$apiKey = 'SUA_CHAVE_API';

// Calcular a distância entre os CEPs
$distanciaKm = calcularDistancia($cepInicial, $cepFinal, $apiKey);

// Calcular a taxa da rota
$taxaDaRota = calcularTaxa($distanciaKm);

// Exibir o resultado
echo "Distância: {$distanciaKm} km\n";
echo "Taxa da Rota: R$ {$taxaDaRota}\n";
</code>
</pre>

<ol start="4">
    <li><strong>Funções Disponíveis:</strong><br>
        <ul>
            <li><code>calcularDistancia($cepInicial, $cepFinal, $apiKey)</code>: Calcula a distância em quilômetros entre dois CEPs.</li>
            <li><code>obterCoordenadasPorCEP($cep, $apiKey)</code>: Obtém as coordenadas geográficas a partir de um CEP.</li>
            <li><code>calcularTaxa($distancia)</code>: Calcula a taxa da rota com base na distância em quilômetros.</li>
        </ul>
    </li>

    <li><strong>Observações:</strong><br>
        <ul>
            <li>Este código utiliza a API do Google Maps Geocoding, então é necessário ter uma chave de API válida.</li>
            <li>As variáveis de configuração como <code>valorPorKM</code>, <code>valorMinimoPorRota</code>, e <code>distanciaMinimaParaCobranca</code> devem ser ajustadas conforme a política de preços do serviço.</li>
        </ul>
    </li>

    <li><strong>Contribuições e Melhorias:</strong><br>
        Este código está aberto a contribuições. Caso tenha sugestões de melhorias ou soluções, sinta-se à vontade para enviar suas alterações.
    </li>
</ol>

<p>Lembre-se de substituir <code>'SUA_CHAVE_API'</code>, <code>'CEP_INICIAL'</code>, <code>'CEP_FINAL'</code> pelos valores reais que deseja utilizar.</p>

<p>Espero que este código seja útil, e da mesma forma que ajudou você, espero que ajude outros desenvolvedores. Caso tenha alguma dúvida ou sugestão, não hesite em entrar em contato!</p>

</body>
</html>

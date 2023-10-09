<?php 
include("functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Distância</title>
    <!-- Adicione os links para o Bootstrap e Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #007bff;
        }

        .navbar-brand {
            color: #fff;
        }

        .navbar-nav {
            color: #fff;
        }

        .container {
            margin-top: 20px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #000; /* Adiciona borda preta de 2px */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .result-container {
            margin-top: 20px;
        }

        #cupom-input {
            display: none;
        }

        /* Estilos adicionais para o botão */
        .btn-custom {
            width: 100%; /* Botão com largura de 100% */
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Delivery System - Calcular Rota</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Menu 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Menu 2</a>
                </li>
                <!-- Adicione mais itens de menu conforme necessário -->
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center"> <!-- Centraliza o conteúdo -->
            <div class="col-md-6">
                <div class="form-container">
                    <h2 class="text-center mb-4">Calcular Rota</h2>

                    <form method="post" action="">
                        <div class="form-group">
                            <label for="cepFinal">CEP Final:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="cepFinal" name="cepFinal"
                                    placeholder="Digite o CEP final" required>
                            </div>
                        </div>

                        <div id="cupom-link" class="form-group">
                            <a href="javascript:void(0);" onclick="toggleCupomInput()">Utilizar Cupom de Desconto?</a>
                        </div>

                        <div id="cupom-input" class="form-group">
                            <label for="cupom">Cupom de Desconto:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="cupom" name="cupom"
                                    placeholder="Digite o cupom">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-custom"> <!-- Adiciona a classe btn-custom -->
                            Consultar <i class="fas fa-calculator"></i>
                        </button>
                    </form>

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $cepInicial = "21320-190";
                        $cepFinal = $_POST['cepFinal'];
                        $cupom = isset($_POST['cupom']) ? $_POST['cupom'] : null;
                        $apiKey = "SUA API";

                        $distancia = calcularDistancia($cepInicial, $cepFinal, $apiKey);
                        $valorTaxa = calcularTaxa($distancia, $cupom);
                        $enderecoCepFinal = obterEnderecoPorCEP($cepFinal, $apiKey);

                        if ($distancia !== false && $enderecoCepFinal !== false) {
                            echo "<div class='result-container alert alert-success'>";
                            echo "<p>{$enderecoCepFinal}</p>";
                            echo "<p>Distância ({$distancia} km)</p>";
                            echo "<p>Valor da taxa: R$ {$valorTaxa}</p>";
                            if ($cupom) {
                                echo "<p>Utilizando o cupom: {$cupom}</p>";
                            }
                            echo "</div>";
                        } else {
                            echo "<div class='result-container alert alert-danger'>Erro ao calcular a distância ou obter o endereço do CEP final.</div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Adicione os scripts do Bootstrap e jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function toggleCupomInput() {
            var cupomLink = document.getElementById("cupom-link");
            var cupomInput = document.getElementById("cupom-input");

            // Esconde o link de cupom
            cupomLink.style.display = "none";

            // Exibe o campo de entrada do cupom
            cupomInput.style.display = "block";
        }
    </script>

</body>

</html>

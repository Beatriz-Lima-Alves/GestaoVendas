<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/919090d1f1.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-sans antialiased">

<div class="min-h-screen flex " style="background-color: #0f1e21">
@include('layouts.aside') <!-- Menu lateral -->

    <div class="flex-1 margem-body">
        <!-- Conteúdo da página -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main class="py-6 px-4 sm:px-6 lg:px-8">
            <canvas id="productSalesChart" width="800" height="400"></canvas>

            <div class="flex">
                <div class="top-products">
                    <h2>Top 3 Produtos Mais Vendidos:</h2>
                    <ul>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach ($topThreeProducts as $product)
                            <li>{{ $counter }}º - {{ $product->nome }}</li>
                            <hr>
                            @php
                                $counter++;
                            @endphp
                        @endforeach
                    </ul>
                </div>

                <div class="top-products">
                    <h2>Top 3 Produtos com Mais Quantidade em Estoque:</h2>
                    <ul>
                        @php
                            $counterEstoque = 1;
                        @endphp
                        @foreach ($topThreeStockProducts as $estoque)
                            <li>{{ $counterEstoque }}º - {{ $estoque->nome_produtos }}</li>
                            <hr>
                            @php
                                $counterEstoque++;
                            @endphp
                        @endforeach
                    </ul>
                </div>
            </div>

        </main>
    </div>
</div>
<script>
    var ctx = document.getElementById('productSalesChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($productNames),
            color: '#ffffff',

            datasets: [
                {
                    label: 'Quantidade em Estoque',
                    data: @json($stockQuantities),
                    backgroundColor: 'rgb(100,184,62)',
                    borderColor: 'rgb(32,255,69)',
                    borderWidth: 1
                },
                {
                    label: 'Quantidade Vendida',
                    data: @json($soldQuantities),
                    backgroundColor: 'rgba(39,101,115,0.53)',
                    borderColor: 'rgb(39,101,115)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                x: {
                    ticks: {
                        color: 'white' // Define a cor do texto do eixo X para branco
                    },
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: 'white' // Define a cor do texto do eixo X para branco
                    },
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Vendas e Estoque dos Produtos',
                    font: {
                        size: '24', // Define o tamanho do título como h1 (24px)
                        weight: 'bold' // Define o peso da fonte como negrito
                    },
                    color: 'white' // Define a cor do título para branco
                },
                legend: {
                    labels: {
                        color: 'white' // Define a cor dos rótulos para branco
                    }
                }
            }
        }
    });
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Vendas - Uva')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    @media (prefers-color-scheme: dark) {
        body {
            background-color: #111827;
            color: #f8f9fa;
        }

        .navbar, .card, a, .modal-content {
            background-color: #1f2937;
            border-color: #454d55;
            color: #f8f9fa !important
        }

        td, tr{
            color: #f8f9fa !important
        }

        .form-control {
            background-color: #454d55;
            color: #f8f9fa;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    }
</style>

</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light p-4 ">
            <a class="navbar-brand  " href="{{ url('/login') }}">Sistema de Vendas - Uva</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('produtos.list') }}">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('carrinho.index') }}">Carrinho</a>
                    </li>
                </ul>
            </div>
        </nav>

    </header>

    <main class="container mt-4">
        @yield('content')
    </main>

    {{-- <footer class="mt-4">
        <p class="text-center">&copy; 2024 Sua Empresa</p>
    </footer> --}}

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

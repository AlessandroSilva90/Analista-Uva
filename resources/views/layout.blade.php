<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Vendas - Uva')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #111827;
                color: #f8f9fa;
            }

            .navbar,
            .card,
            a,
            .modal-content,
            .dropdown-menu,
            .dropdown-item {
                background-color: #1f2937;
                border-color: #454d55;
                color: #f8f9fa !important
            }

            .dropdown-item:hover {
                background-color: #334053 !important;
            }

            td,
            tr {
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
        </nav>

        <nav class="navbar navbar-expand-lg navbar-light p-4 w-full">
            <a class="navbar-brand" href="{{ url('/login') }}">Sistema de Vendas - Uva</a>
            <div class="container-fluid">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('produtos.list') }}">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('carrinho.index') }}">Carrinho</a>
                    </li>
                </ul>

                @if (auth()->check())
                    <!-- Empurra o link do carrinho para a direita -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <!-- Exemplo de itens no carrinho -->
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <label class="dropdown-item"
                                            onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            Sair
                                        </label>
                                    </form>
                                </li>
                            </ul>
                @endif
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

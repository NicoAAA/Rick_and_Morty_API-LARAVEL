<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rick and Morty</title>

    <!-- Incluir Bootstrap desde CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Incluir archivo CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Rick and Morty</h1>
        <form method="GET" action="{{ route('characters') }}" id="searchForm" class="mb-4 position-relative">
            <div class="input-group">
                <input type="text" name="name" id="searchInput" class="form-control" placeholder="Buscar por nombre" value="{{ request()->query('name') }}">
                <input type="text" name="species" class="form-control" placeholder="Buscar por especie" value="{{ request()->query('species') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
            <button id="showAll" class="btn btn-secondary mt-2">Ver Todos los Personajes</button>
            <div id="suggestions" class="list-group"></div>
        </form>

        @if (isset($info))
            <div class="d-flex justify-content-between mb-4">
                @if ($info['prev'])
                    <a href="{{ route('characters', array_merge(request()->all(), ['page' => $info['prev']])) }}" class="btn btn-outline-secondary">Anterior</a>
                @endif

                @if ($info['next'])
                    <a href="{{ route('characters', array_merge(request()->all(), ['page' => $info['next']])) }}" class="btn btn-outline-secondary">Siguiente</a>
                @endif
            </div>
        @endif

        <div class="row">
            @if (empty($characters))
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        No se encontraron personajes.
                    </div>
                </div>
            @else
                @foreach ($characters as $character)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            <img src="{{ $character['image'] }}" alt="{{ $character['name'] }}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $character['name'] }}</h5>
                                <p class="card-text">Status: {{ $character['status'] }}</p>
                                <p class="card-text">Especie: {{ $character['species'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Incluir jQuery desde CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Incluir Popper.js y Bootstrap JS desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- Incluir archivo JS personalizado -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>



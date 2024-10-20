<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rick and Morty</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class= "mb-4">Rick and Morty</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Species</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($characters as $character)
                    <tr>
                        <td>{{ $character['name'] }}</td>
                        <td>{{ $character['status'] }}</td>
                        <td>{{ $character['species'] }}</td>
                        <td><img src="{{ $character['image'] }}" alt="{{ $character['name'] }}" width="100"></td>
                    </tr> 
                @endforeach
            </tbody>
        </table>
    </div>   
</body>
</html>
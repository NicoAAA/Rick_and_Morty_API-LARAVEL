<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RickMortyController extends Controller
{   
    //Método para obtener los personajes de Rick y Morty
    public function getCharacters()
    {   
        //Crear un cliente Guzzle
        $client = new Client();


        // Obtener el número de página, nombre y especie de los parámetros de la solicitud
        $page = $request->query('page', 1);
        $name = $request->query('name', null);
        $species = $request->query('species', null);

        //Hacer una petición GET a la API de Rick y Morty
        $response = $client->get('https://rickandmortyapi.com/api/character');
        
        //Decodificar la respuesta JSON
        $characters = json_decode($response->getBody()->getContents(), true);
        
        //Retornar la vista 'characters' con los personajes obtenidos
        return view('characters', ['characters' => $characters['results']]);
    }

}

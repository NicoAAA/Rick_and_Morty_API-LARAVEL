<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class RickMortyController extends Controller
{
    // Método para obtener los personajes de Rick y Morty
    public function getCharacters(Request $request)
    {
        $client = new Client();
        $queryParams = [];

        if ($request->filled('name')) {
            $queryParams['name'] = $request->input('name');
        }
        
        if ($request->filled('species')) {
            $queryParams['species'] = $request->input('species');
        }

        $info = [];
        $characters = [];

        try {
            $page = $request->query('page', 1);
            $name = $request->query('name', null);
            $species = $request->query('species', null);

            $query = [
                'page' => $page,
                'name' => $name,
                'species' => $species,
            ];

            $query = array_filter($query);

            $response = $client->get('https://rickandmortyapi.com/api/character', [
                'query' => $query
            ]);
            
            $characters = json_decode($response->getBody()->getContents(), true);

            return view('characters', [
                'characters' => $characters['results'],
                'info' => $characters['info']
            ]);
        } catch (RequestException $e) {
            return response()->json(['error' => 'Error al obtener personajes: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocurrió un error inesperado: ' . $e->getMessage()], 500);
        }
    }

    // Método para autocompletar
    public function autocomplete(Request $request)
    {
        $client = new Client();
        $queryParams = [];

        if ($request->filled('name')) {
            $queryParams['name'] = $request->input('name');
        }

        try {
            $response = $client->get('https://rickandmortyapi.com/api/character', [
                'query' => $queryParams
            ]);

            $characters = json_decode($response->getBody()->getContents(), true);
            return response()->json($characters['results']);
        } catch (RequestException $e) {
            return response()->json(['error' => 'Error al obtener personajes: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocurrió un error inesperado: ' . $e->getMessage()], 500);
        }
    }
}



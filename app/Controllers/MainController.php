<?php

namespace Pokedex\Controllers;

use Pokedex\Models\Pokemon;
use Pokedex\Models\Type;

class MainController
{
    // Displaying the pokemon list (homepage)
    public function list()
    {
        // Get all the pokemons
        $pokemonModel = new Pokemon();
        $pokemons = $pokemonModel->findAll();
        
        $this->show('list', [
            'pokemons' => $pokemons
        ]);
    }    

    // Displaying the pokemon details
    public function details($pokemonId)
    {
        // Get the pokemon
        $pokemonObject = new Pokemon();
        $pokemon = $pokemonObject->find($params['numero']);
        $types = $pokemon->getTypes();
        
        $this->show('details', [
            'title' => 'accueil',
            'pokemon' => $pokemon,
            'types' => $types
        ]);
    }

    // Displaying the type list
    public function types()
    {
        // Get all the types
        $typeObject = new Type();
        $types = $typeObject->findAll();

        $this->show('types', [
            'title' => 'Liste des types',
            'types' => $types
        ]);
    }

    // Displaying the pokemon list by type
    public function type($params)
    {
        // Get the type
        $typeObject = new Type();
        $pokemons = $pokemonObject->find($params['type']);

        $this->show('list', [
            'title' => 'Filtre par type ',
            'pokemons' => $pokemons
        ]);
    }

    public function notFound()
    {
        header('HTTP/1.0 404 Not Found');
        $this->show('error404', [
            'title' => 'Page inexistante - 404'
        ]);
    }

    public function show($viewname, $viewVars = [])
    {
        require __DIR__.'/../views/header.tpl.php';
        require __DIR__.'/../views/'.$viewname.'.tpl.php';
        require __DIR__.'/../views/footer.tpl.php';
    }
}
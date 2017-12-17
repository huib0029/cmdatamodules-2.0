<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{
    // Project controller voor het laten zien (inladen) van van alle projecten
    public function index()
    {
        $projects = DB::table('projects')->get();

        return view('projects', ['projects' => $projects]);
    }
    // Laravel scout maakt gebruik van de show functie
    public function show()
    {
        $projects = DB::table('projects')->get();

        return view('projects', ['projects' => $projects]);
    }

    // Project controller voor het zoeken naar projecten d.m.v. de search request
    public function search(Request $request)
    {
        // Wanneer er een error is in de get request return > geen resultaten gevonden
        $error = ['error' => 'Geen resultaten gevonden'];

        // Wanneer er iets getypt is d.m.v. de q key stuur een request via Laravel scout
        if ($request->has('q')) {
            // Maak gebruik van de search module van Laravel Scout en stuur een get request
            $projects = Project::search($request->get('q'))->get();
            // Als er geen resultaten zijn, return dan de error
            return $projects->count() ? $projects : $error;
        }

        // Stuur de error door naar de methoden die de functie search aanroept
        return $error;
    }




}

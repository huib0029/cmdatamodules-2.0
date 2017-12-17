<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{
    // Project controller voor het laten zien van van alle projecten
    public function index()
    {
        $projects = DB::table('projects')->get();

        return view('projects', ['projects' => $projects]);
    }





}

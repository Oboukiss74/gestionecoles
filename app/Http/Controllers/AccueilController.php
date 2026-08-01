<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
class AccueilController extends Controller
{
    //
    public function index()
    {
        return view('accueil.index');
    }
    public function Acceuil()
    {
        return view('Acceuil.index');
    }
    public function essaies()
    {
        return view('src.form-editors');
    }
    //creer une fonction qui regroupe toutes les vues dependant du clic pour afficher la vue correspondante
    public function AfficherLesDist($page)
    {

        return view('dist.' . $page);
    }
    public function AfficherLesSrc($page)
    {
        return view('src.' . $page);
    }
}

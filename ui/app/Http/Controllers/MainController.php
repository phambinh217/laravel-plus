<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Formats\UserFormat;

class MainController extends Controller
{
    public function index()
    {
        $mixManifestPath = public_path('mix-manifest.json');

        if (!file_exists($mixManifestPath)) {
            return 1;
        }

        $assets = json_decode(file_get_contents($mixManifestPath), true);

        return view('main', compact('assets'));
    }
}

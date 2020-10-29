<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Formats\UserFormat;
use Auth;

class MainController extends Controller
{
    public function init(UserFormat $userFormat, Request $request)
    {
        $user = null;
        if (Auth::check()) {
            $user = $userFormat->formatAuth(Auth::user());
        }

        return response()->json([
            'user' => $user
        ]);
    }

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

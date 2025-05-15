<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetaController extends Controller
{
    /**
     * Tampilkan halaman peta (hanya untuk user yang sudah login).
     */
    public function index()
    {
        return view('maps/peta');
    }
}

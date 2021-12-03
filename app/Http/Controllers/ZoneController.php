<?php

namespace App\Http\Controllers;
use App\Models\Storage;
use App\Models\Building;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index() {
        $zones = Zone::all();
        return view('zones', ['zones' => $zones]);
    }
}
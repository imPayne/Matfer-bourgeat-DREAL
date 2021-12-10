<?php

namespace App\Http\Controllers;
use App\Models\Storage;
use App\Models\Building;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index() {
        
        //$zones = Zone::all();
        $building = Building::all();
        //$zones3 = Storage::all();
        //return view('zones', ['zones' => $zones]);
        return view('zones', ['building' => $building]);
    
    }
    public function test() {
        //$buildingtest =  Building::with('zones')->get();

        $buildingtest = Building::all();
        $zonetest = Zone::all();
        //dump($buildingtest);
        return view('zones', compact('buildingtest', 'zonetest'));
    }
}
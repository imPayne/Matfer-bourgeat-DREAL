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
        $buildings = Building::all();
        $storages = Storage::all();
        return view('zones', compact('buildings', 'zones', 'storages'));
    }
    public function test() {
        //$buildingtest =  Building::with('zones')->get();

        $buildingtest = Building::all();
        $zonetest = Zone::all();
        //dump($buildingtest);
        return view('zones', compact('buildingtest', 'zonetest'));
    }
}
<?php

namespace App\Http\Controllers;
use App\Models\Storage;
use App\Models\Building;
use App\Models\Zone;
use Illuminate\Http\Request;

class showController extends Controller
{
    public function show() {
        $zoneData = Zone::paginate(20);
        $storageData = Storage::paginate(100);

        return view('list', ['zones'=>$zoneData,'storages'=>$storageData]);
    }
}

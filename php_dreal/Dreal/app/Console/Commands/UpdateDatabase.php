<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Storage;
use App\Models\Building;
use App\Models\Zone;

class UpdateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function getPreciseY($alley, $posY) {
        $alleyNumber = preg_match('/\d+/', $alley, $matches);
        if (!$matches)
            return;
        $value = intval($matches[0]);
        if ($value % 2 == 0) {
            $preciseY = (int)$posY + 20;
        }
        else {
            $preciseY = (int)$posY - 20;
        }
        #dd($preciseY);
        return($preciseY);
    }

    public function handle()
    {
        //posX,posY,width,height
        // insert buildings data in database by parsing a csv file
        if (($handle = fopen(public_path(). '/buildings.csv', "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $building = new Building();
                $building->posX = $data[0];
                $building->posY = $data[1];
                $building->width = $data[2];
                $building->height = $data[3];
                $building->save();
            }
        }
        //number,alley,column,level,storage,buildings,X,Y
        //parsing CSV file line per line and create new storage and assign data
        if (($handle = fopen(public_path(). '/storages.csv', "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
                $storage = new Storage();
                $storage->number = $data[0];
                $storage->level = $data[3];
                $storage->storage = $data[4];
                //methode de check pour ajouter une zone si elle n'existe pas deja dans la base
                $zoneExist = Zone::where('alley', '=', $data[1])
                ->where('column', '=', $data[2])->first();
                if (!$zoneExist) {
                    $zone = new Zone();
                    $zone->alley = $data[1];
                    $zone->column = $data[2];
                    $zone->posX = intval($data[6]);
                    $zone->width = 20;
                    $zone->height = 20;
                    $zone->posY = $this->getPreciseY($data[1], $data[7]);
                    $zone->save();
                    $storage->zone()->associate($zone->id);
                }
                else {
                    $storage->zone()->associate($zoneExist->id);
                }
                $zone->building()->associate($building->id);
                $storage->save();
            }
            fclose($handle);
        }

        return Command::SUCCESS;
    }
}

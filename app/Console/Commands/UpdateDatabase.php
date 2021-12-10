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
        $takeCharOfAlley = substr($alley, 0, 2); // permet de récupérer seulement les 2 premiers caractères

        if (!$matches) {
            $defaultY = intval($posY);
            return($defaultY);
        }
        
        $value = intval($matches[0]);
        if ($takeCharOfAlley == "FD" && $value == 1) {
            $preciseY = (int)$posY - 1.6; // cas pour FD1 car pour FC9 et FD1 les deux sont impaires
            return($preciseY);
        }

        if ($takeCharOfAlley != "FB" && $takeCharOfAlley != "FC" && $alley != "FD1") {
            $defaultY = intval($posY);
            return($defaultY);
        }

        // a partir de FB9 les racks (impaire, paire) sont changé =>(paire, impaire) donc plus le même algo
        if ($takeCharOfAlley == "FC" || $takeCharOfAlley == "FD") { // quand on passe de l'alley FB9 qui est impair la colonne en face est aussi impair (FC1)=> cas special
            if ($value % 2 == 0) {
                $preciseY = (int)$posY - 1.6;
            }
            if ($value % 2 != 0) {
                $preciseY = (int)$posY + 1.6;
            }
            return ($preciseY);
        }

        //algo pour FB1 a FB9 (impaire/paire)
        if ($value % 2 == 0) {
            $preciseY = (int)$posY + 1.6;
        }
        else {
            $preciseY = (int)$posY - 1.6;
        }
        return($preciseY);
    }

    public function handle()
    {
        dump("database is updating please wait...");
        //posX,posY,width,height
        // insert buildings data in database by parsing a csv file
        $building = Building::findOrNew(1);
        if (!$building->id) {
            $building->name = "FLO";
            $building->posX = 150;
            $building->posY = 270;
            $building->width = 3315;
            $building->height = 3630;
            $building->save();
        }
        $building = Building::findOrNew(2);
        if (!$building->id) {
            $building->name = "Stock Carton";
            $building->posX = 1950;
            $building->posY = 4130;
            $building->width = 1200;
            $building->height = 1400;
            $building->save();
        }
        $building = Building::findOrNew(3);
        if (!$building->id) {
            $building->name = "Produits dangereux";
            $building->posX = 200;
            $building->posY = 4130;
            $building->width = 1300;
            $building->height = 1300;
            $building->save();
        }

        //number,alley,column,level,storage,buildings,X,Y
        //parsing CSV file line per line and create new storage and assign data
        if (($handle = fopen(public_path('storages.csv'), "r")) !== FALSE) {
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
                    $zone->posY = $this->getPreciseY($data[1], $data[7]);
                    $zone->width = 20;
                    $zone->height = 20;
                    $zone->massWood = 0;
                    $zone->massPlastic = 0;
                    $zone->massDangerousProducts = 0;
                    $zone->building()->associate($building->id);
                    $zone->save();
                    #setting zone to storage
                    $storage->zone()->associate($zone->id);
                }else {
                    #setting founded zones
                    $storage->zone()->associate($zoneExist->id);
                }
                $storage->save();
            }
            fclose($handle);
            dump("Database updated with success...");
        }

        return Command::SUCCESS;
    }
}

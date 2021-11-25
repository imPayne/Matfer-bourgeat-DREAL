<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Storage;
use App\Models\Building;

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

    public function handle()
    {
        // insert buildings data in database by parsing a csv file
        /*if (($handle = fopen(public_path(). '/buildings.csv', "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $building = new Building();
                $building->posX = $data['posX'];
                $building->posY = $data['posY'];
                $building->width = $data['width'];
                $building->height = $data['height'];
                $building->save();
            }
        }*/
        //parsing CSV file line per line and create new storage and assign data
        if (($handle = fopen(public_path(). '/storages.csv', "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $storage = new Storage();
                $storage->number = $data[0];
                $storage->level = $data[3];
                $storage->storage = $data[4];
                $storage->save();
                
            }
            fclose($handle);
        }

        return Command::SUCCESS;
    }
}

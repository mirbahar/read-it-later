<?php

namespace Database\Seeders;

use App\Models\Pocket;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class PocketSeeder extends Seeder
{
    /** @var Pocket*/
    public $pocketOne;

    /** @var Pocket*/
    public $pocketTwo;


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $this->pocketOne = Pocket::create([
                'title' => 'Pocket 1'
            ]);

            $this->pocketTwo = Pocket::create([
                'title' => 'Pocket 2'
            ]);

        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}

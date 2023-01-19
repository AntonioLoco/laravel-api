<?php

namespace Database\Seeders;

use App\Functions\Helpers;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologys = ["Vue", "Javascript", "css", "Php", "Laravel", "Bootstrap"];

        foreach ($technologys as $technology) {
            $new_technology = new Technology();
            $new_technology->name = $technology;
            $new_technology->slug = Helpers::generateSlug($new_technology->name);
            $new_technology->save();
        }
    }
}

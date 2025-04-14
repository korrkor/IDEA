<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beneficiary;
use Faker\Factory as Faker;

class BeneficiarySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('max_execution_time', 300);

        $faker = Faker::create();
        $batchSize = 5000;
        $totalRecords = 1000000;

        for ($i = 0; $i < ($totalRecords / $batchSize); $i++) {
            $batch = [];

            for ($j = 0; $j < $batchSize; $j++) {
                $batch[] = [
                    'name' => $faker->name,
                    'status' => $faker->randomElement(['active', 'inactive']),
                    'registration_date' => $faker->date(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            Beneficiary::insert($batch); // Bulk insert
            echo "Inserted batch " . ($i + 1) . "\n";
        }
    }
}
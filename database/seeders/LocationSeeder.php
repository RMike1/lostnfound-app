<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            'Gasabo' => [
                'Kimironko' => [
                    'Bibare Cell' => [
                        ['name' => 'Bibare Village', 'latitude' => -1.9320, 'longitude' => 30.1030],
                        ['name' => 'Nyagatovu Village', 'latitude' => -1.9332, 'longitude' => 30.1075],
                    ],
                    'Nyagatovu Cell' => [
                        ['name' => 'Gishushu Village', 'latitude' => -1.9400, 'longitude' => 30.1100],
                        ['name' => 'Kabeza Village', 'latitude' => -1.9425, 'longitude' => 30.1135],
                    ],
                ],
                'Remera' => [
                    'Rebero Cell' => [
                        ['name' => 'Village A', 'latitude' => -1.9500, 'longitude' => 30.1200],
                        ['name' => 'Village B', 'latitude' => -1.9522, 'longitude' => 30.1233],
                    ],
                ],
            ],
            'Kicukiro' => [
                'Kagarama' => [
                    'Kigati Cell' => [
                        ['name' => 'Village C', 'latitude' => -1.9650, 'longitude' => 30.1300],
                        ['name' => 'Village D', 'latitude' => -1.9665, 'longitude' => 30.1325],
                    ],
                ],
            ],
        ];

        foreach ($locations as $districtName => $sectors) {
            $district = District::create(['name' => $districtName]);

            foreach ($sectors as $sectorName => $cells) {
                $sector = $district->sectors()->create(['name' => $sectorName]);

                foreach ($cells as $cellName => $villages) {
                    $cell = $sector->cells()->create(['name' => $cellName]);

                    foreach ($villages as $villageData) {
                        $cell->villages()->create([
                            'name' => $villageData['name'],
                            'latitude' => $villageData['latitude'],
                            'longitude' => $villageData['longitude'],
                        ]);
                    }
                }
            }
        }
    }
}

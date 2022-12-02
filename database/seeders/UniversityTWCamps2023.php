<?php

namespace Database\Seeders;

use App\Models\Camp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UniversityTWCamps2023 extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $camp = Camp::create([
            'name' => '2023 擊劍體驗冬令營',
            'description' => '2023 擊劍體驗冬令營',
        ]);
        $camp->times()->createMany([
            [
                'name' => '第一梯次',
                'start' => '2023-01-30',
                'end' => '2023-02-01',
            ]
        ]);
        $camp->offers()->createMany([
            [
                'name' => '一般報名',
                'price' => 4799,
                'group' => false,
            ],
            [
                'name' => '超早鳥優惠',
                'price' => 4000,
                'priceValidUntil' => '2022-12-15 23:59:59',
                'group' => false,
            ],
            [
                'name' => '團報優惠',
                'price' => 3600,
                'group' => false,
            ],
        ]);
    }
}

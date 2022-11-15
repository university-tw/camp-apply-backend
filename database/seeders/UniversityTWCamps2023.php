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
                'end' => '2023-02-02',
            ],
            [
                'name' => '第二梯次',
                'start' => '2023-02-06',
                'end' => '2023-02-09',
            ]
        ]);
        $camp->offers()->createMany([
            [
                'name' => '一般報名',
                'price' => 9999,
                'group' => false,
            ],
            [
                'name' => '超早鳥優惠',
                'price' => 4999,
                'priceValidUntil' => '2022-11-23 23:59:59',
                'group' => false,
            ],
            [
                'name' => '團報優惠',
                'price' => 7500,
                'group' => false,
            ],
        ]);
    }
}

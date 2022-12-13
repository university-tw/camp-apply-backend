<?php

namespace Database\Seeders;

use App\Models\Camp;
use Illuminate\Database\Seeder;

class UniversityTWCamps2023 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
                'group' => true,
            ],
        ]);
        $camp->bank_accounts()->attach(1);
        $camp = Camp::create([
            'name' => '2023 Web開發挑戰營',
            'description' => '2023 Web開發挑戰營',
        ]);
        $camp->times()->createMany([
            [
                'name' => '第一梯次',
                'start' => '2023-02-02',
                'end' => '2023-02-04',
            ]
        ]);
        $camp->offers()->createMany([
            [
                'name' => '一般報名',
                'price' => 7500,
                'group' => false,
            ],
            [
                'name' => '超早鳥優惠',
                'price' => 5000,
                'priceValidUntil' => '2022-12-20 23:59:59',
                'group' => false,
            ],
            [
                'name' => '限定優惠',
                'price' => 3000,
                'limit' => 10,
                'group' => false,
            ],
            [
                'name' => '團報優惠',
                'price' => 4000,
                'group' => true,
            ],
        ]);
        $camp->bank_accounts()->attach(1);
        $camp = Camp::create([
            'name' => '2023 Python實作營',
            'description' => '2023 Python實作營',
        ]);
        $camp->times()->createMany([
            [
                'name' => '第一梯次',
                'start' => '2023-02-06',
                'end' => '2023-02-08',
            ]
        ]);
        $camp->offers()->createMany([
            [
                'name' => '清寒專案',
                'price' => 600,
                'limit' => 10,
                'group' => false,
            ],
            [
                'name' => '一般報名',
                'price' => 8000,
                'group' => false,
            ],
            [
                'name' => '超早鳥優惠',
                'price' => 3999,
                'priceValidUntil' => '2022-12-20 23:59:59',
                'group' => false,
            ],
            [
                'name' => '團報優惠',
                'price' => 4500,
                'group' => true,
            ],
        ]);
        $camp->bank_accounts()->attach(1);
    }
}

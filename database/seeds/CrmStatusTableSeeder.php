<?php

use App\Models\CrmStatus;
use Illuminate\Database\Seeder;

class CrmStatusTableSeeder extends Seeder
{
    public function run()
    {
        $crmStatuses = [
            [
                'id'         => 1,
                'name'       => 'Lead',
                'created_at' => '2020-12-19 17:38:24',
                'updated_at' => '2020-12-19 17:38:24',
            ],
            [
                'id'         => 2,
                'name'       => 'Customer',
                'created_at' => '2020-12-19 17:38:24',
                'updated_at' => '2020-12-19 17:38:24',
            ],
            [
                'id'         => 3,
                'name'       => 'Partner',
                'created_at' => '2020-12-19 17:38:24',
                'updated_at' => '2020-12-19 17:38:24',
            ],
        ];

        CrmStatus::insert($crmStatuses);
    }
}

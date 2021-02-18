<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Admin',
            ],
            [
                'id'    => 2,
                'title' => 'Bidder',
            ],
            [
                'id'    => 3,
                'title' => 'Organization Tender Admin',
            ],
             [
                'id'    => 4,
                'title' => 'Tender Board Secretary',
            ],
             [
                'id'    => 5,
                'title' => 'QC Group',
            ],
             [
                'id'    => 6,
                'title' => 'Special Verification',
            ],
             
            
        ];

        Role::insert($roles);
    }
}

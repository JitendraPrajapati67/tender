<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 21,
                'title' => 'tender_category_create',
            ],
            [
                'id'    => 22,
                'title' => 'tender_category_edit',
            ],
            [
                'id'    => 23,
                'title' => 'tender_category_show',
            ],
            [
                'id'    => 24,
                'title' => 'tender_category_delete',
            ],
            [
                'id'    => 25,
                'title' => 'tender_category_access',
            ],
            [
                'id'    => 26,
                'title' => 'bidder_manager_create',
            ],
            [
                'id'    => 27,
                'title' => 'bidder_manager_edit',
            ],
            [
                'id'    => 28,
                'title' => 'bidder_manager_show',
            ],
            [
                'id'    => 29,
                'title' => 'bidder_manager_delete',
            ],
            [
                'id'    => 30,
                'title' => 'bidder_manager_access',
            ],
            [
                'id'    => 31,
                'title' => 'material_create',
            ],
            [
                'id'    => 32,
                'title' => 'material_edit',
            ],
            [
                'id'    => 33,
                'title' => 'material_show',
            ],
            [
                'id'    => 34,
                'title' => 'material_delete',
            ],
            [
                'id'    => 35,
                'title' => 'material_access',
            ],
            [
                'id'    => 36,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}

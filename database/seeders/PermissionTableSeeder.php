<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Permission::truncate();

        $permissions = [
            /* 'contact-list',
            'contact-create',
            'contact-edit',
            'contact-delete',
            'case-list',
            'case-create',
            'case-edit',
            'case-delete',*/
            'agent-outbound',
            /*
            'voice-record-list',
            'voice-record-supervisor',*/
            //'voice-export-list',
            //'voice-export-create',
            //'voice-export-download',
            //'voice-export-delete',
            /*
            'master-data-list',
            'master-data-create',
            'master-data-edit',
            'master-data-delete',
            'pbx-tool',
            'call-survey-list',
            'call-survey-create',
            'call-survey-edit',
            'call-survey-delete',
            'holiday-list',
            'holiday-create',
            'holiday-edit',
            'holiday-delete',
            'billing-list',
            'billing-create',
            'billing-edit',
            'billing-delete',
            'notify-list',
            'notify-create',
            'notify-edit',
            'notify-delete',
            'customize-list',
            'customize-edit',*/
            //'outbound-list',
            //'outbound-create',
            //'outbound-edit',
            //'outbound-delete',
            /* 'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete', */

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

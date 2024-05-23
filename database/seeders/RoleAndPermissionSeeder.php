<?php

namespace Database\Seeders;

use App\Enums\Permissions;
use App\Enums\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (Permissions::values() as $name) {
            Permission::firstOrCreate(compact('name'));
        };

        $moderatorRole = Role::firstOrCreate(['name' => Roles::Moderator]);
        $moderatorRole->syncPermissions([
            Permissions::ModerateJobAds,
        ]);

        $jobSeekerRole = Role::firstOrCreate(['name' => Roles::JobSeeker]);
        $jobSeekerRole->syncPermissions([
            Permissions::SeekJobs
        ]);
    }
}

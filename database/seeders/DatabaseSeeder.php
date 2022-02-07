<?php

namespace Database\Seeders;

use App\Models\GroupModule;
use App\Models\GroupUser;
use App\Models\Module;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        GroupUser::create([
            'kode' => 'Administrator', //1
            'deskripsi' => 'Administrator'
        ]);

        User::create([
            'username' => 'soleh', //1
            'password' => Hash::make('07082017'),
            'nama' => 'soleh',
            'email' => 'soleh.rasta@gmail.com',
            'group_user_id' => 1,
            'foto' => 'soleh.jpg'
        ]);

        GroupModule::create([
            'kode' => 'Setting', //1
            'deskripsi' => 'Setting'
        ]);

        Module::create([
            'deskripsi' => 'Module', //1
            'route' => 'module.index',
            'icon' => 'module.png',
            'group_module_id' => 1
        ]);

        Module::create([
            'deskripsi' => 'User', //2
            'route' => 'user.index',
            'icon' => 'user.png',
            'group_module_id' => 1
        ]);

        Module::create([
            'deskripsi' => 'Group Module', //3
            'route' => 'groupmodule.index',
            'icon' => 'groupmodule.png',
            'group_module_id' => 1
        ]);

        Module::create([
            'deskripsi' => 'Group User', //4
            'route' => 'groupuser.index',
            'icon' => 'groupuser.png',
            'group_module_id' => 1
        ]);


        GroupUser::find(1)->Module()->attach(1,['buat' => 'Y','ubah' => 'Y','hapus' => 'Y']);
        GroupUser::find(1)->Module()->attach(2,['buat' => 'Y','ubah' => 'Y','hapus' => 'Y']);
        GroupUser::find(1)->Module()->attach(3,['buat' => 'Y','ubah' => 'Y','hapus' => 'Y']);
        GroupUser::find(1)->Module()->attach(4,['buat' => 'Y','ubah' => 'Y','hapus' => 'Y']);

    }
}

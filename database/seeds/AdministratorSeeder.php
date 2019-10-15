<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\User;
        $admin->username = 'administrator';
        $admin->name = 'Site Administrator';
        $admin->email = 'admin@larashop.test';
        $admin->phone = '0812356478';
        $admin->roles = json_encode(['ADMIN']);
        $admin->password = \Hash::make('larashop');
        $admin->avatar = 'kosong.png';
        $admin->address = 'Pondok Cabe';

        $admin->save();
        $this->command->info('User admin berhasil ditambahkan');
    }
}

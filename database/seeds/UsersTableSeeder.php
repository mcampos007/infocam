<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         //
         User::create([
        	'name' => 'mario',
            'email'=> 'mcampos.infocam@gmail.com',
            'password' => bcrypt('123123'),
            'admin' => true
        ]);

        User::create([
        	'name' => 'cesar',
            'email'=> 'cesar.campos@infocam.com.ar',
            'password' => bcrypt('321321')
        ]);
    }
}

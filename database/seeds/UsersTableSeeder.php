<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
             DB::table('users')->insert(
         	[
         		[
            'name' => 'hoang',
            'username' => 'admin',
            'password' => bcrypt('12345'),

   			'role' => 1,
            'created_at' => new DateTime(),

        	],
        	[
            'name' => 'Manager',
            'username' => 'manager',
            'password' => bcrypt('12345'),

   			'role' => 2,
            'created_at' => new DateTime(),

        	],

        	 
        	]);
    }
}

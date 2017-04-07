<?php

use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('teachers')->insert(
         	[
         		[
            'name' => 'hoang',

            'password' => bcrypt('12345'),
   			'dob' => '1994/06/05',
   			'address' => '',
   			'phone' => '0905577972',
   			'agency_id' => 1,
            'created_at' => new DateTime(),

        	],

        	 
        	]);
    }
}

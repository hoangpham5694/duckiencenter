<?php

use Illuminate\Database\Seeder;

class AgenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('agencies')->insert(
         	[
         		[
            'name' => 'Đức kiến',
            'address' => '110 Nguyễn Đình Thảo',
            'status' => 'active',
   
            'created_at' => new DateTime(),

        	],

        	 
        	]);
    }
}

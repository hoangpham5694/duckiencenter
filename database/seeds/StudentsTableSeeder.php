<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                DB::table('students')->insert(
         	[
					[
					'name' => str_random(10),
					'email' => str_random(10).'@gmail.com',
					'dob' => '1994/06/05',
					'password' => bcrypt('12345'),
					'phone' => '123456789',
					'created_at' => new DateTime()
					],
										[
					'name' => str_random(10),
					'email' => str_random(10).'@gmail.com',
					'dob' => '1994/06/05',
					'password' => bcrypt('12345'),
					'phone' => '123456789',
					'created_at' => new DateTime()
					],
		
         	]);
    }
}

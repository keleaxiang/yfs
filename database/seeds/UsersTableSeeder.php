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
        //
        for ($i=0; $i < 50; $i++) { 
        	
       
        DB::table('admin')->insert([
            'username' => str_random(10),
            'password' => Hash::make('12345678'),
            'email' => str_random(10).'@qq.com',
            'phone'=>'13'.rand(111111111,999999999),
            'head'=>'/uploads/img_28621557975824.png',
            'status' => 1
        ]);

         }
    }
}

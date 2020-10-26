<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
//        DB::table('admins')->insert([
//            'name' => "ah",
//            'email' => 'ah@gmail.com',
//            'password' => bcrypt('123456'),
//            'user_type' => '1',
//            'level'=> '1',
//        ]);
        $units=['تنظيم و اداره'];

        for ($i=0;$i<1000;$i++)
        DB::table('documents')->insert([
            'number' => rand(1000,100000),
            'subject'=>Str::random(6),
            'sender'=>Str::random(6),
            'reciever'=>Str::random(6),
            'date'=>now(),
            'copy_to'=>Str::random(6),

            'image' => '1579598044_image_ocr_3.PNG',
            'user_type' => '1',
            'logged_user_id' => '1',
            'type'=> '1',

        ]);
    }
}

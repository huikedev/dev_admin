<?php

use think\migration\Seeder;

class HuikeDeveloperWcgzyd extends Seeder
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {


        // id = 1
        think\facade\Db::table('huike_developer')->insert(['id' => 1, 'username' => 'huikedev', 'password' => '$2y$10$SU1k1zhH3dodNXXmspk0nORR9N.2GrbTGH0N.FF4E5HB8PPxBDV9u', 'position_id' => 9, 'last_login_ip' => '127.0.0.1', 'login_time' => 1614080937, 'login_ip' => '127.0.0.1', 'last_login_time' => 1614076087, 'creator_id' => 1, 'create_time' => 1589639264, 'update_time' => 1614080937]);
    }
}
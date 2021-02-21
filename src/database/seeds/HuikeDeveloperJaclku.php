<?php

use think\migration\Seeder;

class HuikeDeveloperJaclku extends Seeder
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
		think\facade\Db::table('huike_developer')->insert(['id' => 1,'username' => 'huikedev','password' => '$2y$10$SU1k1zhH3dodNXXmspk0nORR9N.2GrbTGH0N.FF4E5HB8PPxBDV9u','position_id' => 9,'last_login_ip' => '::1','login_time' => 1613929611,'login_ip' => '::1','last_login_time' => 1613922475,'creator_id' => 1,'create_time' => 1589639264,'update_time' => 1613929611]);
		// id = 2
		think\facade\Db::table('huike_developer')->insert(['id' => 2,'username' => 'admin','password' => '$2y$10$QB01lb3vLTomVF7qy/dSB.FaQ5ZNUzxMQiotbkYDbaKllYrDNac/W','position_id' => 19,'creator_id' => 1,'delete_time' => 1613645933,'create_time' => 1613645831,'update_time' => 1613645933]);
}
}
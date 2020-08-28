<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");

        DB::table('user_types')->truncate();
        DB::table('user_statuses')->truncate();

        $this->call(UserTypesSeeder::class);
        $this->call(UserStatusesSeeder::class);

        DB::statement("SET foreign_key_checks = 1");
    }
}

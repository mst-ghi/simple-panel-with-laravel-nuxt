<?php

class DatabaseSeeder extends DBSeeder
{
    protected $all_step = 2;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->start();
        $this->call(AclSeeder::class);
        $this->end();

        $dumps = [
            'users',
            'role_user',
            'provinces',
            'counties',
            'cities',
        ];

        $this->start();
        foreach ($dumps as $dump) {
            $this->dumpSqlFile($dump);
        }
        $this->end();
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(User::class, 500 )->create();
 
   
    }
}

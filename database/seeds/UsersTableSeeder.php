<?php

use App\Models\Role;
use App\Models\User;
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
        $user = factory(User::class)->create();

        $user->roles()->attach(
        	$role = factory(Role::class)->create(), [
        		'user_id' => $user->id
        	]
        );

        
    }
}

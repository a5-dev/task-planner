<?php

namespace Database\Seeders;

use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Daniel Test',
            'email' => 'daniel@a-5.dev',
            'password' => Hash::make('test1234'),
        ]);

        DB::table('task_lists')->insert([
            'name' => 'Family',
            'user_id' => 1,
        ]);
        DB::table('task_lists')->insert([
            'name' => 'House',
            'user_id' => 1,
        ]);
        DB::table('task_lists')->insert([
            'name' => 'Cars',
            'user_id' => 1,
        ]);

        $today = CarbonImmutable::now();

        //general tasks
        DB::table('tasks')->insert([
            'summary' => 'code larajam',
            'to_do_date' => $today,
            'completed_at' => null,
            'user_id' => 1,
            'task_list_id' => null,
        ]);
        DB::table('tasks')->insert([
            'summary' => 'walk the dog',
            'to_do_date' => $today,
            'completed_at' => $today,
            'user_id' => 1,
            'task_list_id' => null,
        ]);
        DB::table('tasks')->insert([
            'summary' => 'walk the dog',
            'to_do_date' => $today->add(2, 'day'),
            'completed_at' => null,
            'user_id' => 1,
            'task_list_id' => null,
        ]);
        DB::table('tasks')->insert([
            'summary' => 'walk the dog',
            'to_do_date' => $today->add(4, 'day'),
            'completed_at' => null,
            'user_id' => 1,
            'task_list_id' => null,
        ]);
        DB::table('tasks')->insert([
            'summary' => 'walk the dog',
            'to_do_date' => $today->add(8, 'day'),
            'completed_at' => null,
            'user_id' => 1,
            'task_list_id' => null,
        ]);

        //family
        DB::table('tasks')->insert([
            'summary' => 'go to the zoo',
            'to_do_date' => null,
            'completed_at' => null,
            'user_id' => 1,
            'task_list_id' => 1,
        ]);

        //house

        //cars
        DB::table('tasks')->insert([
            'summary' => 'wash and wax',
            'to_do_date' => null,
            'completed_at' => $today,
            'user_id' => 1,
            'task_list_id' => 3,
        ]);
        DB::table('tasks')->insert([
            'summary' => 'change spark plugs',
            'to_do_date' => null,
            'completed_at' => null,
            'user_id' => 1,
            'task_list_id' => 3,
        ]);

    }
}

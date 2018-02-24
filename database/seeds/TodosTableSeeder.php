<?php

use Illuminate\Database\Seeder;
use App\Todos;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i=0; $i<10; $i++){

            $todo = new Todos();
            $todo->title = $faker->name();
            $todo->body = $faker->text();
            $todo->created_by = 1;
            $todo->save();
        }

        for($i=0; $i<10; $i++){

            $todo = new Todos();
            $todo->title = $faker->name();
            $todo->body = $faker->text();
            $todo->created_by = 2;
            $todo->save();
        }
    }
}

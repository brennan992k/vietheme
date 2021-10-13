<?php

namespace Modules\Blog\Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Entities\InfixBlogCategory;

class BlogDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        $faker = Faker::create();
        for ($i = 1; $i <= 10; $i++) {
            $store = new InfixBlogCategory();
            $store->name = $faker->word;
            $store->status = 1;
            $store->save();
        }
    }
}

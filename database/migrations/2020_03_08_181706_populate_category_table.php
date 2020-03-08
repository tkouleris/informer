<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('category')->insert([
            'CategoryName' => 'Business',
            'CategoryShort' => 'business',
        ]);

        DB::table('category')->insert([
            'CategoryName' => 'Entertainment',
            'CategoryShort' => 'entertainment',
        ]);

        DB::table('category')->insert([
            'CategoryName' => 'General',
            'CategoryShort' => 'general',
        ]);

        DB::table('category')->insert([
            'CategoryName' => 'Health',
            'CategoryShort' => 'health',
        ]);

        DB::table('category')->insert([
            'CategoryName' => 'Science',
            'CategoryShort' => 'science',
        ]);

        DB::table('category')->insert([
            'CategoryName' => 'Sports',
            'CategoryShort' => 'sports',
        ]);

        DB::table('category')->insert([
            'CategoryName' => 'Technology',
            'CategoryShort' => 'technology',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

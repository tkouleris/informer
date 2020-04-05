<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('setting_id');
            $table->bigInteger('setting_userid')->unsigned();
            $table->foreign('setting_userid')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->bigInteger('setting_countryid')->unsigned();;
            $table->foreign('setting_countryid')
                ->references('CountryID')
                ->on('country');
            $table->bigInteger('setting_categoryid')->unsigned();;
            $table->foreign('setting_categoryid')
                ->references('CategoryID')
                ->on('category');
            $table->boolean('setting_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting');
    }
}

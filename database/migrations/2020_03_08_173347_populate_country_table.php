<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('country')->insert([
            'CountryName' => 'United Arab Emirates',
            'CountryShortName' => 'ae',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Austria',
            'CountryShortName' => 'at',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Australia',
            'CountryShortName' => 'au',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Belarus',
            'CountryShortName' => 'be',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Bulgaria',
            'CountryShortName' => 'bg',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Brazil',
            'CountryShortName' => 'br',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Canada',
            'CountryShortName' => 'ca',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Switzerland',
            'CountryShortName' => 'ch',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'China',
            'CountryShortName' => 'cn',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Colombia',
            'CountryShortName' => 'co',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Cuba',
            'CountryShortName' => 'cu',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Czech Republic',
            'CountryShortName' => 'cz',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Germany',
            'CountryShortName' => 'de',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Egypt',
            'CountryShortName' => 'eg',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'France',
            'CountryShortName' => 'fr',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'United Kingdom',
            'CountryShortName' => 'gb',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Greece',
            'CountryShortName' => 'gr',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Hong Kong',
            'CountryShortName' => 'hk',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Hungary',
            'CountryShortName' => 'hu',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Indonesia',
            'CountryShortName' => 'id',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Ireland',
            'CountryShortName' => 'ie',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Israel',
            'CountryShortName' => 'il',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'India',
            'CountryShortName' => 'in',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Italy',
            'CountryShortName' => 'it',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Japan',
            'CountryShortName' => 'jp',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'South Korea',
            'CountryShortName' => 'kr',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Lithuania',
            'CountryShortName' => 'lt',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Latvia',
            'CountryShortName' => 'lv',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Morocco',
            'CountryShortName' => 'ma',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Mexico',
            'CountryShortName' => 'mx',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Malaysia',
            'CountryShortName' => 'my',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Nigeria',
            'CountryShortName' => 'ng',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Netherlands',
            'CountryShortName' => 'nl',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Norway',
            'CountryShortName' => 'no',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'New Zealand',
            'CountryShortName' => 'nz',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Philippines',
            'CountryShortName' => 'ph',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Poland',
            'CountryShortName' => 'pl',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Portugal',
            'CountryShortName' => 'pt',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Romania',
            'CountryShortName' => 'ro',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Serbia',
            'CountryShortName' => 'rs',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Russian Federation',
            'CountryShortName' => 'ru',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Saudi Arabia',
            'CountryShortName' => 'sa',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Sweden',
            'CountryShortName' => 'se',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Singapore',
            'CountryShortName' => 'sg',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Slovenia',
            'CountryShortName' => 'si',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Slovakia',
            'CountryShortName' => 'sk',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Thailand',
            'CountryShortName' => 'th',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Turkey',
            'CountryShortName' => 'tr',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Taiwan',
            'CountryShortName' => 'tw',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Ukraine',
            'CountryShortName' => 'ua',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'United States of America',
            'CountryShortName' => 'us',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'Venezuela',
            'CountryShortName' => 've',
        ]);

        DB::table('country')->insert([
            'CountryName' => 'South Africa',
            'CountryShortName' => 'za',
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocaleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locales', function (Blueprint $table) {
            $table->string('name_user')->nullable();
            $table->string('phone_user')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locales', function (Blueprint $table) {
            $table->dropColumn('name_user');
            $table->dropColumn('phone_user');
        });
    }
}

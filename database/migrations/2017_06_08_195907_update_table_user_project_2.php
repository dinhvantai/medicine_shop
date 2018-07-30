<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableUserProject2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('position')->nullable(); //Chuc vu
            $table->string('gender')->nullable();
            $table->string('specialize')->nullable(); // Chuyen mon
            $table->mediumText('certificate')->nullable(); // Bang cap, chung chi
            $table->mediumText('experience')->nullable(); // Kinh nghiem
            $table->string('workplace')->nullable(); //Noi lam viec
            $table->mediumText('about_you')->nullable(); //Gioi thieu ban than
            $table->date('birthday')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('position');
            $table->dropColumn('gender');
            $table->dropColumn('specialize');
            $table->dropColumn('certificate');
            $table->dropColumn('experience');
            $table->dropColumn('workplace');
            $table->dropColumn('about_you');
            $table->dropColumn('birthday');
        });
    }
}

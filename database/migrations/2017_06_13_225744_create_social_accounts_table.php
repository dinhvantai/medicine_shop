<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('email', 255)->nullable()->change();
            $table->string('password', 100)->nullable()->change();
            $table->string('provider_user_id')->nullable();
            $table->string('provider')->nullable();
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
            $table->string('email', 255)->change();
            $table->string('password', 100)->change();
            $table->dropColumn('provider_user_id');
            $table->dropColumn('provider');
        });
    }
}

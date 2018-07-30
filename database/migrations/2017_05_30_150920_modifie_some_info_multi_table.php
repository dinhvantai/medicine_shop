<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifieSomeInfoMultiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicines', function(Blueprint $table) {
            $table->string('price')->nullable()->change();
        });

        Schema::table('prescriptions', function (Blueprint $table) {
            $table->integer('status')->default(1)->change();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->integer('status')->default(1)->change();
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->integer('status')->default(1)->change();
        });

        Schema::table('item_prescriptions', function (Blueprint $table) {
            $table->integer('status')->default(1)->change();
        });

        Schema::table('request_medicines', function (Blueprint $table) {
            $table->mediumText('short_describer')->nullable()->change();
            $table->integer('status')->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicines', function($table) {
            $table->string('price')->change();
        });

        Schema::table('prescriptions', function (Blueprint $table) {
            $table->integer('status')->change();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->integer('status')->change();
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->integer('status')->change();
        });

        Schema::table('item_prescriptions', function (Blueprint $table) {
            $table->integer('status')->change();
        });

        Schema::table('request_medicines', function (Blueprint $table) {
            $table->mediumText('short_describer')->change();
            $table->integer('status')->change();
        });
    }
}

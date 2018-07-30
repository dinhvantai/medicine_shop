<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifieTableCategoryItempresciription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_prescriptions', function(Blueprint $table) {
            $table->integer('medicine_id')->unsigned()->nullable()->change();
        });

        Schema::table('categories', function(Blueprint $table) {
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_prescriptions', function(Blueprint $table) {
            $table->integer('medicine_id')->unsigned()->change();
        });

        Schema::table('categories', function(Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}

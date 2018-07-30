<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeForeginSomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescriptions', function($table) {
            $table->foreign('request_prescription_id')->references('id')->on('request_prescriptions')->onDelete('cascade');
        });

        Schema::table('images', function($table) {
            $table->integer('request_prescription_id')->unsigned()->nullable();

            $table->foreign('request_prescription_id')->references('id')->on('request_prescriptions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescriptions', function($table) {
            $table->dropForeign(['request_prescription_id']);
        });

        Schema::table('images', function($table) {
            $table->dropForeign(['request_prescription_id']);
            $table->dropColumn('request_prescription_id');
        });
    }
}

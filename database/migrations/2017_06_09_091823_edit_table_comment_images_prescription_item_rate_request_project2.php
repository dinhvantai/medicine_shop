<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTableCommentImagesPrescriptionItemRateRequestProject2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function($table) {
            $table->integer('parent_id')->unsigned()->nullable();

            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
        });

        Schema::table('prescriptions', function($table) {
            $table->integer('doctor_id')->unsigned()->nullable();
            $table->mediumText('diagnose')->nullable(); //Chuan doan cua bac si
            $table->integer('request_prescription_id')->unsigned()->nullable();

            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('item_prescriptions', function($table) {
            $table->mediumText('guide')->nullable();
            $table->float('qty_purchased')->default('1'); // So luong can mua theo don vi
        });

        Schema::table('request_medicines', function($table) {
            $table->dropForeign(['item_prescription_id']);
            $table->dropColumn('item_prescription_id');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('rate_medicines', function($table) {
            $table->integer('user_id')->unsigned()->nullable()->change();
            $table->string('title')->nullable();
            $table->mediumText('content')->nullable();
        });

        Schema::table('images', function($table) {
            $table->integer('medicine_id')->unsigned()->nullable()->change();
            $table->integer('request_medicines_id')->unsigned()->nullable();

            $table->foreign('request_medicines_id')->references('id')->on('request_medicines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function($table) {
            $table->dropForeign(['parent_id']);

            $table->dropColumn('parent_id');
        });

        Schema::table('prescriptions', function($table) {
            $table->dropForeign(['doctor_id']);
            
            $table->dropColumn('doctor_id');
            $table->dropColumn('diagnose');
        });

        Schema::table('item_prescriptions', function($table) {
            $table->dropColumn('guide');
            $table->dropColumn('qty_purchased');
        });

        Schema::table('request_medicines', function($table) {
            $table->integer('item_prescription_id')->unsigned();
            $table->foreign('item_prescription_id')->references('id')->on('item_prescriptions');

            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('rate_medicines', function($table) {
            $table->integer('user_id')->unsigned()->change();
            $table->dropColumn('title');
            $table->dropColumn('content');
        });

        Schema::table('images', function($table) {
            $table->dropForeign(['request_medicines_id']);

            $table->integer('medicine_id')->unsigned()->change();
            $table->dropColumn('request_medicines_id');
        });
    }
}

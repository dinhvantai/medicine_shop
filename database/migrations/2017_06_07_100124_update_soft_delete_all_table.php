<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSoftDeleteAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->softDeletes();
        });

        Schema::table('medicines', function ($table) {
            $table->softDeletes();
        });

        Schema::table('categories', function ($table) {
            $table->softDeletes();
        });

        Schema::table('category_medicine_related', function ($table) {
            $table->softDeletes();
        });

        Schema::table('prescriptions', function ($table) {
            $table->softDeletes();
        });

        Schema::table('images', function ($table) {
            $table->softDeletes();
        });

        Schema::table('mark_medicine', function ($table) {
            $table->softDeletes();
        });

        Schema::table('comments', function ($table) {
            $table->softDeletes();
        });

        Schema::table('banners', function ($table) {
            $table->softDeletes();
        });

        Schema::table('item_prescriptions', function ($table) {
            $table->softDeletes();
        });

        Schema::table('request_medicines', function ($table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('medicines', function ($table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('categories', function ($table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('category_medicine_related', function ($table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('prescriptions', function ($table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('images', function ($table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('mark_medicine', function ($table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('comments', function ($table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('banners', function ($table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('item_prescriptions', function ($table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('request_medicines', function ($table) {
            $table->dropColumn('deleted_at');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeTableOrderProject2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('prescription_id')->unsigned()->nullable();
            $table->integer('sent_email')->default(0);
            $table->string('user_email')->nullable();
            $table->string('user_display_name')->nullable();
            $table->float('grand_total', 8, 2)->default(0);
            $table->float('total_items', 8, 2)->default(1);
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
        Schema::dropIfExists('orders');
    }
}

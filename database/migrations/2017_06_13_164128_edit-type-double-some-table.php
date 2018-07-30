<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTypeDoubleSomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function($table) {
            $table->decimal('grand_total', 15, 2)->change();
        });

        Schema::table('order_items', function($table) {
            $table->decimal('row_total', 15, 2)->change();
        });

        Schema::table('medicines', function($table) {
            $table->decimal('price', 15, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function($table) {
            $table->float('grand_total', 8, 2)->change();
        });

        Schema::table('order_items', function($table) {
            $table->float('row_total', 8, 2)->change();
        });

        Schema::table('medicines', function($table) {
            $table->float('price', 8, 2)->change();
        });
    }
}

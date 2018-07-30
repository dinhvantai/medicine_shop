<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableMedicineProject2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicines', function($table) {
            $table->dropColumn('price');
            $table->integer('allowed_buy')->default(0); //Duoc mua hay can ke don cua bac si
            $table->string('unit')->nullable(); // Don vi
            $table->text('guide')->nullable(); //Huong dan su dung
            $table->string('ingredient')->nullable(); // Thanh phan
            $table->string('made_in')->nullable(); // Noi san xuat
            $table->text('unintended_effect')->nullable(); // Tac dung phu
            $table->string('contraindications')->nullable(); //Chong chi dinh
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
            $table->string('price');
            $table->dropColumn('allowed_buy');
            $table->dropColumn('unit');
            $table->dropColumn('guide');
            $table->dropColumn('ingredient');
            $table->dropColumn('made_in');
            $table->dropColumn('unintended_effect');
            $table->dropColumn('contraindications');
        });
    }
}

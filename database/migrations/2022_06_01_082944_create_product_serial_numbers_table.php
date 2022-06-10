<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSerialNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_serial_numbers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->nullable()->index();
            $table->bigInteger('warehouse_id')->nullable()->index();
            $table->string('serial_number')->index();
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
        Schema::dropIfExists('product_serial_numbers');
    }
}

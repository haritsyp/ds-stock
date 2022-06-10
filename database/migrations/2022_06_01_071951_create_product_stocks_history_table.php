<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStocksHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stock_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('warehouse_id')->index()->nullable();
            $table->bigInteger('product_id')->index()->nullable();
            $table->double('in')->nullable();
            $table->double('out')->nullable();
            $table->double('balance')->nullable();
            $table->string('reference', 50)->nullable();
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
        Schema::dropIfExists('product_stock_histories');
    }
}

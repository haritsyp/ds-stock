<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('purchase_order_id')->index()->nullable();
            $table->bigInteger('product_id')->index()->nullable();
            $table->string('description')->nullable();
            $table->text('note')->nullable();
            $table->double('price')->default(0)->nullable();
            $table->double('quantity')->default(0)->nullable();
            $table->double('discount')->default(0)->nullable();
            $table->double('subtotal')->default(0)->nullable();
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
        Schema::dropIfExists('purchase_order_items');
    }
}

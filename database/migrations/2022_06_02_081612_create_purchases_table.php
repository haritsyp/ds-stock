<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('supplier_id')->index()->nullable();
            $table->timestamp('po_date')->nullable();
            $table->string('po_number')->index()->nullable();
            $table->double('total')->default(0)->nullable();
            $table->double('discount')->default(0)->nullable();
            $table->double('shipping_amount')->default(0)->nullable();
            $table->double('additional_charge')->default(0)->nullable();
            $table->double('tax')->default(0)->nullable();
            $table->text('note')->nullable();
            $table->string('status')->index()->nullable();
            $table->longText('purchase_order_items')->nullable();
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
        Schema::dropIfExists('purchase_orders');
    }
}

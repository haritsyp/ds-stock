<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('brand_id')->index()->nullable();
            $table->string('sku', 100)->index()->unique();
            $table->string('barcode', 255)->index()->nullable()->unique();
            $table->string('name', 255)->nullable();
            $table->double('price')->default(0)->nullable();
            $table->double('special_price')->default(0)->nullable();
            $table->double('weight')->default(0)->nullable();
            $table->double('width')->default(0)->nullable();
            $table->double('length')->default(0)->nullable();
            $table->double('height')->default(0)->nullable();
            $table->longText('description')->nullable()->nullable();
            $table->text('url_key')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_image')->nullable();
            $table->boolean('is_active')->index()->default(0)->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

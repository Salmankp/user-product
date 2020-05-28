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

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('title')->nullable();
            $table->string('sku')->nullable();
            $table->longText('description')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('keywords')->nullable();
            $table->string('category')->nullable();
            $table->integer('approval_status')->nullable()->default(1)->comment('1=pending,2=fail,3=success');
            $table->integer('shelf_status')->nullable()->default(1)->comment('1=offshelf,2=onshelf,3=disabled');
            $table->integer('product_type')->nullable()->default(1)->comment('1=original,2=crawl,3=overseas,4=important,5=library,6=other');
            $table->string('trade_name')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('manufacturer_number')->nullable();
            $table->string('internal_sku')->nullable();
            $table->string('product_source')->nullable();
            $table->string('source_url')->nullable();
            $table->string('product_code')->nullable();
            $table->string('remarks')->nullable();
            $table->string('buying_price')->nullable();
            $table->string('weight')->nullable();
            $table->string('size_length')->nullable();
            $table->string('size_width')->nullable();
            $table->string('size_height')->nullable();
            $table->string('domestic_freight')->nullable();
            $table->string('international_freight')->nullable();
            $table->string('discount')->nullable();
            $table->string('stock')->nullable();
            $table->string('fill_time')->nullable();
            $table->string('extra_field_1')->nullable();
            $table->string('extra_field_2')->nullable();
            $table->string('extra_field_3')->nullable();
            $table->string('extra_field_4')->nullable();
            $table->string('extra_field_5')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}

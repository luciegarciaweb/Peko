<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('variety_id')->nullable();
            $table->unsignedInteger('container_id')->nullable();
            $table->string('slug')->unique();
            $table->string('title', 100);
            $table->float('price');
            $table->float('price_kilo');
            $table->float('weight_unity');
            $table->float('quantity');
            $table->text('body');
            $table->boolean('is_active')->default(true);
            $table->boolean('push_forward')->default(false);
            $table->string('picture')->nullable();
            $table->timestamps();

            $table->foreign('variety_id')->references('id')->on('varieties')->onDelete('set null');
            $table->foreign('container_id')->references('id')->on('containers')->onDelete('set null');
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

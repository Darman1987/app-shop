<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_details', function (Blueprint $table) {
            $table->increments('id');

               /*FK*/
            $table->integer('cart_id')->unsigned(); // campo a relacionar sin signo
            $table->foreign('cart_id')->references('id')->on('carts'); //foreign key

             /*FK*/
            $table->integer('product_id')->unsigned(); // campo a relacionar sin signo
            $table->foreign('product_id')->references('id')->on('products'); //foreign key


            $table->integer('quantity');
            $table->integer('discount')->default(0); // discount %
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
        Schema::dropIfExists('cart_details');
    }
}

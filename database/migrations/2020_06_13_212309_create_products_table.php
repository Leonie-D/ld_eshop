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
            $table->id();
            $table->string('name', 45);
            $table->text('description')->nullable();
            $table->decimal('price', 4, 2);
            $table->unsignedBigInteger('taxe_id');
            $table->unsignedBigInteger('deal_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->string('picture', 125);
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductExtraOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_extra_options', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_slug');
            $table->decimal('extra_amount')->nullable();
            $table->bigInteger('product_extra_id')->unsigned();
            $table->timestamps();

            $table->foreign('product_extra_id')->references('id')->on('product_extras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_extra_options');
    }
}

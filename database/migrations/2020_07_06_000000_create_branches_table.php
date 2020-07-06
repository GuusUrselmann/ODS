<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('zipcode');
            $table->string('address');
            $table->integer('house_number');
            $table->string('city');
            $table->integer('phonenumber');
            $table->string('email');
            $table->boolean('cash');
            $table->boolean('card');
            $table->boolean('ideal');
            $table->boolean('invoice');
            $table->boolean('takeaway');
            $table->boolean('delivery');
            $table->decimal('delivery_costs');
            $table->decimal('delivery_free_at');
            $table->decimal('delivery_min_amount');
            $table->integer('delivery_max_distance');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
}

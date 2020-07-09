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
            $table->bigInteger('contact_information_id')->unsigned();
            $table->string('name');
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
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('contact_information_id')->references('id')->on('contact_information')->onDelete('cascade');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couponcodes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->decimal('amount')->unsigned();
            $table->date('active_from')->nullable();
            $table->date('active_till')->nullable();
            $table->enum('type', ['delivery', 'takeaway', 'both']);
            $table->enum('sort', ['percentage', 'amount']);
            $table->decimal('min_amount_spent')->nullable();
            $table->boolean('one_off')->nullable();
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
        Schema::dropIfExists('couponcodes');
    }
}

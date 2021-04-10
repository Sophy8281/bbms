<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscardedPlasmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discarded_plasmas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plasma_id');
            // $table->foreign('plasma_id')->references('id')->on('plasmas')->onUpdate('cascade');
            $table->unsignedBigInteger('bank_id');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('staff_id');
            $table->foreign('staff_id')->references('id')->on('staff');
            $table->unsignedBigInteger('freezer_id');
            $table->foreign('freezer_id')->references('id')->on('freezers')->onUpdate('cascade');
            $table->string('bag_serial_number')->unique();
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')->on('groups')->onUpdate('cascade');
            $table->date('donation_date');
            $table->date('expiry_date');
            $table->dateTime('discarded_at')->nullable();
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
        Schema::dropIfExists('discarded_plasmas');
    }
}
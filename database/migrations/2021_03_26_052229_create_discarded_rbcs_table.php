<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscardedRbcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discarded_rbcs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rbc_id');
            $table->unsignedBigInteger('bank_id');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('staff_id');
            $table->foreign('staff_id')->references('id')->on('staff');
            $table->unsignedBigInteger('refrigerator_id');
            $table->foreign('refrigerator_id')->references('id')->on('refrigerators')->onUpdate('cascade');
            $table->string('bag_serial_number')->unique();
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')->on('groups')->onUpdate('cascade');
            $table->date('donation_date');
            $table->date('expiry_date');
            $table->dateTime('discarded_at');
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
        Schema::dropIfExists('discarded_rbcs');
    }
}
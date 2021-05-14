<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->foreign('staff_id')->references('id')->on('staff');
            $table->unsignedBigInteger('donor_id');
            $table->foreign('donor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('bank_id');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade')->onUpdate('cascade');
            $table->string('bag_serial_number')->unique();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id')->references('id')->on('groups')->onUpdate('cascade');
            $table->string('status')->nullable();
            $table->dateTime('processed_at')->nullable();
            $table->string('plasma_bag_no')->nullable();
            $table->string('platelet_bag_no')->nullable();
            $table->string('rbc_bag_no')->nullable();
            $table->dateTime('stored_at')->nullable();
            $table->dateTime('plasma_stored_at')->nullable();
            $table->dateTime('platelet_stored_at')->nullable();
            $table->dateTime('rbc_stored_at')->nullable();
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
        Schema::dropIfExists('donations');
    }
}

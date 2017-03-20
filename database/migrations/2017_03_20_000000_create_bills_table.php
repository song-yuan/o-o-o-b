<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('bill_id');
            $table->string('bill_sn', 50);
            $table->string('sender_name', 50);
            $table->string('sender_address');
            $table->string('receiver_name', 50);
            $table->string('receiver_address');
            $table->timestamp('sended_at');
            $table->string('signed_at');
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
        Schema::drop('bills');
    }
}

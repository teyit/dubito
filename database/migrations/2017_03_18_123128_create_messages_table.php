<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('report_id');
            $table->string('external_message_id')->nullable();
            $table->bigInteger('sender_id')->nullable();
            $table->bigInteger('recipient_id')->nullable();
            $table->string('account_picture')->nullable();
            $table->string('account_name')->nullable();
            $table->text("text")->nullable();
            $table->integer("case_id")->nullable();
            $table->string("source")->nullable();
            $table->boolean('is_read')->default(0);
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
        Schema::dropIfExists('messages');
    }
}

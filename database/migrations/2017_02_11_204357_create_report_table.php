<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('external_message_id')->nullable();
            $table->integer('external_user_id')->nullable();
            $table->string('account_picture')->nullable();
            $table->string('account_name')->nullable();
            $table->text("text")->nullable();
            $table->integer("case_id")->nullable();
            $table->string("source")->nullable();
            $table->string("phone")->nullable();
            $table->enum('status',['not_assigned','in_archived','pending'])->default('not_assigned');
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
        Schema::dropIfExists('reports');
    }
}

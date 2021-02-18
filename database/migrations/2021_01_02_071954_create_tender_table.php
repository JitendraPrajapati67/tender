<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tender_reference_no')->unique();
            $table->string('tender_title');
            $table->string('tender_discription');
            $table->string('category_id');
            $table->dateTime('open_date');
            $table->dateTime('close_date');
            $table->integer('status');
            $table->integer('type');
            $table->integer('created_by');
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
        Schema::dropIfExists('tender');
    }
}

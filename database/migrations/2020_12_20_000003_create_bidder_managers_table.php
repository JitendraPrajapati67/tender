<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidderManagersTable extends Migration
{
    public function up()
    {
        Schema::create('bidder_managers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supplier_name');
            $table->string('company_reg_number');
            $table->string('company_contact_person');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->longText('address');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
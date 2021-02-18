<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenderMapDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_map_document', function (Blueprint $table) {
            $table->id();
            $table->integer('tender_id')->nullable()->default(0);
            $table->integer('bidder_id')->nullable()->default(0);
            $table->string('document')->unique();
            $table->string('document_orignal_name');
            $table->integer('document_type');
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
        Schema::dropIfExists('tender_map_document');
    }
}

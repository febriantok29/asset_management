<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_asset_transfers', function (Blueprint $table) {
            $table->id();

            // Auto-Generated, with format: YYYY/MM/DD-ATXXX, where XXX is auto-increment with "0" padding
            $table->string('transfer_code', 16)->unique()->nullable(false);
            $table->unsignedBigInteger('asset_id')->nullable(false);
            $table->unsignedBigInteger('from_location_id')->nullable();
            $table->unsignedBigInteger('to_location_id')->nullable(false);
            $table->integer('quantity')->nullable(false);
            $table->date('transfer_date')->nullable(false);
            $table->text('description')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('asset_id')->references('id')->on('m_assets');
            $table->foreign('from_location_id')->references('id')->on('m_locations');
            $table->foreign('to_location_id')->references('id')->on('m_locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_asset_transfers');
    }
};

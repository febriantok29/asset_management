<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('t_asset_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->unsignedBigInteger('asset_id');
            $table->string('transaction_type', 50);
            $table->integer('quantity');
            $table->date('transaction_date');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('asset_id')->references('id')->on('m_assets')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_asset_transactions');
    }
};

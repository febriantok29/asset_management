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
        Schema::create('t_asset_purchases', function (Blueprint $table) {
            $table->id();

            // Auto-Generated, with format: YYYY/MM/DD-APXXX, where XXX is auto-increment with "0" padding
            $table->string('purchase_code', 16)->unique()->nullable(false);
            $table->unsignedBigInteger('asset_id')->nullable(false);
            $table->unsignedBigInteger('vendor_id')->nullable(false);
            $table->integer('quantity')->nullable(false);
            $table->date('purchase_date')->nullable(false);
            $table->decimal('total_cost', 19, 2)->default(0)->nullable(false)->comment('Total biaya dalam Rupiah');
            $table->text('description')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('asset_id')->references('id')->on('m_assets');
            $table->foreign('vendor_id')->references('id')->on('m_vendors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_asset_purchases');
    }
};

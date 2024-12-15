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
        Schema::create('t_asset_repairs', function (Blueprint $table) {
            $table->id();

            // Auto-Generated, with format: YYYY/MM/DD-ARXXX, where XXX is auto-increment with "0" padding
            $table->string('repair_code', 16)->unique()->nullable(false);
            $table->unsignedBigInteger('asset_id')->nullable(false);
            $table->string('technician_name', 256)->nullable();
            $table->date('repair_date')->nullable(false);
            $table->decimal('cost', 19, 2)->nullable()->comment('Biaya repair dalam Rupiah');
            $table->text('issue_description')->nullable();
            $table->enum('status', ['PENDING', 'ONGOING', 'COMPLETED'])->default('PENDING');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('asset_id')->references('id')->on('m_assets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_asset_repairs');
    }
};

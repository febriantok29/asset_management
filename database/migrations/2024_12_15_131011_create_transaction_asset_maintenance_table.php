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
        Schema::create('t_asset_maintenance', function (Blueprint $table) {
            $table->id();

            // Fields: id (PK), maintenance_code (string, unique), asset_id (FK), maintenance_date (date), issue (text), technician (string), cost (decimal, nullable), created_at (timestamp), updated_at (timestamp)

            // Auto-Generated, with format: YYYY/MM/DD-AMXXX, where XXX is auto-increment with "0" padding
            $table->string('maintenance_code', 16)->unique()->nullable(false);
            $table->unsignedBigInteger('asset_id')->nullable(false);
            $table->date('maintenance_date')->nullable(false);
            $table->text('issue')->nullable();
            $table->string('technician', 256)->nullable();
            $table->decimal('cost', 19, 2)->nullable()->comment('Biaya maintenance dalam Rupiah');

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
        Schema::dropIfExists('t_asset_maintenance');
    }
};

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
        Schema::create('m_assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // Nama Aset
            $table->string('status');            // Status Aset (active, maintenance, repair, broken)
            $table->text('description')->nullable();  // Deskripsi Aset
            $table->timestamp('last_maintenance_at')->nullable(); // Waktu perawatan terakhir
            $table->timestamps();                // Kolom created_at dan updated_at
            $table->softDeletes();               // Kolom deleted_at untuk soft delete
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_assets');
    }
};

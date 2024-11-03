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
        Schema::create('t_asset_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Kode transaksi
            $table->unsignedBigInteger('asset_id'); // Relasi ke aset
            $table->unsignedBigInteger('supplier_id')->nullable(); // Relasi opsional ke supplier
            $table->date('transaction_date'); // Tanggal transaksi
            $table->string('type'); // Jenis transaksi (e.g., 'Transfer', 'Maintenance')
            $table->text('notes')->nullable(); // Catatan tambahan
            $table->timestamps();
            $table->softDeletes();

            // Definisikan foreign key
            $table->foreign('asset_id')->references('id')->on('m_assets')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('m_suppliers')->onDelete('set null');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_asset_transactions');
    }
};

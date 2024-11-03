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
            $table->string('name'); // Nama aset
            $table->string('code')->unique(); // Kode aset unik
            $table->unsignedBigInteger('category_id'); // Relasi dengan kategori
            $table->unsignedBigInteger('supplier_id'); // Relasi dengan pemasok
            $table->decimal('purchase_price', 15, 2); // Harga pembelian
            $table->date('purchase_date'); // Tanggal pembelian
            $table->text('description')->nullable(); // Deskripsi aset (opsional)
            $table->timestamps(); // Kolom created_at dan updated_at
            $table->softDeletes(); // Kolom deleted_at untuk soft delete

            // Definisikan foreign key
            $table->foreign('category_id')->references('id')->on('m_categories')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('m_suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset');
    }
};

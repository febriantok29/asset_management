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
        Schema::table('m_assets', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('name'); // Relasi dengan kategori
            $table->unsignedBigInteger('supplier_id')->nullable()->after('category_id'); // Relasi dengan supplier
            $table->decimal('purchase_price', 15, 2)->nullable()->after('supplier_id'); // Harga pembelian
            $table->date('purchase_date')->nullable()->after('purchase_price'); // Tanggal pembelian

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
        Schema::table('m_assets', function (Blueprint $table) {
            //
        });
    }
};

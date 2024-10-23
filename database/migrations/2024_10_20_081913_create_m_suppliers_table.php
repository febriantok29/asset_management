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
        Schema::create('m_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Kode supplier
            $table->string('name'); // Nama supplier
            $table->string('contact_number')->nullable(); // Nomor kontak
            $table->string('email')->nullable(); // Email
            $table->text('address')->nullable(); // Alamat
            $table->timestamps(); // Kolom created_at dan updated_at
            $table->softDeletes(); // Kolom deleted_at
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_suppliers');
    }
};

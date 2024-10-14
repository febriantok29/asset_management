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
            $table->id(); // Primary key
            $table->string('name'); // Nama supplier
            $table->string('email')->unique(); // Email supplier
            $table->string('phone'); // Nomor telepon supplier
            $table->text('address')->nullable(); // Alamat supplier
            $table->timestamps(); // Kolom created_at dan updated_at
            $table->softDeletes(); // Kolom deleted_at untuk soft delete
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

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
        Schema::create('m_vendors', function (Blueprint $table) {
            $table->id();

            $table->string('code', 16)->unique()->nullable(false);
            $table->string('name', 256)->nullable(false);
            $table->string('phone', 16)->nullable();
            $table->string('email', 256)->nullable();
            $table->text('address')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_vendors');
    }
};

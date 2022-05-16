<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPetugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_petugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('petugas_id')->constrained();
            $table->foreignId('lokasi_id')->constrained();
            $table->string('nama_lengkap');
            $table->string('nip');
            $table->string('no_hp');
            $table->string('jenis_kelamin');
            $table->boolean('status_petugas');
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
        Schema::dropIfExists('data_petugas');
    }
}

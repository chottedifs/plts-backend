<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tagihan_id')->constrained('tagihans');
            $table->string('kode_batch');
            $table->string('kode_tagihan');
            $table->date('tgl_kirim');
            $table->date('tgl_terima');
            $table->foreignId('lokasi_id')->constrained();
            $table->foreignId('status_id')->constrained('master_statuses')->default(false);
            $table->text('remarks');
            $table->date('periode');
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
        Schema::dropIfExists('pembayarans');
    }
}

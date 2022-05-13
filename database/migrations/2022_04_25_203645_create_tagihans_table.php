<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained();
            $table->foreignId('outlet_id')->constrained();
            $table->integer('nilai_kwh_awal');
            $table->integer('nilai_kwh_akhir');
            $table->integer('total_kwh');
            $table->integer('jumlah_tagihan');
            $table->date('periode');
            $table->boolean('status_pembayaran')->default(false);
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
        Schema::dropIfExists('tagihans');
    }
}

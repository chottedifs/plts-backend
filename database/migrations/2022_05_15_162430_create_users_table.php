<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->foreignId('login_id')->constrained();
            $table->foreignId('lokasi_id')->constrained();
            $table->string('nama_rekening');
            $table->string('rekening');
            $table->string('nik', 16);
            $table->string('no_hp', 13);
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

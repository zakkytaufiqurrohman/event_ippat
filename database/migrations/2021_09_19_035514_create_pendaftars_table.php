<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();
            $table->integer('pengda');
            $table->string('kode',7);
            $table->string('wa',15);
            $table->string('email',50);
            $table->string('nama',100);
            $table->string('ktp',20);
            $table->string('no_sk',100);
            $table->string('img_sk',100);
            $table->string('img_foto',100);
            $table->string('img_bukti',100);
            $table->string('daftar_ulang',2);
            $table->string('surat_suara',2);
            $table->string('kotak_suara',2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftars');
    }
}

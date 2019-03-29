<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PessoaOpcional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pessoas', function (Blueprint $table) {
            $table->string('sexo','1')->nullable()->change();
            $table->string('endereco','100')->nullable()->change();
            $table->string('tel_res','20')->nullable()->change();
            $table->date('data_nasc')->nullable()->change();
            $table->string('cep','8')->nullable()->change();
            $table->string('numero','10')->nullable()->change();
            $table->string('complemento','50')->nullable()->change();
            $table->string('bairro','50')->nullable()->change();
            $table->string('cidade','50')->nullable()->change();
            $table->string('uf','2')->nullable()->change();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

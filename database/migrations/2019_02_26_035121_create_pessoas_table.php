<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome','100');
            $table->char('sexo','1');
            $table->string('endereco','100');
            $table->string('tel_res','20');
            $table->string('tel_cel','20');
            $table->date('data_nasc');
            $table->string('cpf','14');
            $table->string('cep','8');
            $table->string('email','50');
            $table->string('numero','10');
            $table->string('complemento','50');
            $table->string('bairro','50');
            $table->string('cidade','50');
            $table->char('uf','2');


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
        Schema::dropIfExists('pessoas');
    }
}

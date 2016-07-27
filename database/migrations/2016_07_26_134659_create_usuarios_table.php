<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('usuario')->unique();
            $table->string('senha', 60);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('sintegra', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('idusuario')->unsigned();
            $table->string('cnpj', 25);
            $table->binary('resultado_json');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('usuarios')->insert(
            array(
                'usuario' => 'teste',
                'senha' => Hash::make('123456'), 
                'created_at' => new DateTime(), 
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuarios');
        Schema::drop('sintegra');
    }
}

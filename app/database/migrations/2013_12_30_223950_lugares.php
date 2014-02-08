<?php

use Illuminate\Database\Migrations\Migration;

class Lugares extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::create('places', function($table){
			$table->integer('id');
			$table->integer('aid');
			$table->string('descripcion');
			$table->string('direccion');
			$table->string('dimensiones');
			$table->string('area');
			$table->string('dormitorios');
			$table->string('banios');
			$table->string('garage');
			$table->string('contruida_anio');
			$table->string('piscina');
			$table->string('distritoEscolar');
			$table->string('escuelaKinder');
			$table->string('escuelaPrimaria');
			$table->string('escuelaSecundaria');
			$table->string('url_referencia');
			$table->integer('precio');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('places');
	}

}
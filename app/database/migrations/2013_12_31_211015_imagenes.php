<?php

use Illuminate\Database\Migrations\Migration;

class Imagenes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('imagenes', function($table){
			$table->increments('id');
			$table->string('lid');
			$table->string('url');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('imagenes');
	}

}
<?php

use Illuminate\Database\Migrations\Migration;

class AddColumnsPlaces extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('places', function($p){
			$p->string('descripcionEs');
			$p->renameColumn('dimensiones', 'dimensionesFeet');
			$p->string('dimensionesMeter');
			$p->string('permLink');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('places', function($p){
			$p->dropColumn('descripcionEs');
			$p->dropColumn('dimensionesFeet');
			$p->dropColumn('dimensionesMeter');
			$p->dropColumn('permLink');
		});
	}

}
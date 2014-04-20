<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTumorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tumor', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('patient_id')->index();
            $table->string('topograph');
            $table->string('morphology');
            $table->string('behavior');
            $table->date('incidance_date');
            $table->text('basis_diagnosis');
            $table->string('stage');
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
		Schema::drop('tumor');
	}

}

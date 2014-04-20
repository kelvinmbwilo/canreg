<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('diagnosis', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer("patient_id");
            $table->string("date_of_birth");
            $table->string("basis_of_diagnosis");
            $table->string("site_of_diagnosis");
            $table->string("diagnosis_done_before");
            $table->string("more_diagnosis");
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
		Schema::drop('diagnosis');
	}

}

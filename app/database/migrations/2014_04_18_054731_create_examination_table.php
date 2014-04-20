<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('examination', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer("patient_id");
            $table->string("biopsy_number");
            $table->string("collected_from");
            $table->string("examination_details");
            $table->string("treatment_details");
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
		Schema::drop('examination');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patients', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->string('hosptal_no');
                        $table->string('lab_no');
                        $table->string('first_name');
                        $table->string('middle_name');
                        $table->string('last_name');
                        $table->string('gender');
                        $table->string('phone');
                        $table->date('date_of_birth');
                        $table->string('tribe');
                        $table->string('occupation');
                        $table->string('country');
                        $table->string('region');
                        $table->string('district');
                        $table->string('ward');
                        $table->string('village');
                        $table->string('ten_cell_leder');
                        $table->string('patient_status');
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
		Schema::drop('patients');
	}

}

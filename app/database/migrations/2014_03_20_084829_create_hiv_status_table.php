<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHivStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hiv_status', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer("patient_id");
            $table->integer("tumor_id");
            $table->string("status");
            $table->string("year_of_last_test");
            $table->string("years_since_first_diagnosis");
            $table->string("art_status");
            $table->string("prev_cd4_count");
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
		Schema::drop('hiv_status');
	}

}

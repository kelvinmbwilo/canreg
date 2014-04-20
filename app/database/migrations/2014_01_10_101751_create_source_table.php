<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSourceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('source', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('patient_id')->index();
            $table->integer('tumor_id')->index();
            $table->string('hosptal');
            $table->string('path_lab_no');
            $table->string('unit');
            $table->string('case_no');
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
		Schema::drop('source');
	}

}

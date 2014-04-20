<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMorphologyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('morphology', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string("site_record");
            $table->string("site_description");
            $table->string("histology");
            $table->string("histology_description");
            $table->string("histology_behavior");
            $table->string("histology_behavior_description");
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
		Schema::drop('morphology');
	}

}

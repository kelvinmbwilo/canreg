<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTABLE18Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('TABLE_18', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string("COL_1");
            $table->string("COL_2");
            $table->string("COL_3");
            $table->string("COL_4");
            $table->string("COL_5");
            $table->string("COL_6");
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
		Schema::drop('TABLE_18');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDashboardTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dashboard', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string("title");
            $table->string("welcome_note",2500);
            $table->string("logo");
            $table->string("report");
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
		Schema::drop('dashboard');
	}

}

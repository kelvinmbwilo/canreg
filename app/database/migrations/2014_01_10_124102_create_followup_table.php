<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('followup', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->integer("patient_id");
                        $table->date('last_contact');
                        $table->string("status");
                        $table->string("cause_of_death");
                        $table->string("dr_name");
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
		Schema::drop('followup');
	}

}

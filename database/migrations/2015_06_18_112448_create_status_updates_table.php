<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusUpdatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('status_updates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('is_available')->default(false);

			$table->integer('sensor_id')->unsigned();
    		$table->foreign('sensor_id')->references('id')->on('sensors');

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
		Schema::drop('status_updates');
	}

}

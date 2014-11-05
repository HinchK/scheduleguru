<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddStuffToGoogleProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('google_profiles', function(Blueprint $table)
		{
			$table->string('hd')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('google_profiles', function(Blueprint $table)
		{
			$table->dropColumn('hd');
		});
	}

}

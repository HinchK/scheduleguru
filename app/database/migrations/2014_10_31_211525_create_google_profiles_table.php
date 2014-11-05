<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGoogleProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('google_profiles', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('user_id');
            $table->string('google_id');  //identifier
            $table->string('givenName')->nullable();
            $table->string('familyName')->nullable();
            $table->string('link')->nullable();
            $table->string('locale')->nullable();
            $table->text('name')->nullable();
            $table->string('picture')->nullable();
            $table->string('lastName')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('verifiedEmail')->nullable();
            $table->string('token_id');
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
		Schema::drop('google_profiles');
	}

}

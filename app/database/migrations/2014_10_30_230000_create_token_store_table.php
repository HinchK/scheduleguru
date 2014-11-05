<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokenStoreTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$tableName = 'token_store';
		Schema::create($tableName, function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('google_id');
			$table->string('id_token');
            $table->string('token_type');
			$table->string('access_token');
            $table->time('expires_in');
            $table->time('created');
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
		$tableName = Config::get('token_store');
		Schema::drop($tableName);
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRefreshTokenToTokenStoreTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('token_store', function(Blueprint $table)
		{
            $table->string('refresh_token')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('token_store', function(Blueprint $table)
		{
			$table->dropColumn('refresh_token');
		});
	}

}

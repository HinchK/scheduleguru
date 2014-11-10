<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSummaryColorToGoogleCalendarTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('google_calendars', function(Blueprint $table)
		{
			$table->text('cal_summary');
            $table->text('cal_bg_color');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('google_calendars', function(Blueprint $table)
		{
			$table->dropColumn('cal_summary');
            $table->dropColumn('cal_bg_color');

		});
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTpgSessionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tpg_sessions', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('session_id');
            $table->string('gcal_event_id');
            $table->string('gcal_event_ical_id');
            $table->string('gcal_event_etag');
            $table->string('gcal_html_link');
            $table->string('gcal_status');
            $table->string('gcal_summary');
            $table->string('tutor_id');
            $table->string('student_id');
            $table->string('session_type');
            $table->string('test_type');
            $table->string('completed');
            $table->string('exam_score');
            $table->string('location');
            $table->string('location_details');
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
		Schema::drop('tpg_sessions');
	}

}

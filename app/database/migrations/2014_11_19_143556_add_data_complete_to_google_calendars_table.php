<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDataCompleteToGoogleCalendarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('google_calendars', function(Blueprint $table)
		{
            $table->text('accessRole');
            $table->text('backgroundColor');
            $table->text('colorId');
            $table->text('deleted')->nullable();
            $table->text('description');
            $table->text('etag');
            $table->text('foregroundColor');
            $table->text('hidden');
            $table->text('kind');
            $table->text('location');
            $table->text('primary');
            $table->text('selected');
            $table->text('summary');
            $table->text('summaryOverride');
            $table->text('timeZone');
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
            $table->dropColumn('accessRole');
            $table->dropColumn('backgroundColor');
            $table->dropColumn('colorId');
            $table->dropColumn('deleted');
            $table->dropColumn('description');
            $table->dropColumn('etag');
            $table->dropColumn('foregroundColor');
            $table->dropColumn('hidden');
            $table->dropColumn('kind');
            $table->dropColumn('location');
            $table->dropColumn('primary');
            $table->dropColumn('selected');
            $table->dropColumn('summary');
            $table->dropColumn('summaryOverride');
            $table->dropColumn('timeZone');
        });
	}

}

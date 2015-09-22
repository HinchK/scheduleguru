<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTutors extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tutors', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('calendar_id')->unique();
            $table->text('email')->nullable();
            $table->text('current_students');
            $table->text('past_students');
            $table->text('freebusy');
            $table->text('message_bag');
            $table->string('photo')->nullable()->default(NULL);
            $table->string('name')->nullable()->default(NULL);
            $table->text('notes')->nullable()->default(NULL);
            $table->text('admin_notes');
            $table->string('tutor_type');
            $table->longText('scheduledAppointments')->nullable()->default(NULL);
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
		Schema::drop('tutors');
	}

}

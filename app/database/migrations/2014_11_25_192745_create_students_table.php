<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('student_id')->unique();
            $table->string('email');
            $table->string('calendar_id')->unique();
            $table->text('gmail_message_hits');
            $table->string('photo')->nullable()->default(NULL);
            $table->string('name')->nullable()->default(NULL);
            $table->text('notes')->nullable()->default(NULL);
            $table->text('admin_notes');
            $table->text('admin_parent_notes');
            $table->string('math_tutor');
            $table->string('verbal_tutor');
            $table->string('test_type');
            $table->date('target_test_date')->nullable()->default(NULL);
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
		Schema::drop('students');
	}

}

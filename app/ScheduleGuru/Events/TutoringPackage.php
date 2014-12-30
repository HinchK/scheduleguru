<?php namespace ScheduleGuru\Events {

    class TutoringPackage extends \Eloquent
    {
        protected $fillable = [];

        protected $table = 'tpg_packages';

        public function student()
        {
            return $this->hasOne('Student');
        }

    }
}

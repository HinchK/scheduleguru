<?php namespace ScheduleGuru;

class GoogleProfile extends \Eloquent {

    protected $table = 'google_profiles';
    protected $fillable = array('provider',
                                'user_id',
                                'email',
                                'familyName',
                                'gender',
                                'givenName',
                                'hd',
                                'google_id',     //identifier
                                'link',
                                'locale',
                                'name',
                                'picture',
                                'verifiedEmail',
                                'updated_at',
                                'created_at');

    public function user() {
        return $this->belongsTo('User');
    }

}
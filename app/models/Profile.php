<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 10/3/2014
 * Time: 12:54 PM
 */

class Profile extends Eloquent {

    protected $fillable = array('provider', 'user_id');

    public function user() {
        return $this->belongsTo('User');
    }

} 
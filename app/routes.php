<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('role', 'Role');
Route::model('profile', 'Profile');

/**
 * Experimental model binding for GoogleCalendar spellcasting
 *
 * Disabled for now...
 */
# Route::model('google_calendar','GoogleCalendar');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('comment', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

    # Comment Management
    Route::get('comments/{comment}/edit', 'AdminCommentsController@getEdit');
    Route::post('comments/{comment}/edit', 'AdminCommentsController@postEdit');
    Route::get('comments/{comment}/delete', 'AdminCommentsController@getDelete');
    Route::post('comments/{comment}/delete', 'AdminCommentsController@postDelete');
    Route::controller('comments', 'AdminCommentsController');

    # Blog Management
    Route::get('blogs/{post}/show', 'AdminBlogsController@getShow');
    Route::get('blogs/{post}/edit', 'AdminBlogsController@getEdit');
    Route::post('blogs/{post}/edit', 'AdminBlogsController@postEdit');
    Route::get('blogs/{post}/delete', 'AdminBlogsController@getDelete');
    Route::post('blogs/{post}/delete', 'AdminBlogsController@postDelete');
    Route::controller('blogs', 'AdminBlogsController');

    # User Management
    Route::get('users/{user}/show', 'AdminUsersController@getShow');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete');
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete');
    Route::controller('roles', 'AdminRolesController');

    # Admin Dashboard
    Route::controller('/', 'AdminDashboardController');
});


/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */

// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');

//:: Application Routes ::

# Filter for detect language
Route::when('contact-us','detectLang');

# Contact Us Static Page
Route::get('contact-us', function()
{
    // Return about us page
    return View::make('site/contact-us');
});

# Posts - Second to last set, match slug
Route::get('{postSlug}', 'BlogController@getView');
Route::post('{postSlug}', 'BlogController@postView');

# Index Page - Last route, no matches
Route::get('/', array('before' => 'detectLang','uses' => 'BlogController@getIndex'));


/**
 * Route Controller Resources
 */


Route::group(array('prefix' => 'guru', 'before' => 'auth'), function() {
    Route::get('google/calendars', [
        'as' => 'guru_grab_calendars',
        'uses' => 'GoogleAuthController@setupCalendarServices'
    ]);
    Route::resource('google_calendars', 'GoogleCalendarsController');
});




Route::get('google/login', 'UserController@linkGoogleAcct');



#https://github.com/adamwathan/eloquent-oauth method

Route::get('google/eloquent/authorize', function() {
    return OAuth::authorize('google');
});

Route::get('google/oauth/eloquent', function(){
    try {
        $user = (new Confide(new ConfideEloquentRepository()))->user();
        OAuth::login('google', function($user, $details) {
            $user->nickname = $details->nickname;
            $user->name = $details->firstName . ' ' . $details->lastName;
            $user->profile_image = $details->imageUrl;
            $user->save();
        });
    } catch (ApplicationRejectedException $e) {
        // User rejected application
        dd($e);
    } catch (InvalidAuthorizationCodeException $e) {
        // Authorization was attempted with invalid
        // code,likely forgery attempt
        dd($e);
    }

    // Current user is now available via Auth facade
    $user = Auth::user();

    return Redirect::intended();
});


//KDOGG:WERK
//ROUTE-SPROUTING - A MOST VILE HERESEY OF IN THE MOST UNHOLY NAME OF OAUTH 
//Debugbar::info($object);
//Debugbar::error("Error!");
//Debugbar::warning('Watch out..');
//Debugbar::addMessage('Another message', 'mylabel');

/**
 * 

 https://accounts.google.com/o/oauth2/auth?response_type=code
 &redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fadmin%2Fdashboard
 &client_id=602226060632-9oomeuk9gh1eb0ik8vpnbu9hndb0saq7.apps.googleusercontent.com
 &scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fcalendar&access_type=online
 &approval_prompt=auto

 warning

Error calling GET https://www.googleapis.com/calendar/v3/users/me/calendarList: (401) Login Required
/home/vagrant/Code/scheduleguru/vendor/google/apiclient/src/Google/Http/REST.php#79

 *
 */


Route::get('google/calendars', function()
{

});

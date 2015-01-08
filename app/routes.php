<?php

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('role', 'Role');
Route::model('profile', 'Profile');
Route::model('student', 'Student');

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



// Confide routes
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('users/login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');
Route::get('user/logout', 'UsersController@logout');

/** ------------------------------------------
 * OLD Confide < 4 Frontend Routes
 *  ------------------------------------------
 */
/**
 *

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
 */
//:: Application Routes ::

# Filter for detect language
Route::when('contact-us','detectLang');


/* TODO:disabled - re-enable the blog stuff off a /blog/ path
# Posts - Second to last set, match slug
Route::get('{postSlug}', 'BlogController@getView');
Route::post('{postSlug}', 'BlogController@p ostView');
*/

/*
 * TODO: WRAP CONNECTING TO APP WITH AUTH
 */
# Authenticated using the "Neo" Account? lets fire up some  google/pages
Route::group(array('prefix' => 'google', 'before' => 'auth'), function()
{

});

Route::group(array('prefix' => 'guru', 'before' => 'auth'), function() {

    Route::get('dash', [
        'as' => 'old_dashboard_primary',
        'uses' => 'GoogleCalendarsController@indexGuru'
    ]);

	Route::post('dash', [
		'as' => 'old_dashboard_primary',
		'uses' => 'GoogleCalendarsController@store'
	]);

    Route::get('students', [
        'as' => 'student_management_old',
        'uses' => 'StudentsController@manage'
    ]);

    Route::get('{studentSlug}', 'StudentsController@studentPage');

    Route::get('{studentSlug}/convert-events', 'StudentsController@convertEventsToPackage');

    Route::post('convert-events', [
        'as' => 'convert_package_sessions_old',
        'uses' => 'StudentsController@postCreatePackageSessions'
    ]);

    Route::get('tutors', [
        'as' => 'tutor_management_old',
        'uses' => 'TutorsController@manage'
    ]);

    Route::get('events', [
        'as' => 'event_management_old',
        'uses' => 'GoogleCalendarsController@events'
    ]);
    Route::resource('google_calendars', 'GoogleCalendarsController');
});
Route::group(array('prefix' => 'student', 'before' => 'auth'), function() {

    Route::get('{studentSlug}',[
        'as' => 'student_page',
        'uses' => 'StudentsController@studentPage'

    ]);

    Route::get('{studentSlug}/convert-events', 'StudentsController@convertEventsToPackage');

    Route::post('svc/convert', [
        'as' => 'convert_package_sessions',
        'uses' => 'StudentsController@postCreatePackageSessions'
    ]);

});
Route::group(array('prefix' => 'dash', 'before' => 'auth'), function() {

    Route::get('/', [
        'as' => 'dashboard_primary',
        'uses' => 'GoogleCalendarsController@index'
    ]);

    Route::post('/', [
        'as' => 'dashboard_primary',
        'uses' => 'GoogleCalendarsController@store'
    ]);

    Route::get('students', [
        'as' => 'student_management',
        'uses' => 'StudentsController@manage'
    ]);



    Route::get('tutors', [
        'as' => 'tutor_management',
        'uses' => 'TutorsController@manage'
    ]);

    Route::get('events', [
        'as' => 'event_management',
        'uses' => 'GoogleCalendarsController@events'
    ]);
    Route::resource('google_calendars', 'GoogleCalendarsController');
});


Route::get('/google/welcome', [
    'as' => 'google_welcome',
    'uses' => 'GoogleAuthController@welcome'
]);

//Route::get('/ajax/dashboard', 'GoogleCalendarsController@index');

# (old-blog)  Index Page - Last route, no matches
//Route::get('/', array('before' => 'detectLang','uses' => 'BlogController@getIndex'));

# Contact Us Static Page
Route::get('contact-us', function()
{
    // Return about us page
    return View::make('site/contact-us');
});

# TODO: all the buillshit below here has gotta go
//below is handled in filters.php, can probably go




Route::get('/', 'GoogleAuthController@superUserGoogleLogin');

//ROUTE-SPROUTING - A MOST VILE HERESEY OF IN THE MOST UNHOLY NAME OF OAUTH
//Debugbar::info($object);
//Debugbar::error("Error!");
//Debugbar::warning('Watch out..');
//Debugbar::addMessage('Another message', 'mylabel');
//Route::get('/google/dashboard', 'GoogleAuthController@superUserGoogleLogin');
Route::get('/google', 'GoogleAuthController@superUserGoogleLogin');

Route::get('/google/logout', [
    'as' => 'google_logout',
    'uses' => 'GoogleAuthController@logout'
]);

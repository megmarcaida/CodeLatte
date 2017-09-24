<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('admin/register', 'AdminAuth\RegisterController@showRegistrationForm');
Route::post('admin/register', 'AdminAuth\RegisterController@register');

Route::get('/admin/home', function(){
    return view('admin.home');
});
Route::get('admin/login', 'AdminAuth\AdminLoginController@showLoginForm');
Route::post('admin/login', 'AdminAuth\AdminLoginController@login');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'],function(){
    Route::get('/profile/{slug}',[
       'uses' => 'ProfilesController@index',
        'as' => 'profile'
    ]);

    Route::get('/profile/edit/profile',[
        'uses' => 'ProfilesController@edit',
        'as' => 'profile.edit'
    ]);

    Route::post('/profile/update/profile',[
        'uses' => 'ProfilesController@update',
        'as' => 'profile.update'
    ]);

    Route::get('/check_relationship_status/{id}', [
        'uses' => 'FriendshipsController@check',
        'as' => 'check'
    ]);

    Route::get('/add_friend/{id}', [
        'uses' => 'FriendshipsController@add_friend',
        'as' => 'add_friend'
    ]);

    Route::get('/unfriend_friend/{id}',[
        'uses' => 'FriendshipsController@unfriend_friend',
        'as' => 'unfriend_friend'
    ]);

    Route::get('/accept_friend/{id}', [
        'uses' => 'FriendshipsController@accept_friend',
        'as' => 'accept_friend'
    ]);

    Route::get('get_unread' ,function(){
        return Auth::user()->unreadNotifications;
    });

    Route::get('/notifications', [
        'uses' => 'HomeController@notifications',
        'as' => 'notifications'
    ]);

    Route::get('/feed', [
        'uses' => 'FeedsController@feed',
        'as' => 'feed'
    ]);

    Route::post('/create/post',[
       'uses' => 'PostsController@store'
    ]);

    Route::get('/get_auth_user_data', function(){
        return Auth::user();
    });

    Route::get('/like/{id}',[
        'uses' => 'LikesController@like'
    ]);

    Route::get('/unlike/{id}',[
        'uses' => 'LikesController@unlike'
    ]);
});

//Only logged in sellers can access or send requests to these pages
Route::group(['middleware' => 'admin_auth'], function(){

    Route::post('admin/logout', 'AdminAuth\AdminLoginController@logout');
    Route::get('/admin/home', function(){
        return view('admin.home');
    });

//MASTERFILE
    //FAQS
    Route::post('/admin/faqs/add',[
        'uses' => 'FaqsController@add'
    ]);
    Route::get('/admin/faq', function(){
        return view('admin.master-file.faqs');
    });

    Route::get('/admin/faqs/list', [
        'uses' => 'faqsController@faqs',
        'as' => 'faqs'
    ]);

    Route::delete('/admin/faqs/delete/{id}', [
        'uses' => 'faqsController@delete'
    ]);

    Route::patch('/admin/faqs/update/{id}', 'faqsController@update');

    //ENDFAQS

    //Glossary
    Route::post('/admin/glossary/add',[
        'uses' => 'GlossaryController@add'
    ]);
    Route::get('/admin/glossary', function(){
        return view('admin.master-file.glossary');
    });

    Route::get('/admin/glossary/list', [
        'uses' => 'GlossaryController@glossary',
        'as' => 'glossary'
    ]);

    Route::delete('/admin/glossary/delete/{id}', [
        'uses' => 'GlossaryController@delete'
    ]);

    Route::patch('/admin/glossary/update/{id}', 'GlossaryController@update');

    //EndGlossary

    //Currency
    Route::post('/admin/currency/add',[
        'uses' => 'CurrencyController@add'
    ]);
    Route::get('/admin/currency', function(){
        return view('admin.master-file.currency');
    });

    Route::get('/admin/currency/list', [
        'uses' => 'CurrencyController@currency',
        'as' => 'currency'
    ]);

    Route::delete('/admin/currency/delete/{id}', [
        'uses' => 'CurrencyController@delete'
    ]);

    Route::patch('/admin/currency/update/{id}', 'CurrencyController@update');

    //EndCurrency

    //Plans
    Route::post('/admin/plans/add',[
        'uses' => 'PlansController@add'
    ]);
    Route::get('/admin/plans', function(){
        return view('admin.master-file.plans');
    });

    Route::get('/admin/plans/list', [
        'uses' => 'PlansController@plans',
        'as' => 'plans'
    ]);

    Route::delete('/admin/plans/delete/{id}', [
        'uses' => 'PlansController@delete'
    ]);

    Route::patch('/admin/plans/update/{id}', 'PlansController@update');

    //EndPlans

    //ProgrammingLanguage
    Route::post('/admin/programminglanguage/add',[
        'uses' => 'ProgrammingLanguageController@add'
    ]);
    Route::get('/admin/programminglanguage', function(){
        return view('admin.master-file.programming-language');
    });

    Route::get('/admin/programminglanguage/list', [
        'uses' => 'ProgrammingLanguageController@programminglanguage',
        'as' => 'plans'
    ]);

    Route::delete('/admin/programminglanguage/delete/{id}', [
        'uses' => 'ProgrammingLanguageController@delete'
    ]);

    Route::patch('/admin/programminglanguage/update/{id}', 'ProgrammingLanguageController@update');

    //EndProgrammingLanguage


    //Plans
    Route::post('/admin/plans-content/add',[
        'uses' => 'PlansContentController@add'
    ]);
    Route::get('/admin/plans-content', function(){
        return view('admin.master-file.plans-content');
    });

    Route::get('/admin/plans-content/list', [
        'uses' => 'PlansContentController@planscontent',
        'as' => 'plans-content'
    ]);

    Route::delete('/admin/plans-content/delete/{id}', [
        'uses' => 'PlansContentController@delete'
    ]);

    Route::patch('/admin/plans-content/update/{id}', 'PlansContentController@update');

    //EndPlans
//ENDMASTERFILE

//GALLERY
    //MEDIA


    Route::get('admin/media', 'MediaController@index');
    Route::get('admin/media/get/{filename}', [
        'as' => 'getmedia', 'uses' => 'MediaController@get']);
    Route::post('admin/media/add',[
        'as' => 'addmedia', 'uses' => 'MediaController@add']);

    Route::get('/admin/media/delete/{id}', [
        'uses' => 'MediaController@delete'
    ]);

    Route::post('admin/media/update',[
        'as' => 'updatemedia', 'uses' => 'MediaController@update']);
    //EndMEDIA
//ENDGALLERY

//COURSES
    Route::get('/admin/course', function(){
        return view('admin.courses.course-list');
    });

    Route::get('/admin/tutorials', function(){
        return view('admin.courses.tutorials');
    });

    Route::get('admin/templates', function() {
        return view('admin.courses.templates');
    });

//END COURSES


//USERS

    Route::get('admin/users', function() {
        return view('admin.users.list-of-users');
    });

    Route::get('admin/billing', function() {
        return view('admin.users.billing');
    });

    Route::get('admin/videos', function() {
        return view('admin.users.progress');
    });

    Route::get('admin/support', function() {
        return view('admin.users.support-center');
    });

    Route::get('admin/files ', function() {
        return view('admin.users.courses');
    });

//END USERS

//TEST
    Route::get('admin/activities', function() {
        return view('admin.test.code-block');
    });
    Route::get('admin/questionnaires', function() {
        return view('admin.test.questionnaires');
    });
    Route::get('admin/quizzes', function() {
        return view('admin.test.quiz');
    });

//END TEST
});
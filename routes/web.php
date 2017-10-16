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



Route::get('/register/{plan}/', [
    'uses' => 'Auth\RegisterController@getPlans',
    'as' => 'getplans'
]);

Route::get('/braintree/token', 'BraintreeTokenController@token');
Route::post('/subscribe', 'SubscriptionController@store');

//HOMEPAGES
Route::get('/plan',[
    'uses' => 'PlansController@getPlans'

]);
Route::get('/about', function() {
    return view('about');
});

Route::get('/gallery', function() {
    return view('gallery');
});

Route::get('/faqs', function() {
    return view('faqs');
});

Route::get('/courses', function() {
    return view('courses');
});

Route::get('/contact_us', function() {
    return view('contact_us');
});
Route::get('/testimonials', function() {
    return view('testimonials');
});

//ENDPAGES

//SMS

Route::get('/sms/send/{to}', function(\Nexmo\Client $nexmo, $to){
    $message = $nexmo->message()->send([
        'to' => $to,
        'from' => '@leggetter',
        'text' => 'Sending SMS from Laravel. Woohoo!'
    ]);
    Log::info('sent message: ' . $message['message-id']);
});

//ENDSMS


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


    //FOR USER PAGES

    //CURRICULUM

    Route::get('/users/curriculum',[
        'uses' => 'CourseListController@curriculum',
        'as' => 'userscurriculum'
    ]);

    Route::get('/users/curriculum/take/{slug}',[
        'uses' => 'CourseListController@index',
        'as' => 'curriculum'
    ]);

    Route::get('/users/library/{course_slug}/{tutorial_slug}',[
        'uses' => 'CourseListController@starttutorial',
        'as' => 'starttutorial'
    ]);

    Route::get('/users/curriculum/list',[
        'uses' => 'CourseListController@getCurriculum'
    ]);

    Route::get('users/get/{filename}', [
        'as' => 'usersgetmedia', 'uses' => 'MediaController@get']);


    Route::get('users/tutorial/take/quiz/{slug}', [
        'as' => 'takequizzes', 'uses' => 'QuizController@getQuiz']);

    Route::post('/users/tutorial/take/quiz/answer',[
        'uses' => 'UsersQuizAnswerController@createAnswer',
        'as' => 'createAnswer'
    ]);
    //ENDCURRICULUM


    //PLANS
    Route::get('/users/check_plans',[
        'uses' => 'PlansController@checkPlans'

    ]);

    Route::get('/users/upgrade/{slug}/',[
        'uses' => 'PlansController@upgradePlans'

    ]);

    Route::post('/users/upgrade/payment',[
        'uses' => 'PlansController@payNow',
        'as' => 'payment'
    ]);

    Route::group(['middleware' => 'subscribed'], function () {

        Route::get('/users/billing-info',[
            'uses' => 'PlansController@billingInfo'

        ]);
        Route::post('/subscription/cancel', 'SubscriptionController@cancel');
        Route::post('/subscription/resume', 'SubscriptionController@resume');
    });
    //ENDPLANS



    Route::get('/users/glossary', function(){
        return view('users.glossary');
    });

    Route::get('/users/progress',[
        'uses' => 'UsersQuizAnswerController@progress'

    ]);

    //USER PAGES

});

//Only logged in sellers can access or send requests to these pages
Route::group(['middleware' => 'admin_auth'], function(){

    Route::post('admin/logout', 'AdminAuth\AdminLoginController@logout');
    Route::get('/admin/home', function(){
        return view('admin.home');
    });

#MASTERFILE
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
        'as' => 'programminglanguage'
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
#ENDMASTERFILE

#GALLERY
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

    Route::get('/admin/media/list', [
        'uses' => 'MediaController@media',
        'as' => 'course-list'
    ]);
    //EndMEDIA
#ENDGALLERY

#COURSES

    //Course-List
    Route::post('/admin/course-list/add',[
        'uses' => 'CourseListController@add'
    ]);

    Route::get('/admin/course-list', function(){
        return view('admin.courses.course-list');
    });


    Route::get('/admin/course-list/list', [
        'uses' => 'CourseListController@courseList',
        'as' => 'course-list'
    ]);

    Route::get('/admin/course-list/details/{id}', [
        'uses' => 'CourseListController@courseDetails',
        'as' => 'course-details'
    ]);

    Route::delete('/admin/course-list/delete/{id}', [
        'uses' => 'CourseListController@delete'
    ]);

    Route::patch('/admin/course-list/update/{id}', 'CourseListController@update');
    //ENDCOURSE-LIST

    //TUTORIALS
    Route::post('/admin/tutorials/add',[
        'uses' => 'TutorialsController@add'
    ]);

    Route::get('/admin/tutorials', function(){
        return view('admin.courses.tutorials');
    });

    Route::get('/admin/tutorials/list', [
        'uses' => 'TutorialsController@tutorials',
        'as' => 'course-list'
    ]);

    Route::delete('/admin/tutorials/delete/{id}', [
        'uses' => 'TutorialsController@delete'
    ]);

    Route::patch('/admin/tutorials/update/{id}', 'TutorialsController@update');
    //ENDTUTORIALS

    //TEMPLATES

    Route::get('admin/templates', function() {
        return view('admin.courses.templates');
    });

    //ENDTEMPLATES

#END COURSES


#USERS

    //USERS-LIST
    Route::get('admin/users', function() {
        return view('admin.users.list-of-users');
    });
    //ENDUSERS-LIST


    //BILLING
    Route::get('admin/billing', function() {
        return view('admin.users.billing');
    });
    //ENDBILLING

    //USERSPROGRESS
    Route::get('admin/progress', function() {
        return view('admin.users.progress');
    });
    //ENDUSERPROGRESS

    //SUPPORT
    Route::get('admin/support', function() {
        return view('admin.users.support-center');
    });
    //ENDSUPPORT


    //USERCOURSES
    Route::get('admin/courses ', function() {
        return view('admin.users.courses');
    });
    //ENDUSERCOURSES

#END USERS

#TEST
    Route::get('admin/code-block', function() {
        return view('admin.test.code-block');
    });


    //QUESTIONNAIRES
    Route::post('/admin/questionnaires/add',[
        'uses' => 'QuestionnairesController@add'
    ]);

    Route::get('admin/questionnaires', function() {
        return view('admin.test.questionnaires');
    });

    Route::get('/admin/questionnaires/list', [
        'uses' => 'QuestionnairesController@questionnaires',
        'as' => 'questionnaires'
    ]);

    Route::delete('/admin/questionnaires/delete/{id}', [
        'uses' => 'QuestionnairesController@delete'
    ]);

    Route::patch('/admin/questionnaires/update/{id}', 'QuestionnairesController@update');


    //ENDQUESTIONNAIRES


    //QUIZ

    Route::post('/admin/quiz/add',[
        'uses' => 'QuizController@add'
    ]);

    Route::get('admin/quiz', function() {
        return view('admin.test.quiz');
    });

    Route::get('/admin/quiz/list', [
        'uses' => 'QuizController@quiz',
        'as' => 'quizzes'
    ]);

    Route::get('/admin/quiz/details/{id}', [
        'uses' => 'QuizController@quizDetails',
        'as' => 'course-details'
    ]);

    Route::delete('/admin/quiz/delete/{id}', [
        'uses' => 'QuizController@delete'
    ]);

    Route::patch('/admin/quiz/update/{id}', 'QuizController@update');

    //ENDQUIZ


#END TEST
});
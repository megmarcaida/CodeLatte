
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('init', require('./components/Init.vue'));
Vue.component('feed', require('./components/Feed.vue'));
Vue.component('post', require('./components/Post.vue'));
Vue.component('search', require('./components/Search.vue'));
Vue.component('friend', require('./components/Friend.vue'));
Vue.component('unread', require('./components/UnreadNots.vue'));
Vue.component('notification', require('./components/Notification.vue'));


//MASTERFILE

Vue.component('faqs', require('./components/MasterFile/Faqs.vue'));
Vue.component('listfaqs', require('./components/MasterFile/ListFaqs.vue'));
Vue.component('glossary', require('./components/MasterFile/Glossary.vue'));
Vue.component('listglossary', require('./components/MasterFile/ListGlossary.vue'));
Vue.component('currency', require('./components/MasterFile/Currency.vue'));
Vue.component('listcurrency', require('./components/MasterFile/ListCurrency.vue'));
Vue.component('plans', require('./components/MasterFile/Plans.vue'));
Vue.component('listplans', require('./components/MasterFile/ListPlans.vue'));
Vue.component('programminglanguage', require('./components/MasterFile/ProgrammingLanguage.vue'));
Vue.component('listprogramminglanguage', require('./components/MasterFile/ListProgrammingLanguage.vue'));
Vue.component('planscontent', require('./components/MasterFile/PlansContent.vue'));
Vue.component('listplanscontent', require('./components/MasterFile/ListPlansContent.vue'));
//ENDMASTERFILE

//GALLERY
Vue.component('media', require('./components/Gallery/Media.vue'));
Vue.component('listmedia', require('./components/Gallery/ListMedia.vue'));
//ENDGALLERY

//TUTORIALS
Vue.component('tutorials', require('./components/Courses/Tutorials.vue'));
Vue.component('listtutorials', require('./components/Courses/ListTutorials.vue'));
Vue.component('courselist', require('./components/Courses/CourseList.vue'));
Vue.component('listcourselist', require('./components/Courses/ListCourseList.vue'));
Vue.component('coursedetails', require('./components/Courses/CourseDetails.vue'));
//ENDTUTORIALS

//TEST
Vue.component('quiz', require('./components/Test/Quiz.vue'));
Vue.component('listquiz', require('./components/Test/ListQuiz.vue'));
Vue.component('quizdetails', require('./components/Test/QuizDetails.vue'));
Vue.component('questionnaires', require('./components/Test/Questionnaires.vue'));
Vue.component('listquestionnaires', require('./components/Test/ListQuestionnaires.vue'));
//ENDTEST

//USERS
Vue.component('curriculum', require('./components/Users/Curriculum.vue'));
//ENDUSERS


import { store } from './store'

const app = new Vue({
    el: '#app',
    store,

});
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('summernote');

window.Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// infinite
Vue.component('InfiniteLoading', require('vue-infinite-loading'));

// Header
Vue.component('header-component', require('./components/HeaderComponent.vue').default);
Vue.component('head-component', require('./components/HeadComponent.vue').default);

// Parent
Vue.component('parent-component', require('./components/ParentComponent.vue').default);
Vue.component('post-parent-component', require('./components/PostParentComponent.vue').default);
Vue.component('options-component', require('./components/OptionsComponent.vue').default);

// Post
Vue.component('post-component', require('./components/PostComponent.vue').default);
Vue.component('recentposts-component', require('./components/RecentpostsComponent.vue').default);
Vue.component('popular-component', require('./components/PopularComponent.vue').default);
Vue.component('most-viewed-posts-component', require('./components/MostViewedPostsComponent.vue').default);
Vue.component('userrandompost-component', require('./components/UserrandompostComponent.vue').default);
Vue.component('userrandompostexcept-component', require('./components/UserrandompostexceptComponent.vue').default);
Vue.component('random-post-component', require('./components/RandompostComponent.vue').default);
Vue.component('repost-component', require('./components/RepostComponent.vue').default);


// Hashtags
Vue.component('hashtags-component', require('./components/HashtagsComponent.vue').default);


// Categories
Vue.component('createcategory-component', require('./components/CreatecategoryComponent.vue').default);
Vue.component('category-component', require('./components/categoryComponent.vue').default);
Vue.component('top-categories-component', require('./components/TopCategoriesComponent.vue').default);

// Comments and replies
Vue.component('comment-container-component', require('./components/CommentContainerComponent.vue').default);
Vue.component('comment-component', require('./components/CommentComponent.vue').default);
Vue.component('comments-component', require('./components/CommentsComponent.vue').default);
Vue.component('reply-component', require('./components/ReplyComponent.vue').default);



// Shortie
Vue.component('shortie-component', require('./components/ShortieComponent.vue').default);
Vue.component('shortie-options-component', require('./components/ShortieOptionsComponent.vue').default);
Vue.component('thread-component', require('./components/ThreadComponent.vue').default);
Vue.component('shortie-image-component', require('./components/ShortieImageComponent.vue').default);
Vue.component('shortie-controls-component', require('./components/ShortieControlsComponent -.vue').default);

Vue.component('my-thread-component', require('./components/MyThreadComponent.vue').default);
Vue.component('my-shortie-component', require('./components/MyShortieComponent.vue').default);

Vue.component('view-thread-component', require('./components/ViewThreadComponent.vue').default);
Vue.component('view-shortie-component', require('./components/ViewShortieComponent.vue').default);

Vue.component('home-component', require('./components/HomeComponent.vue').default);

Vue.component('feed-component', require('./components/FeedComponent.vue').default);
Vue.component('f-component', require('./components/FComponent.vue').default);
Vue.component('feed-controls-component', require('./components/FeedControlsComponent.vue').default);
Vue.component('like-component', require('./components/LikeComponent.vue').default);


Vue.component('view-component', require('./components/ViewComponent.vue').default);
Vue.component('read-post-component', require('./components/ReadPostComponent.vue').default);
Vue.component('share-component', require('./components/ShareComponent.vue').default);
Vue.component('quote-component', require('./components/QuoteComponent.vue').default);

// Profile Picture
Vue.component('profile-picture-component', require('./components/ProfilePictureComponent.vue').default);

// Chat
Vue.component('messages-component', require('./components/MessagesComponent.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);
Vue.component('chat-component', require('./components/Chat.vue').default);


// Group
Vue.component('group-component', require('./components/GroupComponent.vue').default);
Vue.component('send-group-invite-component', require('./components/SendGroupInviteComponent.vue').default);

// Search
Vue.component('search-component', require('./components/SearchComponent.vue').default);
Vue.component('postsearch-component', require('./components/PostsearchComponent.vue').default);

Vue.component('load-component', require('./components/LoadComponent.vue').default);

// Profile
Vue.component('user-component', require('./components/UserComponent.vue').default);
Vue.component('accounts-component', require('./components/AccountsComponent.vue').default);
Vue.component('follow-component', require('./components/FollowComponent.vue').default);
Vue.component('follows-component', require('./components/FollowsComponent.vue').default);
Vue.component('profile-component', require('./components/ProfileComponent.vue').default);
Vue.component('photos-component', require('./components/PhotosComponent.vue').default);

// Quiz
Vue.component('quiz-component', require('./components/QuizComponent.vue').default);
Vue.component('poll-component', require('./components/PollComponent.vue').default);

// Queue
Vue.component('queue-component', require('./components/QueueComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

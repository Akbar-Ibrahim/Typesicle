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

use App\Category;
use App\Events\LikeFeed;
use App\Feed;
use App\GroupMember;
use App\Post;
use App\Shortie;
use App\User;
use Carbon\Carbon;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

Route::get('/', 'WelcomeController@welcome');



Route::get("/date", function(){

    // $post = Post::where("id", 8)->first();
    // $post->update(["publish_at" => Carbon::now()->addMinutes(5)->toDateTimeString()]);
        // $currentDateTime = Carbon::now()->toDateTimeString();
        
        // if ($post->publish_at == $currentDateTime){
        //     return "true";
        // }
        // GroupMember::create(["user_id" => 4, "group_id" => 1, "type" => "member", "status" => "pending"]);


        Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
        {
            $message->subject('Mailgun and Laravel are awesome!');
            $message->from('no-reply@website_name.com', 'Website Name');
            $message->to('akbaribrahimafolabi@gmail.com');
        });

        return "done";
    });


    Route::get('pusher', function(){
        
     //   broadcast(new LikeFeed(1, "like"))->toOthers();
        //    broadcast(new LikeFeed(1, "like"))->toOthers();
        
        $user = auth()->user();
        $resultSet = Feed::with('user.profile', 'post.user', 'post.photo', 'shortie.thread', 'shortie.user.profile', 'shortie.shortiePhoto.photo', 'quiz')->orderBy('created_at', 'desc')->get();
        $feeds = [];

        foreach($resultSet as $result) {
            if ($user->isFollowing($result->user->profile->id) || $result->user->isFollowing($user->profile->id)) {
            array_push($feeds, $result);
            }
        }

        return view('includes.shortie', compact('feeds'));

    });



// Auth::routes();
Auth::routes(['verify' => true]);



Route::get('google', function () {
    return view('google');
});
Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');


Route::get('/home', 'HomeController@index')->name('home')->middleware("verified", "auth");
// Route::get('/forgot-password', function () {
//     return view('auth.forgot-password');
// })->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

// Route::get('/reset-password/{token}', function ($token) {
//     return view('auth.reset-password', ['token' => $token]);
// })->middleware('guest')->name('password.reset');


Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');









// Notifications

Route::get("/notifications", "NotificationController@index")->name("notification.index");
// Route::post("/notification/store", "NotificationController@store")->name("notification.store");







// Post
Route::resource('post', 'PostController')->middleware(['auth']);
Route::get('post/{username}/{url}/{id}', ['as' => 'post.url', 'uses' => 'PostUtilController@post' ]);

Route::get('/repost/{id}', 'RepostController@repost')->name('post.repost');
Route::post('/post-repost/{id}', 'RepostController@handleRepost')->name('post.repost');



// WRITE
Route::resource('write', 'PostController')->middleware(['auth']);
Route::get('response', 'PostUtilController@response')->middleware(['auth'])->name("response.write");
Route::post('post-preview', 'PostUtilController@preview')->middleware(['auth'])->name("post.preview");

Route::get('delete-post/{id}', 'PostUtilController@deletePost')->middleware(['auth'])->name("delete.post");

// Draft
Route::resource('draft', 'DraftController')->middleware('auth');


// Quiz
Route::resource('quiz', 'QuizController')->middleware(['auth']);
Route::get('/{user}/quizzes', 'QuizController@index')->name('quizzes');
Route::get('/quiz/stats', 'QuizUtilController@quizStats')->name('quiz:stats');
Route::get('/quiz/player-answer', 'QuizUtilController@playerAnswer')->name('player:answer');
Route::get('/quiz/play-status', 'QuizUtilController@playStatus')->name('play:status');
Route::get('/quiz/play/{id}', 'QuizUtilController@play')->name('quiz.play');
Route::get('quiz/new', 'QuizUtilController@newQuiz')->name('quiz:new')->middleware("auth");

// Poll
Route::resource('poll', 'PollController')->middleware(['auth']);
Route::post('vote', 'PollUtilController@vote');
Route::get('myvote/{poll_id}', 'PollUtilController@myVote');


// Like
Route::get('/{username}/liked/posts', 'LikeController@likedPosts')->name('liked:posts')->middleware('auth');
Route::get('/post-likes/{id}', 'LikeController@getPostLikes')->name('post.likes');
Route::post('/posts/{id}/{user_id}/action', 'LikeController@LikeAction');
Route::post('/share/{id}/{user_id}/action', 'RepostController@share');
Route::post('/queue/post/{id}/{user_id}/action', 'PostUtilController@queueAction');


// Category
Route::resource('/category', 'CategoryController');
// Route::get('/category/{id}/{url}', 'CategoryController@category')->name('category.name'); 
Route::post('/category-create', 'CategoryUtilController@createCategory')->name('categories-create');
Route::get('/{username}/category/{categoryURL}', 'CategoryUtilController@getCategory')->name('category-name');


// Email
Route::post('/email-user', 'PostUtilController@emailPost')->middleware('auth')->name('email-post');

// Hashtags
Route::get('hashtag/{hashtag}', 'PostUtilController@getHashtagPosts')->name('hashtag')->middleware('auth');

// Shorties
Route::get('shortie/create', 'ShortieController@create')->name('shortie-create')->middleware('auth');
Route::post('shortie/store', 'ShortieController@storeShortie')->name('store:shortie')->middleware('auth');
Route::get("/shortie/{username}/{id}", "ShortieController@shortie")->name("shortie.url");
Route::get('/{username}/shorties', 'PostController@shorties')->name('shorties')->middleware(['auth']);
Route::post('/w/o/shortie', 'ShortieController@withoutShortie')->name('wo.shortie')->middleware(['auth']);


// Load feeds
Route::get('/feeds/{id}', 'PostUtilController@getAllFeeds');
Route::get('/allposts/{id}', 'PostUtilController@getAllPosts');
Route::get('/allshorties/{id}', 'PostUtilController@getAllShorties');

Route::post('shortie/comment', 'ShortieController@storeShortieComment')->name('store:shortie-comment')->middleware('auth');

// Thread
Route::get("/thread/{username}/{id}", "ThreadController@thread")->name("thread.url");

// Published Replies
Route::get('/{username}/published-replies', 'PostUtilController@publishedReplies')->name('published-replies')->middleware(['auth']);


// Search
Route::any('/search-author', 'SearchController@searchAuthor')->name('search.author');
Route::any('/search-post', 'SearchController@searchPost')->name('search.post');



// Photos
Route::get('/{username}/photos', 'PhotoController@photos')->name('photos.index');

//History
Route::get('/{username}/history',  'HistoryController@index')->name('history.index');
Route::delete('/history/delete',  'HistoryController@delete')->name('history.delete');


// Queues
Route::resource('queue', 'QueueController')->middleware('auth');
Route::post('add/queue', 'QueueController@saveToQueue')->name('add.queue');
Route::get('all/queue', 'QueueController@index')->name('get.queue')->middleware('auth');
Route::delete('queue/delete', 'QueueController@deleteFromQueue')->name('delete.queue');

//Follow
Route::get('profile-follow', 'FollowController@followProfile')->name('follow:profile')->middleware('auth');


// Group
Route::get("/group/index", "GroupController@index")->name("group.index");
Route::get("/group/create", "GroupController@create")->name("group.create");
Route::post("/group-create", "GroupController@createGroup");
Route::get("/group/{id}", "GroupController@group")->name("group.name");
Route::post("/group/send-chat", "GroupController@sendChat");
Route::post("/group/{id}/add", "GroupController@addToGroup")->name("group.add");


// Profiles
Route::resource('profiles', 'ProfileController')->middleware('auth');
Route::get('/{user}', 'ProfileController@index')->name('profile.show');
Route::get('/{user}/{id}/edit', 'ProfileController@edit')->name('profile.edit')->middleware('auth');
Route::post('update/profile', ['as'=>'upload.image','uses'=>'ProfileController@updateProfile']);
Route::post('profile-edit', ['as'=>'profile-edit','uses'=>'ProfileController@editProfile']);
Route::get('{user}/profile-picture', ['as'=>'profile-image','uses'=>'ProfileController@profileImage']);
Route::post('image-cropper/upload','ProfileController@upload');









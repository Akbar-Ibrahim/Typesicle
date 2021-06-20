<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/post/{id}', 'PostUtilController@feed');
Route::get('/feeds/{id}', 'PostUtilController@getAllFeeds');
Route::get('/allposts/{id}', 'PostUtilController@getAllPosts');
Route::get('/allshorties/{id}', 'PostUtilController@getAllShorties');

Route::get('/home-feeds/', 'PostUtilController@getHomeFeeds');
Route::get('/home-posts/', 'PostUtilController@getHomePosts');
Route::get('/home-shorties/', 'PostUtilController@getHomeShorties');


Route::get('/user-likes', 'PostUtilController@getUserLikes');


Route::get('/most-viewed', 'PostUtilController@mostViewed');

Route::get('/popular-posts/user/{id}', 'PostUtilController@popularPosts');
Route::get('/recent-posts/user/{id}', 'PostUtilController@RecentPosts');
Route::get('/recent-shorties/user/{id}', 'ShortieController@RecentShorties');
Route::get('/shortie-comments/{id}', 'ShortieController@shortieComments');

// Accounts
Route::get('/accounts/user/{id}', 'AccountController@accountsToFollow');
Route::get('/followers-{id}', 'AccountController@followers');
Route::get('/photos/user/{id}', 'PhotoController@getPhotos');
Route::get('/user/{id}', 'AccountController@getProfile');
Route::get('/top-authors/{username}', 'AccountController@getMostPopularAuthors');

Route::get('/random-post', 'PostUtilController@getRandomPost');
Route::get('/random-post/user/{id}', 'PostUtilController@getUserRandomPost');
Route::get('/random-post/user/{user_id}/post/{post_id}', 'PostUtilController@getUserRandomPostExcept');

//Quiz
Route::get('quiz/play-status', 'QuizUtilController@playStatus');

//Category
Route::get('/user-categories', 'CategoryUtilController@getMyCategories');
Route::post('/category-create', 'CategoryUtilController@createCategory');
// Route::get('/{username}/categories', 'CategoryUtilController@getUserCategories');
Route::get('/top/categories', 'CategoryUtilController@getTopCategories');

//Follow
Route::get('profile-follow', 'FollowController@followProfile')->name('follow:profile')->middleware('auth');
Route::get('count-followers', 'FollowController@countFollowers')->name('count:followers')->middleware('auth');
Route::get('count-followings', 'FollowController@countFollowings')->name('count:followings')->middleware('auth');
Route::get('following/{user}', 'FollowController@handleFollowing')->name('following')->middleware('auth');
Route::get('followers/{user}', 'FollowController@handleFollowers')->name('followers')->middleware('auth');


// Hashtags
Route::get('/top/hashtags', 'PostUtilController@getTopHashtags');



// Like Posts
Route::get('/post-like', 'LikeController@like')->name('like:post');



// Route::get('/shortie', 'ShortPostController@showShortie');
Route::get('/shortie', 'ShortieController@getShortie');
Route::get('/shortie/photos/{shortie_id}', 'ShortieController@getShortiePhotos');


// Search
Route::get('/search-author-list', 'SearchController@searchAuthorList')->name('search.author-list');
Route::get('/search-post-list', 'SearchController@searchPostList')->name('search.post-list');


// Get shortie feeds
Route::get('/shortie/feeds/{id}', 'ShortieController@getShortieFeed');



Route::get('/comments/post/{id}', 'CommentController@getAllComments');
Route::get('/comments/user/{id}', 'CommentController@getAllUserComments');
Route::get('/replies/comment/{id}', 'CommentController@getAllReplies');
Route::get('/replies/comment/more/{id}/{count}/{user_id}', 'CommentController@getMoreReplies');

Route::post('post-comment', 'CommentController@handlePostComment')->name('post.comment');
Route::post('comment-reply', 'CommentController@handleCommentReply')->name('comment.reply');



Route::post('/add/queue', 'QueueController@saveToQueue');
Route::get('/all-queues/{user}', 'QueueController@getQueues');
Route::post('/queue/delete', 'QueueController@deleteFromQueue');




//drafts 

// Route::get('/draft/{id}', 'DraftsController@getSingleDraft');

Route::get('/feed-likes/{id}', 'LikeController@getLikes');
Route::get('/feed-shares/{id}', 'RepostController@getShares');

//Reposts
Route::get('/post-repost/{id}', 'RepostController@getPostReposts')->name('reposts');
Route::get('/repost-delete', 'RepostController@repostDelete')->name('repost-delete');
Route::post('/post-repost', 'RepostController@handleRepost')->name('post.repost');


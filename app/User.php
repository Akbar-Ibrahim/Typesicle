<?php

namespace App;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'google_id', 'password', 'query_status'
    ];

    protected $appends = [
        'profile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot(){
        parent::boot();

        static::created(function ($user) {
            $user->profile()->create([
                "bio" => "",
                "picture" => "avatar.png",
                "facebook" => "",
                "instagram" => "",
                "twitter" => ""
            ]);
        });
    }

    public function addNew($input)
    {
        $check = static::where('google_id',$input['google_id'])->first();

        if(is_null($check)){
            return static::create($input);
        }

        return $check;

    }

    public function setUsernameAttribute($value)
    {
        return $this->attributes['username'] = "@" . $value;
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function groups()
    {
        return $this->hasMany(Group::class)->orderBy('created_at', 'DESC');
    }

    public function groupMember()
    {
        return $this->hasMany(GroupMember::class)->orderBy('created_at', 'DESC');
    }

    public function gm()
    {
        return $this->hasOne(GroupMember::class)->orderBy('created_at', 'DESC');
    }


    public function shorties()
    {
        return $this->hasMany(Shortie::class)->orderBy('created_at', 'DESC');
    }

    public function isLikedShortie($shortie_id)
    {
        return $this->likes()->where(['shortie_id' => $shortie_id, 'user_id' => $this->id])->first();
    }

    public function isSharedShortie($shortie_id)
    {
        return $this->reposts()->where(['shortie_id' => $shortie_id, 'user_id' => $this->id])->first();
    }

    public function photos()
    {
        return $this->hasMany(Photo::class)->orderBy('created_at', 'DESC');

    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function follows()
    {
        return $this->hasMany('App\Follow');
    }

    public function isFollowing($profile_id)
    {
        return $this->follows()->where(['profile_id' => $profile_id, 'user_id' => $this->id])->first();
    }
    
     public function profile()
     {
         return $this->hasOne('App\Profile');

     }

     public function getProfileAttribute()
     {
         return Profile::where(["id" => $this->id])->first();

     }

     public function comments(){
         return $this->hasMany('App\Comment');
     }
     
     public function replies(){
        return $this->hasMany('App\CommentReply');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function isLiked($post_id)
    {
        // return $this->likes()->where(['feed_id' => $feed_id, 'post_id' => $post_id, 'user_id' => $this->id])->first();
        return $this->likes()->where(['post_id' => $post_id, 'user_id' => $this->id])->first();
    }

    public function getGroups()
    {
        return GroupMember::where(['user_id' => $this->id])->with('group')->get();
    }

    public function quizAnswers()
    {
        return $this->hasMany('App\QuizAnswer', 'player');
    }

    
    public function hasAnswered($questionaire_id)
    {
        return $this->quizAnswers()->where(['questionaire_id' => $questionaire_id, 'player' => $this->id])->first();
    }

    public function reposts()
    {
        return $this->hasMany('App\Repost');
    }

    public function isReposted($post_id)
    {
        // return $this->reposts()->where(['feed_id' => $feed_id, 'post_id' => $post_id, 'user_id' => $this->id])->first();
        return $this->reposts()->where(['post_id' => $post_id, 'user_id' => $this->id])->first();
    }

    public function queues()
    {
        return $this->hasMany('App\Queue')->with('feed.post.user.profile', 'feed.post.photo');
    }

    public function isQueued($feed_id)
    {
        return $this->queues()->where(['feed_id' => $feed_id, 'user_id' => $this->id])->first();
    }

    public function history()
    {
        return $this->hasMany('App\History')->with('feed.user', 'feed.shortie', 'feed.post.photo')->orderBy('created_at', 'desc');
    }

    public function hasRead($feed_id)
    {
        return $this->history()->where(['feed_id' => $feed_id, 'user_id' => $this->id])->first();
        
    }

    public function accountsToFollow($id)
    {
        return User::where(['id'=>  $id])->first();
    }

    public function scopePostGreaterTen($query){

        return ($query)->whereHas('posts', function($query){
            return $query-> select(DB::raw('count(*) as num_post,user_id') )->groupby('user_id')
            ->havingRaw( DB::raw( 'num_post >= 2'));
        });
        
       
    }

    public function feeds()
    {
        return $this->hasMany('App\Feed')->orderBy('created_at', 'desc');

    }

    public function quizzes()
    {   
        return $this->hasMany("App\Quiz");
    }

    public function quizAnalytics()
    {
        
        return $this->hasMany(QuizAnalytics::class);

    }

    public function drafts()
    {
        return $this->hasMany(Draft::class)->orderBy('created_at', 'DESC');

    }

    public function thread()
    {
        return $this->hasMany(Thread::class)->orderBy('created_at', 'DESC');
    }

    public function polls()
    {

        return $this->hasMany(Poll::class)->orderBy('created_at', 'DESC');

    }

    public function Votes()
    {
        return $this->hasMany('App\Vote');
    }

    public function hasVoted($poll_id)
    {
        return $this->Votes()->where(['poll_id' => $poll_id, 'user_id' => $this->id])->first();
    }


    public function belongsToGroup($id) {
        return $this->groupMember()->where(['group_id' => $id, 'user_id' => $this->id])->first();
            
    }

    public function stupid() {
        return "";
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class)->orderBy('created_at', 'DESC');
    }

    public function myNotifications(){
        return $this->notifications()->where(['user_id' => $this->id])->get();
    }

    
}

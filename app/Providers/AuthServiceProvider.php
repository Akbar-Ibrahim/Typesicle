<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

   

        /* define a admin user role */

        Gate::define('isAdmin', function($user) {
           return $user->role == 'admin';
        });

    
        /* define a manager user role */

        Gate::define('isManager', function($user) {
            return $user->role == 'manager';
        });

    
        /* define a user role */

        Gate::define('isUser', function($user) {
            return $user->role == 'user';
        });

        Gate::define('update-post', function ($user, $post) {
            return $user->id == $post->user_id;
        });

        // Queue
        Gate::define('can-queue', function ($user, $post) {
            return $user->id !== $post->user_id;
        });

        // Quiz
        Gate::define('canPlayQuiz', function ($user, $quiz) {
            return $user->id !== $quiz->user_id;
        });

        Gate::define('update-draft', function ($user, $draft) {
            return $user->id == $draft->user_id;
        });

        Gate::define('edit-profile', function ($user, $profile) {
            return $user->id == $profile->user_id;
        });
    }
}

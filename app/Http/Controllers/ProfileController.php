<?php

namespace App\Http\Controllers;

use App\Feed;
use App\Like;
use App\Notification;
use App\Photo;
use App\Profile;
use App\Services\AccountService;
use App\Services\PhotoService;
use App\Services\PostUtilService;
use App\User;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    //

    public function index($username, PostUtilService $postUtilService, PhotoService $photoService, AccountService $accountService)
    {

        $user = $postUtilService->getUser($username);
        $users = User::where('id', '!=', $user->id)->with('profile')->first();
        $photos = $photoService->getPhotos($user);
        $feeds = $postUtilService->getAllFeeds($user);
        $photos = Photo::where(['user_id' => $user->id])->with("user")->orderBy('created_at', 'desc')->limit(9)->get();
        $recentPosts = $postUtilService->recentPosts($user->id);
        $accounts = $accountService->accountsToFollow($user->id);
        // $userRandomPost = $postUtilService->getUserRandomPost($user->id);

        
        

        $addToGroup = [];
        if (auth()->user()) {
            foreach ($feeds as $feed) {
                if ($feed->post) {
                if (auth()->user()->isLiked($feed->post_id)) {
                    $feed->post->is_liked = 1;
                } else {
                    $feed->post->is_liked = 0;
                }

                if (auth()->user()->isReposted($feed->post_id)) {
                    $feed->post->is_shared = 1;
                } else {
                    $feed->post->is_shared = 0;
                }

                if (auth()->user()->isQueued($feed->post_id)) {
                    $feed->post->is_queued = 1;
                } else {
                    $feed->post->is_queued = 0;
                }


                array_push($addToGroup, $feed);
            } else if ($feed->shortie) {
                if (auth()->user()->isLikedShortie($feed->shortie_id)) {
                    $feed->shortie->is_liked = 1;
                } else {
                    $feed->shortie->is_liked = 0;
                }

                if (auth()->user()->isSharedShortie($feed->shortie_id)) {
                    $feed->shortie->is_shared = 1;
                } else {
                    $feed->shortie->is_shared = 0;
                }

                array_push($addToGroup, $feed);
            }
            }
        }

        if(auth()->user()) {
            $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();
            return view('profiles.index', compact('feeds', 'user', 'photos', 'recentPosts', 'accounts', 'addToGroup', 'n'));
        } else {
            return view('profiles.index', compact('feeds', 'user', 'photos', 'recentPosts', 'accounts', 'addToGroup'));
        }

        
    }

    public function edit($username, $id, PostUtilService $postUtilService)
    {
        $profile = Profile::findOrFail($id);
        if (! Gate::allows('edit-profile', $profile)) {
            abort(403);
        }

        // $this->authorize('update', $user->profile);
        $profile = Profile::findOrFail($id);
        $user = $postUtilService->getUser($username);
        $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();
        
        return view('profiles.edit', compact('user', 'n'));
    }

    public function profileImage($username, PostUtilService $postUtilService)
    {

        $user = $postUtilService->getUser($username);

        return view("profiles.image", compact('user'));
    }

    public function updateProfile(Request $request)

    {

        $user = auth()->user();
        $profile = Profile::where("id", $user->id)->first();

        if ($request->hasFile('profile_picture')) {
            if ($picture = $request->file('profile_picture')) {
                if ($profile->picture !== 'avatar.png') {
                    unlink(public_path() . "/images/" . $user->id . '/profile_pic/' . $profile->picture);
                }
                $username = str_replace("@", "", $user->username);
                $name = $username . ".png";
                $picture->move('images/' . $user->id . '/profile_pic/', $name);
                Profile::where(["user_id" => $user->id])->update(["picture" => $name]);

                return redirect("/" . $user->username . "/" . $user->id . "/edit");
            }
        }



        if ($request->filled('image')) {
            $image = $request->image;

            list($type, $image) = explode(';', $image);

            list(, $image)      = explode(',', $image);

            $image = base64_decode($image);

            $username = str_replace("@", "", $user->username);
            $image_name = $username . '.png';


            $profile = Profile::where(["user_id" => $user->id])->first();

            // if ($profile->picture !== 'avatar.png') {
            //     unlink(public_path() . "/images/" . $user->id . '/profile_pic/' . $profile->picture);
            // }
            // Storage::disk("public")->put($user->id . '/profile_pic/' . $image_name, $image);
            // Profile::where(["user_id" => $user->id])->update(["picture" => $image_name]);

            return response()->json(['status' => true]);
        }
    }

    public function editProfile(Request $request)
    {

        $user_id = $request->user_id;
        $user = User::where("id", $user_id)->first();
        $profile = Profile::where("id", $user_id)->first();

        // $profile = Profile::findOrFail($id);
        if (! Gate::allows('edit-profile', $profile)) {
            abort(403);
        }

        $user = auth()->user();
        $profile = Profile::where("id", $user->id)->first();

        if ($request->hasFile('image')) {
            if ($picture = $request->file('image')) {
                if ($profile->picture !== 'avatar.png') {
                    unlink(public_path() . "/images/" . $user->id . '/profile_pic/' . $profile->picture);
                }
                $username = str_replace("@", "", $user->username);
                $name = $username . ".png";
                $picture->move('images/' . $user->id . '/profile_pic/', $name);
                // Profile::where(["user_id" => $user->id])->update(["picture" => $name]);


$img = Image::make('images/' . $user->id . '/profile_pic/'. $name);
$img->resize(150, 150);
$img->save('images/' . $user->id . '/profile_pic/user.png');
$filename = "user.png";


                Profile::where(["user_id" => $user->id])->update(["picture" => $filename]);
            // $cover_image = Image::make($cover_image)->resize(250, 150);
            // $cover_image->save('images/' . auth()->user()->id . '/' . $image_name, 80, 'png');

            }
        }




        if ($request->filled('name')) {
            $user->update(["name" => $request->name]);
        }

        if ($request->filled('bio')) {
            $profile->update(["bio" => $request->bio]);
        }


        return redirect("/" . $user->username);
    }

    public function upload(Request $request)

    {

        $folderPath = public_path('upload/');
        $image_parts = explode(";base64,", $request->image);

        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $file = $folderPath . uniqid() . '.png';

        file_put_contents($file, $image_base64);

        return response()->json(['success' => 'success']);
    }
}

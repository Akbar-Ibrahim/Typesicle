<?php
namespace App\Services;

use App\Feed;
use App\User;
use App\ShortiePhoto;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;

class ShortieService{
    
    
      public function thread(){
        
        $feed_id = request()->feed_id;
        $shortie_id = request()->shortie_id;
        if ($feed_id && $shortie_id) {
        return Feed::where(['id' => $feed_id, 'shortie_id' => $shortie_id])->with('user', '.shortiePhoto.photo')->first();
        } else {
          $feed_id = 0;
        $shortie_id = 0;
        return Feed::where(['id' => $feed_id, 'shortie_id' => $shortie_id])->with('user', 'shortiePhoto.photo')->first();
        }
    }

    public function shortie(){
        
      $feed_id = request()->feed_id;
      $shortie_id = request()->shortie_id;
      
      return Feed::where(['id' => $feed_id, 'shortie_id' => $shortie_id])->with('user', 'shortie.shortiePhoto.photo.user')->first();
  }

  public function recentShorties($id) {
    return Feed::where(['user_id' => $id, 'status' => 'Shortie'])->with('user.profile.photo', 'shortie.user', 'shortie.shortiePhoto.photo')->orderBy('created_at', 'desc')->limit(5)->get();
  }

  public function getShortiePhotos($shortie_id) {
    return ShortiePhoto::where(['shortie_id' => $shortie_id])->with('photo')->get();
  }
}

?>
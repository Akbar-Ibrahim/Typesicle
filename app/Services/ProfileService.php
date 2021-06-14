<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Block;



class ProfileService
{
    public function handleProfileBlock(){

        $profile_id = request()->profileId;
        $user = auth()->user();
        $status = request()->status;
        
        if($status == 1){
            $block = Block::create(['profile_id' => $profile_id, 'user_id' => $user->id, 'status' => $status]);


        }else{
            Block::where(['profile_id' => $profile_id, 'user_id' => $user->id])->delete();
            
        }

        
    }


}

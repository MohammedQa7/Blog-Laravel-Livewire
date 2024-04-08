<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class LikeBtn extends Component
{
    #[Reactive]
    public Post $post_id;

    public function LikePost()
    {   
        if(Auth::user()){
            $user = Auth::user();
            // make sure that the user has not liked the post / we will check in the post_like table

            if ($user->hasLiked($this->post_id->id)) {
                $user->likes()->detach($this->post_id->id);
            }else{
                 $user->likes()->attach($this->post_id->id);
            }
        }else{
            return $this->redirect(URL('/login') , true);
        }
    }


    public function render()
    {
        return view('livewire.like-btn');
    }
}

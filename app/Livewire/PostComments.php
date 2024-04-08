<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class PostComments extends Component
{
    use WithPagination;
    public Post $post;

    #[Rule('required|string|max:400')]
    public string $comment;

    // GETTING ALL COMMENTS IN A THE PROVIDED POST 
    #[Computed()]
    public function getComments()
    {
        // return the post with the comments inside of it
        return Comment::where('post_id' , $this->post->id)->with('user')->paginate(5);
        // OR---
        // return $this->post->comment()->paginate(5);


    }

    public function appendComment()
    {
        $this->validateOnly('comment');
        
        if (Auth::user()) {
            $this->post->comment()->create([
                'user_id' => Auth::user()->id,
                'post_id' => $this->post->id, // this is optional to add because the comment() relationship will automaticly grap the post id and put it in the table
                'comment_content' => $this->comment
            ]);
        } 
        

    }

    public function render()
    {
        return view('livewire.post-comments');
    }
}

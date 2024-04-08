<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostLists extends Component
{
    use WithPagination;

    #[Url]
    public $sort_by = 'DESC';

    #[Url]
    public $search = '';

    #[Url]
    public $spicefic_Category = '';
    

    public $PostWithLikes = [];


    
    public function Sorting($sort)
    {
        // sleep(1);
        if ($sort === 'ASC' || $sort === 'DESC') {
            $this->sort_by = $sort;
        }
    }

    #[On('searching')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
    }


    #[Computed]
    public function Posts()
    {
        return Post::with(['user', 'categories'])
            ->Search($this->search)
            ->orWhereHas('user', function ($query) {
                return $query->where('name', 'like', "%{$this->search}%");
            })
            ->when($this->GetActiveCategory(), function($query){
                $query->ByCategory($this->spicefic_Category);
            })
            ->Published()
            ->orderBy('published_at', $this->sort_by)
            ->paginate(5);
    }

    // i made this function to cache the selected category so i can access the category data whenever i want to
    #[Computed]
    public function GetActiveCategory()
    {
        if($this->spicefic_Category === '' || $this->spicefic_Category === null){
            return;
        }else{
            return Category::where('slug' , $this->spicefic_Category)->first();
        }
    }

    #[On('whoLiked')]
    #[Computed]
    public function GetWhoLikedPost($post)
    {   
            $post =  Post::with('likes')->find($post);
            $this->PostWithLikes = $post->likes;
            $this->dispatch('open-modal' , name: 'PostWithLikes');
    }

    public function clearCategoryFilter()
    {
        $this->spicefic_Category= '';
        $this->resetPage();
    }

    
    public function render()
    {
         return view('livewire.post-lists');
    }
}

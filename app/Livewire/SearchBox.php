<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;

class SearchBox extends Component
{
    #[Url]
    public $search;

    public function updatedSearch()
    {
        $this->dispatch('searching' , search: $this->search);
    }

    public function render()
    {
        return view('livewire.search-box');
    }
}

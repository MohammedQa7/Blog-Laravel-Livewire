<div>

    {{-- Showing Modal to View users that have liked the post --}}


    <div class=" px-3 lg:px-7 py-6">
        <div class="flex justify-between items-center border-b border-gray-100">
            <div id="filter-selector" class="flex items-center space-x-4 font-light ">
                <button wire:click="Sorting('DESC')"
                    class=" py-4 {{ $this->sort_by === 'DESC' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }}  ">{{ __('Blogpage.Latest') }}</button>
                <button wire:click="Sorting('ASC')"
                    class=" py-4 {{ $this->sort_by === 'ASC' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} ">{{ __('Blogpage.Oldest') }}</button>
            </div>

        </div>

        <div class="py-4">
            <div class="selected_category flex gap-2">
                @if ($this->GetActiveCategory())
                    <button wire:click=clearCategoryFilter()> X </button>
                    <x-cTabs.cbadge wire:navigate
                        href="{{ URL('blogs?' . Arr::query(['spicefic_Category' => $this->GetActiveCategory->title])) }}"
                        TextColor="{{ $this->GetActiveCategory->text_color ?? 'white' }}"
                        BgColor="{{ $this->GetActiveCategory->bg_color ?? 'grey' }}">
                        {{ $this->GetActiveCategory->title }}
                    </x-cTabs.cbadge>
                @endif
            </div>
            @foreach ($this->posts as $post)
                <article wire:key="{{ $post->id . now() }}" class="[&:not(:last-child)]:border-b border-gray-100 pb-10">
                    <div class="article-body grid grid-cols-12 gap-3 mt-5 items-start">
                        <div class="article-thumbnail col-span-4 flex items-center">
                            <a href={{ URL('blogs/p/' . $post->slug) }}>
                                <img class="mw-100 mx-auto rounded-xl" src="{{ $post->getThumbnailImage() }}"
                                    alt="thumbnail">
                            </a>
                        </div>
                        <div class="col-span-8">
                            <div class="article-meta flex py-1 text-sm items-center">
                                <img class="w-7 h-7 rounded-full mr-3" src="{{ $post->user->profile_photo_url }}"
                                    alt="avatar">
                                <span class="mr-1 text-xs">{{ $post->user->name }}</span>
                                <span class="text-gray-500 text-xs">. {{ $post->published_at->diffForHumans() }}</span>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">
                                <a href="{{ URL('blogs/p/' . $post->slug) }}">
                                    {{ $post->title }}
                                </a>
                            </h2>

                            <p class="mt-2 text-base text-gray-700 font-light">
                                {{ $post->getExcerpt() }}
                            </p>
                            <div class="article-actions-bar mt-6 flex items-center justify-between">
                                <div class="flex gap-3">
                                    @foreach ($post->categories as $category)
                                        <x-cTabs.cbadge wire:navigate
                                            href="{{ URL('blogs?' . Arr::query(['spicefic_Category' => $category->title])) }}"
                                            TextColor="{{ $category->text_color ?? 'white' }}"
                                            BgColor="{{ $category->bg_color ?? 'grey' }}">
                                            {{ $category->title }}
                                        </x-cTabs.cbadge>
                                    @endforeach
                                    <div class="flex items-center space-x-4">
                                        <span class="text-gray-500 text-sm">5 min read</span>
                                    </div>
                                </div>

                                <div>
                                    @livewire('LikeBtn', ['post_id' => $post], key($post->id . now()))
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach

               @if(sizeof($this->PostWithLikes) == 0)
                <x-modals.user-likes-modal name="PostWithLikes" Title="Liked By">
                    @slot('body')
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    <h1 style="font-weight: bold; color:white;">No One Liked This Post Yet</h1>
                    
                    @endslot
                </x-modals.user-likes-modal>
              @else
              <x-modals.user-likes-modal name="PostWithLikes" Title="Liked By">
                @slot('body')
                    @foreach ($this->PostWithLikes as $liked_per_user)
                        <h1 style="color: white">{{ $liked_per_user->name }}</h1>
                    @endforeach
                @endslot
              </x-modals.user-likes-modal>
               @endif

                    
            {{ $this->posts->onEachSide(1)->links() }}
        </div>

        {{-- edn --}}
    </div>
</div>

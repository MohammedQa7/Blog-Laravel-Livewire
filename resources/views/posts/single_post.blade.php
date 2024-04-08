<x-app-layout title="{{$single_post->title}}">

    <main class="container mx-auto px-5 flex flex-grow">
        <article class="col-span-4 md:col-span-3 mt-10 mx-auto py-5 w-full" style="max-width:700px">
            <img class="w-full my-2 rounded-lg" src="{{$single_post->getThumbnailImage()}}" alt="">
            <h1 class="text-4xl font-bold text-left text-gray-800">
                {{$single_post->title}}
            </h1>
            <div class="mt-2 flex justify-between items-center">
                <div class="flex py-5 text-base items-center">
                    <img class="w-10 h-10 rounded-full mr-3" src="{{$single_post->user->profile_photo_url}}" alt="avatar">
                    <span class="mr-1">{{$single_post->user->name}}</span>
                    <span class="text-gray-500 text-sm">| 3 min read</span>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-500 mr-2">{{$single_post->published_at->diffForHumans()}}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.3"
                        stroke="currentColor" class="w-5 h-5 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <div class="article-actions-bar my-6 flex text-sm items-center justify-between border-t border-b border-gray-100 py-4 px-2">
                @livewire('LikeBtn' , ['post_id' => $single_post] ,key($single_post->id.now()))
            </div>

            <div class="article-content py-3 text-gray-800 text-lg text-justify">
                {!! $single_post->content !!}
            </div>

            <div class="flex items-center space-x-4 mt-10">
                @foreach ($single_post->categories as $category)
                    <x-cTabs.cbadge wire:navigate
                        href="{{ URL('blogs?' . Arr::query(['spicefic_Category' => $category->title])) }}"
                        TextColor="{{ $category->text_color ?? 'white' }}"
                        BgColor="{{ $category->bg_color ?? 'grey' }}">
                        {{ $category->title }}
                    </x-cTabs.cbadge>
                @endforeach
            </div>

            {{-- Comment Section --}}

            <div class="comment-section mt-5">
                @livewire('PostComments' , ['post' => $single_post] , key($single_post->id.now()))
            </div>

        </article>
    </main>

</x-app-layout>

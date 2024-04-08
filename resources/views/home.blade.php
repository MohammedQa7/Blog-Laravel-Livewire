<x-app-layout title="Home Page">

    <body class="font-light antialiased">
        @section('heading')
            <div class="w-full text-center py-32">
                <h1 class="text-2xl md:text-3xl font-bold text-center lg:text-5xl text-gray-700">
                    Welcome to <span class="text-yellow-500">&lt;BLOG&gt;</span> <span class="text-gray-900"> News</span>
                </h1>
                <p class="text-gray-500 text-lg mt-1">{{__('Homepage.heading.Best Blog in the universe')}}</p>
                <a class="px-3 py-2 text-lg text-white bg-gray-800 rounded mt-5 inline-block"
                    href="{{URL('blogs')}}">Start
                    Reading</a>
            </div>
        @endsection

        <div class="mb-10">
            <div class="mb-16">
                <h2 class="mt-16 mb-5 text-3xl text-yellow-500 font-bold">{{__('Homepage.Featured Posts')}}</h2>
                <div class="w-full">
                    {{-- Blog Posts --}}
                    <div class="grid grid-cols-3 gap-10 w-full">
                        @foreach ($featured_posts as $post)
                            <div class="#">
                                <a href="{{URL('blogs/p/' . $post->slug)}}">
                                    <div>
                                        <img class="w-full rounded-xl" src="{{ $post->getThumbnailImage() }}">
                                    </div>
                                </a>
                                <div class="mt-3">
                                    <div class="flex items-center mb-2 gap-2">
                                        @if ($category = $post->categories()->first())
                                            <x-cTabs.cbadge wire:navigate
                                                href="{{ URL('blogs?' . Arr::query(['spicefic_Category' => $category->title])) }}"
                                                TextColor="{{ $category->text_color ?? 'white' }}"
                                                BgColor="{{ $category->bg_color ?? 'grey' }}">
                                                {{ $category->title }}
                                            </x-cTabs.cbadge>
                                        @endif
                                        <p class="text-gray-500 text-sm">{{ $post->published_at }}</p>
                                    </div>
                                    <a href="{{URL('blogs/p/' . $post->slug)}}" class="text-xl font-bold text-gray-900">{{ $post->title }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <a class="mt-10 block text-center text-lg text-yellow-500 font-semibold"
                    href="http://127.0.0.1:8000/blog">{{__('Homepage.More Posts')}}</a>
            </div>
            <hr>

            <h2 class="mt-16 mb-5 text-3xl text-yellow-500 font-bold">{{__('Homepage.Latest Posts')}}</h2>
            <div class="w-full mb-5">
                <div class="grid grid-cols-3 gap-10 gap-y-32 w-full">
                    @foreach ($latest_posts as $latest_post)
                        <div class="md:col-span-1 col-span-3">
                            <a href="{{URL('blogs/p/' . $latest_post->slug)}}">
                                <div>
                                    <img class="w-full rounded-xl" src="{{ $latest_post->getThumbnailImage() }}">
                                </div>
                            </a>
                            <div class="mt-3"><a href="http://127.0.0.1:8000/blog/laravel-34">
                                </a>
                                <div class="flex items-center mb-2"><a href="{{URL('blogs/p/' . $latest_post->slug)}}">
                                    </a><a href="http://127.0.0.1:8000/categories/laravel"
                                        class="bg-red-600 
                                    text-white 
                                    rounded-xl px-3 py-1 text-sm mr-3">
                                        Laravel</a>
                                    <p class="text-gray-500 text-sm">{{ $latest_post->published_at }}</p>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">{{ $latest_post->title }}</h3>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
            <a class="mt-10 block text-center text-lg text-yellow-500 font-semibold"
                href="http://127.0.0.1:8000/blog">{{__('Homepage.More Posts')}}</a>
        </div>

    </body>

</x-app-layout>

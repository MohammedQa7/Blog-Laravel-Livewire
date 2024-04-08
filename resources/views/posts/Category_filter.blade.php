<div id="recommended-topics-box">
    <h3 class="text-lg font-semibold text-gray-900 mb-3">{{__('Blogpage.Recommended Topics')}}</h3>
    <div class="topics flex flex-wrap justify-start gap-2">
        @foreach ($categories as $category)
            <x-cTabs.cbadge wire:navigate  href="{{URL('blogs?'.Arr::query(['spicefic_Category' => $category->title]))}}"
            TextColor="{{$category->text_color ?? 'white'}}" BgColor="{{$category->bg_color ?? 'grey'}}">
                {{$category->title}}
            </x-cTabs.cbadge>
        @endforeach
    </div>
</div>

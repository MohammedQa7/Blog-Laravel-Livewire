<div>
    @props(['TextColor' , 'BgColor'])

    <button {{$attributes}} class="rounded-xl px-3 py-1 text-base" style="color:{{$TextColor}}; background-color:{{$BgColor}};">
    {{ $slot }}
    </button>
</div>

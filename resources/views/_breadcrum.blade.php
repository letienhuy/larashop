@if(isset($links))
    <ul class="breadcrum">
        <li>
            <a href="{{route('home')}}">@lang('main.home')</a>
        </li>
        @foreach($links as $key => $val)
        <li>
            @if(!$loop->last)
            <a href="{{$val}}">{{$key}}</a>
            @else {{$key}} @endif
        </li>
        @endforeach
    </ul>
@endif
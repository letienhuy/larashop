@foreach ($image as $item)
    <div class="image">
        <img src="{{$item}}" alt="">
        <span class="delete">&times;</span>
    </div>
@endforeach
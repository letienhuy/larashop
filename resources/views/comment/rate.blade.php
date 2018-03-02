@foreach($rates as $rate)
    <div class="product-tab-rate__content">
        <div class="product-tab-rate__content-user">
            <img src="{{$rate->user->avatar ?? $rate->product->defaultImage()}}">
            <span class="product-tab-rate__content-user__username">{{$rate->user->fullname}}:</span>
            <span class="product-tab-rate__content-user__star">
                @for($i = 1; $i <= 5; $i++)
                    @if($i > $rate->star)
                        <span class="star0"></span>
                    @else
                    <span class="star1"></span>
                    @endif
                @endfor
            </span>
        </div>
        <div class="product-tab-rate__content-rate__comment">{{$rate->comment}}</div>
        <div class="product-tab-rate__content-rate__date">{{date('H:i d/m/Y', strtotime($rate->updated_at))}}</div>
    </div>
@endforeach
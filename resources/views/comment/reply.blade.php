@if(count($replyComment) > 0)
@foreach($replyComment as $rc)
<div class="product-tab-comment__content-reply__list">
    <div class="product-tab-comment__content-user">
        <img src="{{$rc->user->avatar ?? $rc->product->defaultImage()}}">
        <span class="product-tab-comment__content-user__username">{{$rc->user->fullname}}:</span>
    </div>
    <div class="product-tab-comment__content-comment__comment"><span>{{$rc->comment}}</span>
    @auth
        @if(Auth::id() === $rc->user->id)
            <span class="reply">
                <a id="edit" onclick="editComment({{$rc->id}})">Sửa</a> | <a onclick="removeComment({{$rc->id}})">Xóa</a>
            </span>
        @endif
    @endauth
    </div>
    <div class="product-tab-comment__content-comment__date">{{date('H:i d/m/Y', strtotime($rc->updated_at))}}</div>
</div>
@endforeach
@endif
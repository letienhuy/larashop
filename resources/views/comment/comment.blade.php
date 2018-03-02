 @foreach($comment as $c)
<div class="product-tab-comment__content">
    <div class="product-tab-comment__content-user">
        <img src="{{$c->user->avatar ?? $c->product->defaultImage()}}">
        <span class="product-tab-comment__content-user__username">{{$c->user->fullname}}:</span>
    </div>
    <div class="product-tab-comment__content-comment__comment">
        <span>{{$c->comment}}</span>
        <span class="reply">
            <a id="comment-{{$c->id}}" onclick="openReply(this.id)">Trả lời ({{count($c->reply_comment)}})</a>
            @auth
                @if(Auth::id() === $c->user->id || Auth::user()->right === 1)
                    | <a id="edit" onclick="editComment({{$c->id}})">Sửa</a> | <a onclick="removeComment({{$c->id}})">Xóa</a>
                @endif
            @endauth
        </span>
    </div>
    <div id="reply-{{$c->id}}" class="product-tab-comment__content-reply">
        <div id="reply-comment-{{$c->id}}"></div>
        @if(count($c->reply_comment) > 5)
        <div id="load-more-reply-{{$c->id}}" data-total="{{count($c->reply_comment)-5}}"><button>Xem thêm {{count($c->reply_comment)-5}} trả lời...</button></div>
        @endif
        @auth
        <form id="form-reply-comment-{{$c->id}}" data-id="{{$c->product->id}}">
            {{ csrf_field() }}
            <textarea name="comment"></textarea>
            <span class="validation"></span>
            <input class="btn-green" type="submit" value="Trả lời">
        </form>
        @endauth
    </div>
    <div class="product-tab-comment__content-comment__date">{{date('H:i d/m/Y', strtotime($c->updated_at))}}</div>
</div>
@endforeach
@extends('admin.master', ['title' => 'Quản lí sản phẩm'])
@section('content')
    <div class="container">
    <h1 class="title">
    <span>QUẢN LÍ SẢN PHẨM</span>
    </h1>
        <div class="row desc">
                <select id="sort-category">
                    <option value="">Chọn theo chuyên mục</option>
                    @foreach (App\Category::all() as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            @if(count($product) != 0)
            <table class="table table-striped">
            <form id="multi-select">
            {{csrf_field()}}
            </form>
            <tr><th></th>
                <th>Tên sản phẩm</th>
                <th class="hidden-xs">Mô tả</th>
                <th class="hidden-xs">Mô tả ngắn</th>
                <th class="hidden-xs">Danh mục</th>
                <th class="hidden-xs">Giá chưa KM</th>
                <th class="hidden-xs">KM</th>
                <th class="hidden-xs">Giá đã KM</th>
                <th>Action</th>
            </tr>
            @foreach($product as $p)
                <tr>
                    <td>
                        <input type="checkbox" name="product_id[]" value="{{$p->id}}">
                    </td>
                    <td><a href="{{route('product.detail', ['uri' => Helper::seo($p->name), 'id' => $p->id])}}">{{$p->name}}</a></td>
                    <td class="hidden-xs">{{$p->desc}}</td>
                    <td class="hidden-xs">{{$p->sort_desc}}</td>
                    <td class="hidden-xs">{{$p->category->name}}</td>
                    <td class="hidden-xs">{{$p->price}}đ</td>
                    <td class="hidden-xs">{{$p->sale}}%</td>
                    <td class="hidden-xs">{{$p->new_price}}đ</td>
                    <td width="100px">
                        <a href="{{route('admin.product', ['action' => 'edit', 'id' => $p->id])}}"><button class="btn-blue left">Sửa</button></a>
                        <button class="btn-red left" onclick="removeProduct({{$p->id}})">Xoá</button>
                    </td>
                </tr>
            @endforeach
            </table>
            <div id="count-item"></div>
            <center>{{$product->links()}}</center>
            @else
            <div class="desc">
                <center>Chưa có sản phẩm nào!</center>
            </div>
            @endif
            <div class="left">
                <a href="{{route('admin.product', ['action' => 'new'])}}"><button class="btn-green">Thêm mới</button></a>
                <button class="btn-red" id="multi-delete">Xoá nhiều</button>
                <button class="btn-green" id="multi-move">Di chuyển</button>
            </div>
        </div>
    </div>
@endsection
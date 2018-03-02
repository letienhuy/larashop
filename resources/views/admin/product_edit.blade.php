@extends('admin.master', ['title' => 'Sửa - '.$product->name]) @section('content')
<div class="container">
	<div class="row">
		<h1 class="title">
			<span>
                Sửa sản phẩm
			</span>
		</h1>
		<div class="col-md-8">
			<div class="form-group">
				<form class="form" method="post" action="{{route('admin.product', ['action' => 'new', 'id' => $product->id])}}">
                    @if ($errors->any())
                        @foreach ($errors->all() as $item)
                            <div class="alert alert-danger">{{$item}}</div>
                            @break
                        @endforeach
                    @endif
					{{csrf_field()}}
					<label for="name">Tên sản phẩm:</label>
					<input type="text" name="name" id="name" value="{{old('name') ?? $product->name}}">
					<label for="desc">Mô tả:</label>
					<textarea name="desc" id="desc">{{old('desc')  ?? $product->description}}</textarea>
					<label for="sort_desc">Mô tả ngắn:</label>
					<textarea id="sort_desc" name="sort_desc">{{old('sort_desc')  ?? $product->sort_desc}}</textarea>
					<label for="price">Giá:</label>
					<input type="text" name="price" id="price" value="{{old('price')  ?? $product->price}}">
					<label for="category">Danh mục:</label>
					<select name="catId" id="catId">
                        @foreach (App\Category::all() as $item)
                            <option value="{{$item->id}}" {{$item->id == $product->cat_id ? 'checked':''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                    <label for="sale">Khuyến mãi:</label>
                    <div class="input-group">
                        <input name="sale" value="{{old('sale') ?? $product->sale }}" id="sale"><label>%</label>
                    </div>
					<label for="keyword">Từ khoá (cách nhau bởi dấu , ):</label>
                    <input type="text" name="keyword" id="keyword" value="{{old('keyword'  ?? $product->keywords)}}">
                    <div class="input-group">
                        <label>Sản phẩm HOT: </label><input type="checkbox" name="top" id="top" {{$product->top ? 'checked':''}}>
                    </div>
                    <button class="btn-red">Lưu thông tin</button>
				</form>
			</div>
		</div>
		<div class="col-md-4">
			<h1 class="title"><span>Hình ảnh sản phẩm</span></h1>
            <div class="desc">
                <div id="product-image"></div>
            </div>
			<div class="form-group">
				<form class="form" id="add-image" enctype="multipart/form-data">
					{{csrf_field()}}
					<div class="input-group">
						<input type="file" name="image" id="image">
						<button><i class="fa fa-plus"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
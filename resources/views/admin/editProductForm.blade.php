@extends('layouts.admin')
<!-- เปลี่ยนแค่ sectionbody -->
@section('body')
<div class="table-responsive">
    <h2>Edit Product</h2>
    <form action="/admin/updateProduct/{{$products->id}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Product Name" value="{{$products->name}}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="{{$products->description}}">
        </div>
        
        <div class="form-group">
            <label for="type">Category</label>

            <select class="form-control" name="category">
                    @foreach($categories as $category)
                    <!-- Query check ทุกตัวว่า category id ตรงกับ product ไหม วนไปเรื่อยๆ เจอก็พิมพ์ selected -->
                    <option value="{{$category->id}}"
                    
                    @if($category->id == $products -> category_id)
                    selected
                    @endif

                    >{{$category->name}}</option>
                    @endforeach
            </select>

        </div>

          
        <div class="form-group">
            <label for="type">Price</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="{{$products->price}}">
        </div>
        <button type="submit" name="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
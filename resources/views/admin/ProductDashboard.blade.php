@extends('layouts.admin')
<!-- เปลี่ยนแค่ sectionbody -->
@section('body')


@if($products->count()>0)
<!-- ตาราง Category -->
<div class="table-responsive mt-2">
<h2>Product Dashboard</h2>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Category ID</th>
      <th scope="col">Price</th>
      <th scope="col">Edit Image</th>
      <th scope="col">Edit</th>
      <th scope="col">Remove</th>
    </tr>
  </thead>

  <tbody>
    @foreach($products as $product)
    <tr>
      <th scope="row">{{$product->id}}</th>
      <!-- ทำให้ link เข้ากับส่วนของ public/storage -->
      <td><img src="{{asset('storage')}}/product_image/{{$product->image}}" width="100px" height="100px"></td>
      <td>{{$product->name}}</td>
      <td>{{Str::limit($product->description,20, ' (...)')}}</td>
      
      <!-- เรียกใช้งานฟังก์ชัน category ใน Model Product -->
      <td>{{$product->category->name}}</td>
      
      <td>{{number_format($product->price)}}</td>
      <td><a href="/admin/editProductImage/{{$product->id}}" class="btn btn-success">Edit Image</a></td>
      <td><a href="/admin/editProduct/{{$product->id}}" class="btn btn-primary">Edit</td>
      <td><a href="/admin/deleteProduct/{{$product->id}}" onclick=" return confirm('คุณต้องการลบข้อมูลหรือไม่?')" class="btn btn-danger">Delete</td>
    </tr>
   @endforeach

   @else
        <div class="alert alert-danger mt-2">
        No data Available
        </div>
   @endif
  
  </tbody>

</table>

{{$products->links()}}

</div>


@endsection
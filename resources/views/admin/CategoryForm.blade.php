@extends('layouts.admin')
<!-- เปลี่ยนแค่ sectionbody -->
@section('body')
<!-- แจ้งเตือน Error -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="table-responsive">
    <h2>Create New Category</h2>
    <form action="/admin/createCategory" method="post" enctype="multipart/form-data">

        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Category Name">
        </div>
        

        <button type="submit" name="submit" class="btn btn-success">Submit</button>
    </form>
</div>

@if($categories->count()>0)
<!-- ตาราง Category -->
<div class="table-responsive mt-2">

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Category Name</th>
      <th scope="col">Amount</th>
      <th scope="col">Edit</th>
      <th scope="col">Remove</th>
    </tr>
  </thead>

  <tbody>
    
  
    @foreach($categories as $category)
    <tr>
      <th scope="row">{{$category->id}}</th>
      <td>{{$category->name}}</td>
      <!-- แต่ละ ID มีใน Product จำนวนเท่าไหร่ที่ ID ตรงกันแล้วนับ -->
      <td>{{$category->products->count()}}</td>
      <td><a href="/admin/editCategory/{{$category->id}}" class="btn btn-primary">Edit</td>
      <td><a href="/admin/deleteCategory/{{$category->id}}" onclick=" return confirm('คุณต้องการลบข้อมูลหรือไม่?')" class="btn btn-danger">Delete</td>
    </tr>
    @endforeach


    @endif
  
  </tbody>

</table>

{{$categories->links()}}

</div>


@endsection
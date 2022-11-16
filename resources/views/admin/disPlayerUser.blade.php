@extends('layouts.admin')
<!-- เปลี่ยนแค่ sectionbody -->
@section('body')
@if($users->count()>0)
<!-- ตาราง Category -->
<div class="table-responsive mt-2">
<h2>User Panel</h2>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
    </tr>
  </thead>

  <tbody>
    @foreach($users as $user)
    <tr>
      <th scope="row">{{$user->id}}</th>
      <th scope="row">{{$user->name}}</th>
      <th scope="row">{{$user->email}}</th>
    </tr>
   @endforeach

   @else
        <div class="alert alert-danger mt-2">
        ไม่มีข้อมูลการชำระเงิน
        </div>
    @endif
  
  </tbody>

</table>
{{$users->links()}}
</div>
@endsection
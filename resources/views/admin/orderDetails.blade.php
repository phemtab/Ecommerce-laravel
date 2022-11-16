@extends('layouts.admin')
<!-- เปลี่ยนแค่ sectionbody -->
@section('body')
@if($orderitems->count()>0)
<!-- ตาราง Category -->
<div class="table-responsive mt-2">
<h2>Order Details</h2>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Item ID</th>
      <th scope="col">Item Name</th>
      <th scope="col">Item Prices</th>
      <th scope="col">Item Amount</th>
      
    
    </tr>
  </thead>

  <tbody>
    @foreach($orderitems as $orderitem)
    <tr>
      <th scope="row">{{$orderitem->item_id}}</th>
      <th scope="row">{{$orderitem->item_name}}</th>
      <th scope="row">{{$orderitem->item_price}}</th>
      <th scope="row">{{$orderitem->item_amount}}</th>
    </tr>
   @endforeach

   @else
        <div class="alert alert-danger mt-2">
        ไม่มีข้อมูลใบสั่งซื้อ
        </div>
    @endif
  
  </tbody>

</table>

<a href="/admin/orders" class="btn btn-primary">Back</a>

</div>


@endsection
@extends('layouts.admin')
<!-- เปลี่ยนแค่ sectionbody -->
@section('body')
@if($orders->count()>0)
<!-- ตาราง Category -->
<div class="table-responsive mt-2">
<h2>Order Panel</h2>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">OrderID</th>
      <th scope="col">Date</th>
      <th scope="col">Delivery</th>
      <th scope="col">Price</th>
      <th scope="col">Status</th>
      <th scope="col">UserID</th>
      <th scope="col">Order Details</th>
    
    </tr>
  </thead>

  <tbody>
    @foreach($orders as $order)
    <tr>
      <th scope="row">{{$order->order_id}}</th>
      <th scope="row">{{$order->date}}</th>
      <th scope="row">{{$order->del_date}}</th>
      <th scope="row">{{number_format($order->price)}}</th>
      <th scope="row">
      <span class="
      @if($order->status=='Not Paid')
        badge badge-danger
      @else
        badge badge-success
      @endif
      "> {{$order->status}}</span>
      </th>

      <th scope="row">{{$order->user_id}}</th>



      <td>
      <a href="/admin/orders/detail/{{$order->order_id}}" class="btn btn-info">Detail</td>
      </td>
    </tr>
   @endforeach

   @else
        <div class="alert alert-danger mt-2">
        ไม่มีข้อมูลใบสั่งซื้อสินค้า
        </div>
    @endif
  
  </tbody>

</table>

{{$orders->links()}}

</div>


@endsection
@extends('layouts.admin')
<!-- เปลี่ยนแค่ sectionbody -->
@section('body')
@if($payments->count()>0)
<!-- ตาราง Category -->
<div class="table-responsive mt-2">
<h2>Payment Panel</h2>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Date</th>
      <th scope="col">Paypal OrderID</th>
      <th scope="col">Paypal PayerID</th>
      <th scope="col">Amount</th>
      <th scope="col">Order ID</th>
    </tr>
  </thead>

  <tbody>
    @foreach($payments as $payment)
    <tr>
      <th scope="row">{{$payment->id}}</th>
      <th scope="row">{{$payment->date}}</th>
      <th scope="row">{{$payment->paypal_order_id}}</th>
      <th scope="row">{{$payment->payer_id}}</th>
      <th scope="row">{{number_format($payment->amount)}}</th>
      <th scope="row">{{$payment->order_id}}</th>


    </tr>
   @endforeach

   @else
        <div class="alert alert-danger mt-2">
        ไม่มีข้อมูลการชำระเงิน
        </div>
    @endif
  
  </tbody>

</table>
{{$payments->links()}}
</div>
@endsection
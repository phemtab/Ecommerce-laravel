@extends("layouts.index")

@section("content")

<section id="cart_items">
<div class="container">
    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">Shopping Cart</li>
        </ol>
    </div>
        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p> Shipping/Bill To</p>
                        <div class="form-one">
                                       <div class="total_area" style="padding:10px">
                                            <ul>
                                                <li>Payment Status
                                                    @if($payment_info['status']=='Not Paid')
                                                        <span>ยังไม่ชำระเงิน</span>
                                                    @endif
                                                </li>

                                                <li>total
                                                    <span>{{$payment_info['price']}}</span>
                                                </li>
                                                
                                                <li>
                                                    <div id="paypal-button-container"></div>
                                                </li>
                                            </ul>
                                        <a class="btn btn-default update" href="">Update</a>
                                      </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
<script 
src="https://www.paypal.com/sdk/js?client-id=Ac7Rwibh609SR7lKrif5PmsgzfhErQ14a_nNUDZ1BLxoYTAJ28UKw7ehAxxJCm1R3j84ogDOL6f_4yx7">

</script>
    <script>
      paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '{{$payment_info['price']}}' // Can also reference a variable or function
              }
            }]
          });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
          return actions.order.capture().then(function(orderData) {
                window.location='/paymentreciept/'+data.orderID+'/'+data.payerID;

          });
        }
      }).render('#paypal-button-container');
    </script>
  


@endsection
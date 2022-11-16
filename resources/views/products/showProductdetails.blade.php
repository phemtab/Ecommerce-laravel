@extends("layouts.index")

<!-- เพิ่มส่วนของ content -->
@section("content")
<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian">
            <!--category-productsr-->
							@foreach($categories as $category)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="/products/category/{{$category->id}}">{{$category->name}}</a></h4>
								</div>
							</div>
							@endforeach
						</div><!--/category-products-->

						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								 <form class="" action="/products/priceRange" method="get">
								 
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="10000" data-slider-step="5" data-slider-value="[0,10000]" id="sl2" name="price"><br />
								 <b class="pull-left">0</b> <b class="pull-right">10,000</b>
								 <input type="submit" name="" value="ค้นหา" class="btn btn-primary">
								</form>
							</div>
						</div><!--/price-range-->
					</div>
				</div>

                
                
                <div class="col-sm-9 padding-right">
        <div class="product-details"><!--product-details-->
          <div class="col-sm-5">
            <div class="view-product">
              <img src="{{asset('storage')}}/product_image/{{$product->image}}" alt="" />
            </div>
          </div>
          <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->
              <img src="{{asset('images/product-details/new.jpg')}}" class="newarrival" alt="" />
              <h2>{{$product->name}}</h2>
              <p>{{$product->description}}</p>
              <img src="{{asset('images/product-details/rating.png')}}" alt="" />
            <!-- ทำเป็นแบบฟอร์มกด submit เพื่อระบุจำนวนสินค้า ส่ง id ไปแต่จะไม่ปรากฎใน url แค่นั้น -->
             <form class="" action="/products/addQuantityToCart" method="post">
            {{csrf_field()}}
             <span>
                <span>{{number_format($product->price)}}</span>
                <!-- //ส่ง id ไปแบบ hidden -->
                <input type="hidden" name="_id" value="{{$product->id}}">
                <label>Quantity:</label>
                <!-- ส่ง Quantity ไปด้วย -->
                <input type="text" value="1" name="quantity" />
                <button type="submit" class="btn btn-fefault cart">
                  <i class="fa fa-shopping-cart"></i>
                  Add to cart
                </button>
              </span>


             </form>

              <p><b>Category :</b> 
              <a href="/products/{{$product->category->id}}"> {{$product->category->name}}</a>
              </p>
              <a href=""><img src="{{asset('images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
            </div><!--/product-information-->
          </div>
          </div><!--/product-details-->
</div>


			</div>
		</div>
	</section>

@endsection
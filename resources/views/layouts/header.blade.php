<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Shopee Thailand | ซื้อขายผ่านมือถือ หรือออนไลน์</title>
	<link rel="icon" href="https://www.lussodecorations.com/wp-content/uploads/2021/03/Shopee-ICON-1024x1024.png" type="image/x-icon">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
	  <link href="{{asset('css/main.css')}}" rel="stylesheet">
	  <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
	  <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

<style>
	.navbar-nav li ul.sub-menu li a:hover {
		color : green ;
	}

</style>
	  
</head><!--/head-->
<body>

	<header id="header" class="sticky-top"><!--header-->

		<div class="header_top"><!--header_top-->
			<!-- แถบแสดง Social Network -->
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- แถบแสดง Social Network -->
		</div><!--/header_top-->

		<div class="header-middle" style="background-color:#ff5c33;" ><!--header-middle-->
			<div class="container" style="background-color:#ff5c33;">
				<div class="row">
					<!-- Logo ของ Shopee (pull left) 8 ส่วน -->
					<div class="col-sm-8">
						<div class="logo pull-left">
							<a href="/products"><img src="https://aukey.co.th/wp-content/uploads/2020/03/Shopee-logo.png" width="60px" height="60px" alt="" /></a>
						</div>
						<h3 style="color:white;font-family: 'Nunito', sans-serif;font-size:28px;">Shopee</h3>
					</div>
					
					<!-- Logo ของ Shopee (pull right) 4 ส่วน -->
					<div class="col-sm-4">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<!-- //เช็คว่า login หรือยัง -->
								@if(Auth::check())
								<li><a href="/home" style="background-color:#ff5c33;color:white;" ><i class="fa fa-user"></i>My Account</a></li>
								<li><a href="/products/cart" style="background-color:#ff5c33;color:white;" >
								<!-- ถ้ามี cartItems ขึ้นมาก็จะมีตะกร้าแล้ว -->
								@if(isset($cartItems))
									<span class="badge" style="background-color:white;color:black">{{$cartItems->totalQuantity}}</span>
								@endif
								<i class="fa fa-shopping-cart"></i> Cart</a></li>
								<li><a href="checkout.html" style="background-color:#ff5c33;color:white;" ><i class="fa fa-credit-card"></i> Checkout</a></li>

								@else
								<li><a href="/login" style="background-color:#ff5c33;color:white;" ><i class="fa fa-lock"></i> Login</a></li>
								<li><a href="/register" style="background-color:#ff5c33;color:white;" ><i class="fa fa-user"></i> Register</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->


		<div class="header-bottom"><!--header-bottom-->
			<div class="container">

				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>

						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">

								<li><a href="/products" class="active">Home</a></li>

								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li>
										<li><a href="checkout.html">Checkout</a></li>
										<li><a href="cart.html">Cart</a></li>
										<li><a href="login.html">Login</a></li>
                                    </ul>
                                </li>

								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li>

								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="search_box pull-right">
							<form class=" " action="/products/search" method="get">
									<input type="text" placeholder="Search" name="search"/>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
		

	</header><!--/header-->

	<section id="slider"><!--slider-->

		<div class="container">
			<div class="row">

				<div class="col-sm-12"> 
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>

						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>แพลตฟอร์มช็อปปิ้งออนไลน์</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{asset('images/home/girl1.jpg')}}" class="girl img-responsive" alt="" />
									<img src="{{asset('images/home/pricing.png')}}"  class="pricing" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>บริการ ทุกระดับประทับใจ</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="images/home/girl2.jpg" class="girl img-responsive" alt="" />
									<img src="images/home/pricing.png"  class="pricing" alt="" />
								</div>
							</div>

							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>รับประกันสินค้านาน 3 ปี</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="images/home/girl3.jpg" class="girl img-responsive" alt="" />
									<img src="images/home/pricing.png" class="pricing" alt="" />
								</div>
							</div>

						</div>

						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>

				</div>

			</div>
		</div>

</section><!--/slider-->
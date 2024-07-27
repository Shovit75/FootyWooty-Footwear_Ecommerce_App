@extends('frontend.layouts.main')
@section('content')

<div class="sale">
    <div class="container">
        <div class="text-center">
            <h3 style="color: lightseagreen; font-family: Courier New, monospace;">Checkout the best Footwear from the Platform</h3>
        </div>
    </div>
</div>
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="{{route('frontend.index')}}">Home</a></span> / <span>{{$category->name}}</span></p>
					</div>
				</div>
			</div>
		</div>

		<div class="breadcrumbs-two">
			<div class="container">
				<div class="row">
					<div class="col">
                        @if(request()->is('frontend/showcat/Men'))
                        <div class="breadcrumbs-img" style="background-image: url('/storage/background/Mens_Category.jpg');">
                        @elseif(request()->is('frontend/showcat/Women'))
                        <div class="breadcrumbs-img" style="background-image: url('/storage/background/womenpageeee.jpg');">
                        @else
                        <div class="breadcrumbs-img" style="background-image: url('/storage/background/shoeee.jpg');">
                        @endif

						</div>
						<div class="menu text-center">
							<p><a href="">Purchase the best Footwear for {{$category->name}} Here in this Platform</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>

        <div class="container mb-4">
            <div class="row row-cols-3 g-3">
                @foreach($prodsubcat->take(3) as $subcategory)
                <div class="col">
                    <a href="{{url('frontend/showsubcat/'.$subcategory->name)}}">
                  <div class="card">
                    <img src="/storage/{{ $subcategory->image }}" width="100%" height="280" alt="Los Angeles Skyscrapers" />
                    <div class="card-body">
                      <h5 class="text-center card-title">{{$subcategory->name}}</h5>
                    </div>
                  </div>
                </a>
                </div>
                @endforeach
              </div>
        </div>

        <style>
            @media (min-width: 1024px) {
                .colorlib-product {
                    margin: -90px;
                }
            }
        </style>
        <div class="colorlib-product">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-xl-3">
						<div class="row">
                            <div class="col-sm-12">
								<div class="side border mb-1">
									<h3>Sorting</h3>
									<ul>
										<li><a href="#" id="sort-asc">Price - Low To High</a></li>
										<li><a href="#" id="sort-desc">Price - High To Low</a></li>
                                        <li><a href="#" id="latest">Latest / Newest</a></li>
									</ul>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="side border mb-1">
									<h3>Size/Width</h3>
									<div class="block-26 mb-2">
										<h4>Size</h4>
					               <ul id="size-select">
                                    <li><a href="#" data-size="6">6</a></li>
                                    <li><a href="#" data-size="7">7</a></li>
                                    <li><a href="#" data-size="8">8</a></li>
                                    <li><a href="#" data-size="9">9</a></li>
                                    <li><a href="#" data-size="10">10</a></li>
                                    <li><a href="#" data-size="11">11</a></li>
                                    <li><a href="#" data-size="12">12</a></li>
					               </ul>
					            </div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="side border mb-1">
									<h3>Colors</h3>
									<ul id="color-select">
										<li><a href="#" data-value="Red">Red</a></li>
										<li><a href="#" data-value="Blue">Blue</a></li>
										<li><a href="#" data-value="Yellow">Yellow</a></li>
										<li><a href="#" data-value="Green">Green</a></li>
										<li><a href="#" data-value="White">White</a></li>
										<li><a href="#" data-value="Black">Black</a></li>
										<li><a href="#" data-value="Orange">Orange</a></li>
										<li><a href="#" data-value="Brown">Brown</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>

                    <div class="col-lg-9 col-xl-9">
                        <div id="product-list">
                        @if($products->isNotEmpty())
                        <div class="row row-pb-md">
                            @foreach($products as $product)
                            <div class="col-lg-4 mb-4 text-center">
                                <div class="product-entry border">
                                    <a href="{{url('frontend/proddetail/'.$product->id)}}" class="prod-img">
                                        <img src="/storage/{{ $product->image }}" width="100%" height="280px" alt="{{ $product->name }}">
                                    </a>
                                    <div class="desc">
                                        <h2><a href="{{url('frontend/proddetail/'.$product->id)}}">{{ $product->name }}</a></h2>
                                        <span class="price"> ₹ {{ $product->price }}</span>
                                        <?php
                                        // Assuming $product->color is a JSON string
                                        $productColorsArray = json_decode($product->color);
                                        if (!function_exists('generateColorCircles')) {
                                        // Function to generate HTML for circles based on colors
                                        function generateColorCircles($colors) {
                                            $html = '<span>Colors Available:</span><div class="py-2 d-flex">
                                            <div class="container text-center"><div class="row justify-content-center">';
                                            foreach ($colors as $color) {
                                                $html .= '<span class="circle custom-' . strtolower($color) . ' mr-3 border border-secondary"></span>';
                                            }
                                            $html .= '</div></div></div>';
                                            return $html;
                                            }
                                        }
                                        // Usage example
                                        echo generateColorCircles($productColorsArray);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                            <p class="text-center mt-5">No products added</p>
                        @endif
                        </div>
                    </div>
				</div>
                <div class="row mr-5 justify-content-end">
                    {{$products->onEachSide(1)->links()}}
                </div>
			</div>
		</div>

        <div class="category" hidden>{{$category->name}}</div>

@endsection

@section('script')

<script>
    $(document).ready(function() {
        $('#size-select a').click(function(e) {
            e.preventDefault();
            var selectedSize = $(this).data('size');
            var currentCategory = $('.category').text();

            // Make an AJAX request to filter products by size
            $.ajax({
                type: 'GET',
                url: '/filter-products-by-size',
                data: { size: selectedSize, category: currentCategory  },
                success: function(response) {
                    // Update the product listing with filtered products
                    $('#product-list').html(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });

        $('#color-select a').click(function(e) {
            e.preventDefault();
            var selectedColor = $(this).data('value');
            var currentCategory = $('.category').text();

            // Make an AJAX request to filter products by size
            $.ajax({
                type: 'GET',
                url: '/filter-products-by-color',
                data: { color: selectedColor, category: currentCategory  },
                success: function(response) {
                    // Update the product listing with filtered products
                    $('#product-list').html(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });

        $('#sort-asc').click(function(e) {
            e.preventDefault();
            var currentCategory = $('.category').text();

            // Make an AJAX request to filter products by size
            $.ajax({
                type: 'GET',
                url: '/sort-price-asc',
                data: {category: currentCategory},
                success: function(response) {
                    // Update the product listing with filtered products
                    $('#product-list').html(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });

        $('#sort-desc').click(function(e) {
            e.preventDefault();
            var currentCategory = $('.category').text();

            // Make an AJAX request to filter products by size
            $.ajax({
                type: 'GET',
                url: '/sort-price-desc',
                data: {category: currentCategory},
                success: function(response) {
                    // Update the product listing with filtered products
                    $('#product-list').html(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });

        $('#latest').click(function(e) {
            e.preventDefault();
            var currentCategory = $('.category').text();

            // Make an AJAX request to filter products by size
            $.ajax({
                type: 'GET',
                url: '/sort-latest',
                data: {category: currentCategory},
                success: function(response) {
                    // Update the product listing with filtered products
                    $('#product-list').html(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>

@endsection

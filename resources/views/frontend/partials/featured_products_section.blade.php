<section class="mb-4">
    <div class="container">
        <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
            <div class="d-flex mb-3 align-items-baseline border-bottom">
                <h3 class="h5 fw-700 mb-0">
                    <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Featured Products') }}</span>
                </h3>
            </div>
            <div class="aiz-carousel gutters-10 half-outside-arrow"  data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
          @php
          $slider_error = json_decode(get_setting('error_slider'), true); 
          $error_panner = json_decode(get_setting('error_panner'), true); 
          $error_product = json_decode(get_setting('error_product'), true); 
        $color = App\BusinessSetting::where('type','base_color')->first()->value;

          @endphp
                @foreach (filter_products(\App\Product::where('published', 1)->where('featured', '1'))->limit(12)->get() as $key => $product)
                        <div class="carousel-box">
                            <div class="aiz-card-box border border-primary  h-393px rounded hov-shadow-md my-2 has-transition" style="  box-shadow: 3px 5px 7px #6b6167 !important;width:100% !important " >
      <div class="position-relative "style="
                            border-bottom: 1px solid @php 
            echo App\BusinessSetting::where('type','base_color')->first()->value;
                    @endphp;
                        ">                                    <a href="{{ route('product', $product->slug) }}" class="d-block">
                            
                                        <img
                                            class="img-fit lazyload mx-auto h-240px h-md-210px"
                                            src="{{ uploaded_asset($error_product) }}"
                                            data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                            alt="{{  $product->langname()  }}"
                                            onerror="this.onerror=null;this.src='{{ uploaded_asset($error_product) }}';"
                                        >
                                    </a>
                                    <div class="absolute-top-right aiz-p-hov-icon">
                                        <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}" data-placement="left">
                                            <i class="la la-heart-o"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to compare') }}" data-placement="left">
                                            <i class="las la-sync"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to cart') }}" data-placement="left">
                                            <i class="las la-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                                  <div class="p-md-3 p-2 text-left" >
                                <div class="fs-15" style="display: inline-flex;">
                                  <span class="fw-700 text-primary fs-6"  style="font-size: 14px;">{{ home_discounted_base_price($product->id) }}</span>
            @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                    <del class="fw-600 opacity-50 " style="font-size: smaller  !important;margin: 3px;"> {{ home_base_price($product->id) }}</del>
                                                    @else
                                                   <del class="fw-600 opacity-50 " style="font-size: small  !important;margin: 3px; color:white">{{ home_base_price($product->id) }}</del>  
                                                   @endif
                                  
                                </div>
                               <div style="text-align: center;">
                                <div class="rating rating-sm mt-1 " style="display: inline-flex;text-align: center;">
                                    {{ renderStarRating($product->rating) }}
                                   
                                </div>
                                </div>
                                <h3 class="fw-600 fs-10 text-truncate-2 lh-1-4  h-2px" style="font-size: 16px !important;">
                                        <a href="{{ route('product', $product->slug) }}" class="d-block text-reset" style="height: 25px;"> {{$product->langname()}}</a>

                                    </h3>
                                     <div class="rounded px-2 mt-2 bg-soft-primary border-soft-primary border " style="text-align: center;">
                                                                       <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to cart') }}">{{ translate('Add to cart') }}</a>

                                    </div>

                                    @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                        <div class="rounded px-2 mt-2 bg-soft-primary border-soft-primary border">
                                            {{ translate('Club Point') }}:
                                            <span class="fw-700 float-right">{{ $product->earn_point }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

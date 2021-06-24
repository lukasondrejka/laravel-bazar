

<!-- Card -->
    <div class="card card-ecommerce hoverable mb-4">
            <div class="card-body">

                <!-- Row -->
                <div class="row">

                    @if ($product->images->count())
                        <!-- Card image col -->
                        <div class="col-sm-3 pb-3">

                            <!-- Card image -->
                            <div class="view view-cascade overlay card image-wrapper image-wrapper4x3">
                                <img  class="card-img-top" src="{{  $product->coverImage->url_small ?? $product->images()->first()->url }}" >
                                <a href="{{ route('product.product', ['id' => $product->id]) }}">
                                    <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                </a>
                            </div>
                            <!-- Card image -->

                        </div>
                        <!-- Card image col -->
                    @endif

                    <!-- Content -->
                    <div class="col-sm">

                        <h4 class="card-title mb-1"><a href="{{ route('product.product', ['id' => $product->id]) }}">{{ $product->title }}</a></h4>

                            <!-- <span class="h6 badge badge-pill badge-danger">TOP</span> -->

                            <div class="row">
                                @if (!$product->active && Auth::id() == $product->user->id)
                                    <div class="col-auto"><span class="badge badge-pill badge-danger">deaktivovaný</span></div>
                                @endif

                                <div class="col-auto"><span class="badge badge-pill badge-primary">{{ $product->type }}</span></div>
                                <div class="col-auto"><p class="mb-2"><small>{{ $product->category->name }}</small></p></div>

                            </div>

                            <p>{{ $product->teaser }}</p>

                    </div>
                    <!-- Content -->

                </div>
                <!-- Row -->

                <!-- Card Footer Row -->
                <div class="row">
                    <div class="col-auto pt-1"><a href="{{ route('user.profile', ['id' => $product->user->id]) }}"><i class="fas fa-user"></i> {{ $product->user->name }} </a> </div>
                    <div class="col-auto pt-1"><i class="far fa-calendar-alt"></i> {{ $product->created_date }}</div>
                    <div class="col-auto pt-1"><i class="fas fa-camera"></i> {{ $product->images->count() }}</div>

                    <div class="col"></div>

                    <div class="col-auto h4 mr-2 mb-2"><span class="">{{ $product->formated_price }} €</span></div>
                </div>
                <!-- Card Footer Row -->

            </div> <!-- .card-body -->
    </div>
    <!-- Card -->

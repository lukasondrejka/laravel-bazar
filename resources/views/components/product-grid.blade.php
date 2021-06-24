<!-- Card -->
<div id="grid-product" class="card card-ecommerce hoverable w-100">

        <!-- Card image -->
        <div class="view view-cascade overlay image-wrapper image-wrapper16x9">
            <img  class="card-img-top" src="https://www.bazos.sk/img/1/141/102338141.jpg?t=1567152136" >
            <a href="#!">
                <div class="mask rgba-white-slight waves-effect waves-light"></div>
            </a>
        </div>
        <!-- Card image -->

        <!-- Content -->
        <div class="card-body">

            <h5 class="card-title mb-1">{{ $product->title }}</h5>

            <p class="mb-1" >{{ trim(preg_replace('/\s\s+/', ' ', $product->description)) }}</p>

            <!-- Card Footer -->
            <div>
                <div><i class="fas fa-user"></i> {{ $product->user->username }}</div>
                <div><i class="fas fa-map-marker-alt"></i> Nove mesto nad Vahom ddd</div>

                <div class="row mt-1">
                    <div class="col-auto mt-1"><span class="badge badge-pill badge-primary">{{ $product->type }}</span></div>
                    <div class="col"></div>
                    <div class="col-auto h4  "><span class="badge badge-success badge-pill">{{ number_format((float)$product->price, 2, ',', '') }} €</span></div>
                </div>
            </div>
            <!-- Card Footer -->

        </div>
        <!-- Content -->

    </div>
    <!-- Card -->

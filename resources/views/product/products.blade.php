@extends('layouts.app')

@section('title', "Inzeraty")

@section('content')
<div style="top: -56px; position: relative" class="container">

        <div id="products" class=" w-100">
                <form method="GET" action="{{ route('product.products') }}">
                <div class="row">

                    <!-- Sidebar col -->
                    <div class="col-lg-3">
                        <div class="sticky-top">

                            <div class="w-0" style="padding-top: 56px"></div>

                            <!-- Sidebar -->
                            <div class="px-2">

                                <!-- Search -->
                                <div class="text-center">
                                    <div class="md-form form-lg">
                                        <input type="text" id="search" name="search" value="{{ $search->search }}" class="form-control">
                                        <label for="search"><strong>Hladať</strong></label>
                                    </div>

                                </div>
                                <!-- Search -->

                                <!-- Filter by category -->
                                <div class="">
                                    <h5 class="font-weight-bold dark-grey-text"><strong>Typ</strong></h5>

                                    <div class="divider"></div>

                                    <!-- Radio group -->
                                    <div class="form-group ">
                                        <input class="form-check-input" name="type" value="" type="radio" id="type0" {{ $search->type?:'checked' }}>
                                        <label for="type0" class="form-check-label dark-grey-text">Ponuka aj dopyt</label>
                                    </div>

                                    <div class="form-group ">
                                        <input class="form-check-input" name="type" value="ponuka" type="radio" id="type1" {{ ($search->type == 'ponuka')?'checked':'' }}>
                                        <label for="type1" class="form-check-label dark-grey-text">Ponuka</label>
                                    </div>

                                    <div class="form-group ">
                                        <input class="form-check-input" name="type" value="dopyt" type="radio" id="type2" {{ ($search->type == 'dopyt')?'checked':'' }}>
                                        <label for="type2" class="form-check-label dark-grey-text">Dopyt</label>
                                    </div>
                                    <!-- Radio group -->
                                </div>

                                <div class="row">
                                    <div class="col-sm md-form">
                                        <input type="number" id="min_price" min="0" value="{{ $search->min_price }}" name="min_price" class="form-control">
                                        <label for="min_price" class="ml-3">Cena od</label>
                                    </div>
                                    <div class="col-sm md-form">
                                        <input type="number" id="max_price" min="0" value="{{ $search->max_price }}" name="max_price" class="form-control">
                                        <label for="max_price" class="ml-3">do</label>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col">
                                    <button type="submit" href="{{ route('product.create') }}" class="btn btn-success btn-rounded w-100">Hladať</button>
                                    </div>
                                </div>




                                <div class="mt-3">

                                        <a type="button" href="{{ route('product.create') }}" class="btn btn-primary btn-rounded btn-sm w-100">Pridať inzerát</a>

                                </div>


                            </div>
                            <!-- Sidebar -->

                            <div></div>

                        </div>
                    </div>
                    <!-- Sidebar col -->

                    <!-- Content col -->
                    <div class="col-lg-9" style="margin-top: -2px">
                        <div class="d-none d-lg-block w-0" style="height: 56px"></div>

                        <!-- Grid row -->
                        <div class="row">

                            <!-- Categories -->
                            <div class="col-md-12">
                                <div class="row pt-4 mb-3">

                                    <!-- Category -->
                                    <div class="col-md">
                                        <select class="mdb-select md-form m-1" name="category">
                                            <option value="" disabled selected>Kategoria</option>
                                            <option value="%" {{ (old('category', $search->category) == "%") ? 'selected' : '' }}>Všetky kategórie</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ (old('category', $search->category) == $category->id) ? 'selected' : ''}}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Category -->

                                </div>
                            </div>
                            <!-- Categories -->

                        </div>
                        <!-- Grid row -->

                        <?php
                            $type = 'list'
                        ?>

                        @if (count($products))
                            @if($type == 'list')
                                @forelse($products as $product)

                                    @component('components.product-list', ['product' => $product])
                                    @endcomponent

                                @endforeach

                            @elseif($type == 'grid')
                                @forelse($products as $product)

                                    @component('components.product-list', ['product' => $product])
                                    @endcomponent

                                @endforeach

                            @endif
                        @else

                            <div class="alert alert-danger" role="alert" >
                                Nenašli sa žiadne inzeráty.
                            </div>

                        @endif




                        {!! $products->appends($search->except('page'))->render() !!}



                    </div>
                    <!-- Content col -->
                </div>

                </form>
            </div>

</div>
@endsection

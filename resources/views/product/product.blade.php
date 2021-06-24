@extends('layouts.app')

@section('title', $product->title)

@section('content')
<div class="container">
    <div class="justify-content-center" >

        <!-- Card -->
        <div class="card my-5 p-5 hoverable">

            <!-- Div -->
            <div class="">

                <!-- Card Header -->
                <div>
                    <h2 class="h2-responsive text-center text-md-left product-name font-weight-bold dark-grey-text mb-1 ml-xl-0 ml-4">

                        <strong>{{ $product->title }}</strong>

                    </h2>

                    <div class=""><p class="m-0"><small>{{ $product->category->name }}</small></p></div>
                    <div class="row mt-2">
                        <div class="col-auto pt-1"><a href="{{ route('user.profile', ['id' => $product->user->id]) }}"><i class="fas fa-user"></i> {{ $product->user->name }} </a> </div>
                        <div class="col-auto"><p class="py-1"><small><i class="far fa-calendar-alt"></i> {{ date('d.m.Y',strtotime($product->created_at)) }}</small></p></div>
                        <div class="col-auto"><p class="py-1"><small><i class="fas fa-edit"></i> {{ date('d.m.Y',strtotime($product->updated_at)) }}</small></p></div>
                    </div>
                </div>
                <!-- Card Header -->

                <!-- Images -->
                @if ($product->images->count())
                    <div class="col-lg-5 m-lg-3 pr-lg-3 mb-md-5  p-0 m-0 mb-3 float-lg-left float-md-none " >

                        <!-- Cover Images -->
                        <div class="view view-cascade overlay card image-wrapper image-wrapper4x3">
                            <img src="{{ $product->coverImage->url ?? $product->images()->first()->url }}" >
                            <a href="#">
                                <div class="mask rgba-white-slight waves-effect waves-light"></div>
                            </a>
                        </div>
                        <!-- Cover Images -->

                        <!-- Small Images -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row pt-4">

                                    @foreach ($product->images as $image)
                                        <div class="col-sm-4 col-6 mb-4">
                                            <div class="view view-cascade overlay card image-wrapper image-wrapper4x3">
                                                <img src="{{ $image->url }}">
                                                <a href="{{ $image->url }}" data-lightbox="image" data-title="">
                                                    <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <!-- Small Images -->

                    </div>
                @endif
                <!-- Images -->

                <!-- Description-->
                <div>
                    {!! $product->rich_description !!}
                </div>
                <!-- Description-->

            </div>
            <!-- Div -->

            <div class="row mt-3 mb-4">
                <div class="col-md-12 text-center text-md-left text-md-right">
                    <span class="h2 pr-2">
                        {{ $product->formated_price }} €
                    </span>
                </div>
            </div>


            <!--  -->
            @if(  $product->user_id == Auth::id() )

                <!-- Buttons Area -->
                <div class="row">
                    <div class="col"></div>

                        <div class="col-md-12 text-center text-md-right">
                            <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="btn btn-success btn-rounded waves-effect waves-light">
                                Upraviť
                            </a>

                            @if ($product->active == true)
                                <button data-target="#deactivateModal" data-toggle="modal" class="btn btn-warning btn-rounded waves-effect waves-light">
                                    Deaktivovat
                                </button>
                            @else
                                <button data-target="#activateModal" data-toggle="modal" class="btn btn-warning btn-rounded waves-effect waves-light">
                                    Aktivovat
                                </button>
                            @endif

                            <button data-target="#deleteModal" data-toggle="modal" class="btn btn-danger btn-rounded waves-effect waves-light">
                                Zmazať
                            </button>
                        </div>

                </div>
                <!-- Buttons Area -->

                <!-- Remove Product Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModal">Vymazať inzerát</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Naozaj chcete vymazať inzerát <strong>{{ $product->title }}</strong>?<br>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrusit</button>
                                <button type="button"  onclick="event.preventDefault(); document.getElementById('destroy-form').submit();" class="btn btn-primary">vymazat</button>

                            </div>
                        </div>
                    </div>

                    <form id="destroy-form" calss="d-none" action="{{ route('product.destroy', ['id' => $product->id]) }}" method="POST">
                        @csrf
                    </form>
                </div>
                <!-- Remove Product Modal -->

                <!-- Deactivate Product Modal -->
                <div class="modal fade" id="deactivateModal" tabindex="-1" role="dialog" aria-labelledby="deactivateModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" >Deaktovovat inzerát</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Naozaj chcete deaktivovat inzerát <strong>{{ $product->title }}</strong>?<br>
                                    Inzerát nebude vyditelný pre ostatných používateľov.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrusit</button>
                                <button type="button"  onclick="event.preventDefault(); document.getElementById('deactivate-form').submit();" class="btn btn-primary">Deaktivovat</button>

                            </div>
                        </div>
                    </div>
                    <form id="deactivate-form" calss="d-none" action="{{ route('product.deactivate', ['id' => $product->id]) }}" method="POST">
                        @csrf
                    </form>
                </div>
                <!-- Deactivate Product Modal -->

                <!-- Activate Product Modal -->
                <div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-labelledby="activateModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" >Aktovovat inzerát</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Naozaj chcete aktivovat inzerát <strong>{{ $product->title }}</strong>?<br>
                                    Inzerát bude vyditelný pre ostatných používateľov.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrusit</button>
                                <button type="button"  onclick="event.preventDefault(); document.getElementById('activate-form').submit();" class="btn btn-primary">aktivovat</button>

                            </div>
                        </div>
                    </div>
                    <form id="activate-form" calss="d-none" action="{{ route('product.activate', ['id' => $product->id]) }}" method="POST">
                        @csrf
                    </form>
                </div>
                <!-- Activate Product Modal -->

            @endif
            <!--  -->

        </div>
        <!-- Card -->

        @component('components.user', ['user' => $product->user, 'product' => $product])
        @endcomponent

        @push('styles')
            <link href="{{ asset('css/lightbox.css') }}" rel="stylesheet">
        @endpush

        @push('scripts')
            <script src="{{ asset('js/lightbox.js') }}"></script>

            <script>
                lightbox.option({
                  //'resizeDuration': 700,
                  'wrapAround': true,
                  'albumLabel': '%1/%2'
                })
            </script>
        @endpush

    </div>
</div>
@endsection

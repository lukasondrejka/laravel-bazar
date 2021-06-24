@extends('layouts.app')

@section('content')
<div class="container">
        <div class="card hoverable p-4 " style="margin-top: 35vh">
                <div class="row text-center">
                    <div class="col-md-12">

                        <form method="GET" action="{{ route('product.products') }}">
                            <div class="row px-2">

                                <div class="col my-2">
                                    <div class="md-form md-outline form-lg my-1">
                                        <input id="search" name="search" class="form-control form-control-lg" type="text" >
                                        <label for="search">Hladať</label>
                                    </div>
                                </div>

                                <div class="col-auto my-2">
                                    <button type="submit" class="btn btn-primary">Hladať</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>

            </div>

</div>
@endsection

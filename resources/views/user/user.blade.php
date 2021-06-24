@extends('layouts.app')

@section('title', $user->name)

@section('content')
<div class="container">
    <div class="justify-content-center" >

        @component('components.user', ['user' => $user])
        @endcomponent

        @if ($user->products())
            <div id="products" class="py-4 pt-2">

                <div class="text-center my-3 pb-4">
                    <span class="h1">
                        @if (Auth::id() != $user->id)
                            Inzeráty používateľa
                        @else
                            Moje Inzeráty
                        @endif
                    </span>
                </div>

                @php
                    if (Auth::id() == $user->id){
                        $products = $user->products()->latest()->paginate(5);
                    } else {
                        $products = $user->products()->where('active', true)->latest()->paginate(5);
                    }
                @endphp

                @foreach ($products as $product)
                    @component('components.product-list', ['product' => $product])
                    @endcomponent
                @endforeach

                {!! $products->render() !!}

            </div>
        @endif

    </div>
</div>
@endsection

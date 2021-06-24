<!-- Card -->
<div class="card my-5 p-5 hoverable">
    <div class="row mb-3">

        @if ($user->avatar)
            <div class="col-auto">
                <div class="view view-cascade">
                    <img src="{{ $user->avatar() }}"  style="border-radius:50%; width:60px;">
                    <a href="{{ route('user.profile', ['id' => $user->id]) }}">
                        <div class="mask rgba-white-slight waves-effect waves-light"></div>
                    </a>
                </div>
            </div>
        @endif

        <div class="col">

            <h2 class="h2-responsive font-weight-bold dark-grey-text mb-1 ml-xl-0 ml-4">
                <strong>{{ $user->name }}</strong>
            </h2>

            <div>
                <p class="m-0">
                    <small>
                        {{ $user->products->count() ?? '' }}
                        @if ( $user->products->count() == 0 || $user->products->count() == 1)
                            inzerát
                        @elseif ( 1 < $user->products->count() && $user->products->count() <= 4 )
                            inzeráty
                        @elseif ( $user->products->count() > 4 )
                            inzerátov
                        @endif
                    </small>
                </p>
            </div>

        </div>

    </div>

    <div class="mb-2">
        {!! nl2br(e( $user->bio )) !!}
    </div>


    <div class="py-1">
        <span class="pl-2 pr-3"><i class="fas fa-envelope"></i></span>
        <a href="mailto:{{ $user->email }}?subject={{ $product->title ?? '' }}">{{ $user->email }}<a>
    </div>

    @if ($user->phone)
        <div class="py-1">
            <span class="pl-2 pr-3"><i class="fas fa-phone"></i></span>
            <a href="tel:{{ $user->phone }}">{{ $user->phone }}<a>
        </div>
    @endif


    @if(  $user->id == Auth::id() )
        <div class="row mt-4">

            <div class="col text-md-right">

                    <a href="{{ route('user.edit' ) }}" class="btn btn-success btn-rounded waves-effect waves-light">
                        Upraviť profil
                    </a>

            </div>
        </div>
    @endif
</div>
<!-- Card -->

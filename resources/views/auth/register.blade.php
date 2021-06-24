@extends('layouts.app')

@section('title', "Registrácia")

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-6 mt-5">
            <section class="form-elegant">
                <div class="card">
                    <div class="card-body mx-4">

                        <!--Header-->
                        <div class="text-center mt-3">
                            <h3 class="dark-grey-text mb-5"><strong>Registrácia</strong></h3>
                        </div>

                        <!--Body-->
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="md-form">
                                <label for="email">Email</label>
                                <input name="email" id="email" class="form-control" value="{{ old('email') }}" autocomplete="email" type="text">
                                @error('email')
                                <small class="form-text text-danger mb-4">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="md-form">
                                <label for="name">Meno</label>
                                <input name="name" id="name" class="form-control" value="{{ old('name') }}" autocomplete="name" type="text">
                                @error('name')
                                <small class="form-text text-danger mb-4">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="md-form">
                                <label for="password">Heslo</label>
                                <input name="password" id="password" class="form-control" type="password" value="">
                                @error('password')
                                <small class="form-text text-danger mb-4">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="md-form">
                                <label for="password-confirm">Potvrdenie hesla</label>
                                <input name="password_confirmation" id="password-confirm" class="form-control" type="password" value="">
                            </div>

                            <div class="form-check pt-3 pb-4">
                                    <input type="checkbox" class="form-check-input" id="conditions" name="conditions" {{ old('conditions') ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="conditions">Súhlasím s <a href="#">podmienkami používania</a>.</label>
                                </div>

                            <div class="text-center pt-3 mb-3">
                                <button type="submit" class="btn btn-info btn-block btn-rounded waves-effect waves-light">Registrovať</button>
                            </div>

                        </form>

                        <p class="font-small dark-grey-text text-right d-flex justify-content-center mb-3 pt-2">
                            alebo
                        </p>

                        <div class="row my-3 d-flex justify-content-center">

                            <!--Facebook-->
                            <a href="http://localhost:8000/login/facebook" class="btn btn-white btn-rounded mr-md-3 z-depth-1a waves-effect waves-light">
                                <i class="fab fa-facebook-f blue-text text-center"></i>
                            </a>

                            <!--Google -->
                            </a><a href="http://localhost:8000/login/google" class="btn btn-white btn-rounded z-depth-1a waves-effect waves-light">
                                <i class="fab fa-google blue-text text-center"></i>
                            </a>
                        </div>
                        <!--Footer-->
                        <div class="modal-footer mx-2 pt-3">
                            <p class="font-small grey-text d-flex justify-content-end">
                                <a href="{{ route('login') }}"class="blue-text ml-1">Prihlásenie</a>
                            </p>
                        </div>

                    </div>

                </section>




            </div>



        </div>
    </div>
</div>
@endsection

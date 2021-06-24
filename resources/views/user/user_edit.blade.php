@extends('layouts.app')

@section('title', $user->name)

@section('content')
<div class="container">
    <div class="justify-content-center" >

        <!-- Card -->
        <div class="card my-5 hoverable p-5">
            <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                @csrf
                    <!-- First row -->
                    <div class="row">
                        @if($user->avatar())
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-11">
                                        <img class="rounded mx-auto d-block" style="max-width:100%" src="{{ $user->avatar() }}" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 ">
                        @else
                            <div class="col-lg-12 ">
                        @endif
                            <div class="row">
                                <div class="col-md">
                                    <div class="md-form">
                                        <input type="text" value="{{ $user->email }}" id="email" class="form-control" disabled>
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                            </div>

                            <div class="md-form">
                                <input type="text" name="name" value="{{ $user->name }}" id="name" class="form-control">
                                <label for="name">Meno</label>

                            </div>

                            <div class="md-form">
                                <input type="tel" name="phone" value="{{ $user->phone }}" id="phone" class="form-control" pattern="\d{10}|[\+]\d{12}|00\d{12}">
                                <label for="phone">Telefón</label>
                            </div>

                        </div>
                    </div>
                    <!-- First row -->

                    <div class="">
                            <div class="text-center file-field">

                                    <div class="row">
                                    @if($user->avatar())
                                        <div class="col-md-4 pt-4">
                                            <a href="{{ route('user.avatar.delete') }}" type="button" class="btn btn-danger btn-sm">Vymazať fotku</a>

                                            <div class="btn btn-success btn-sm">
                                                <span>Nahrať fotku</span>
                                                <input type="file" name="avatar">
                                            </div>
                                        </div>

                                        <div class="col-md file-path-wrapper md-form">
                                    @else
                                        <div class="col-md-auto pt-4">
                                                <div class="btn btn-success btn-sm">
                                                    <span>Nahrať fotku</span>
                                                    <input type="file" name="avatar">
                                                </div>
                                        </div>
                                        <div class="col-md file-path-wrapper md-form">


                                    @endif

                                            <input class="file-path" id="avatar-filename" type="text" placeholder="Názov súboru" disabled>
                                        </div>
                                </div>
                            </div>
                        </div>

                    <div class="row">

                    <!-- First column -->
                        <div class="col-md-12">
                            <div class="md-form mb-0">
                            <textarea type="text" id="bio" name="bio" class="md-textarea form-control" rows="8">{{ $user->bio }}</textarea>
                            <label for="bio" class="">About me</label>
                            </div>
                        </div>

                    <!-- Third row -->



                    <div class="row">
                    <div class="col-md-12 text-center my-4">
                        <span class="waves-input-wrapper waves-effect waves-light"><input type="submit" value="Update Account" class="btn btn-info btn-rounded"></span>
                    </div>
                    </div>
                    <!-- Fourth row -->


                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach


            </form>
        </div>
        <!-- Card -->

    </div>
</div>
@endsection

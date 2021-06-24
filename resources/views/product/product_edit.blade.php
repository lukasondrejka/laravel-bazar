@extends('layouts.app')

@section('title', $product->title ?? "Nový inzarát")

@section('content')
<div class="container">
    <div class="justify-content-center" >

        <!-- Card -->
        <div class="card my-5 p-5 hoverable">

            <!-- Form -->
            @if($product->id)
                <form method="POST" id="form" action="{{ route('product.update', ['id' => $product->id]) }}" >
            @else
                <form method="POST" id="form" action="{{ route('product.store') }}">
            @endif
                @csrf


                <div class="row">
                    <div class="col-12 text-center text-md-left">
                        <div class="md-form form-lg">
                            <input type="text" name="title" id="title" class="form-control form-control-lg" value="{{ old('title', $product->title) }}">
                            <label for="title">Názov inzerátu</label>
                            @error('title')
                            <small class="form-text text-danger mb-4">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-2 text-center text-md-left">
                        <div class="md-form">
                            <select class="mdb-select" id="type" name="type">
                                <option value="" {{ (old('type', $product->type) == '') ? 'selected' : ''}} disabled >Typ inzerátu</option>
                                <option value="ponuka" {{ (old('type', $product->type) == 'ponuka') ? 'selected' : ''}} >ponuka</option>
                                <option value="dopyt" {{ (old('type', $product->type) == 'dopyt') ? 'selected' : ''}} >dopyt</option>
                            </select>
                            @error('type')
                            <small class="form-text text-danger mb-4">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-2 text-center text-md-left">

                        <select class="mdb-select md-form" id="category" name="category_id">

                            <option value="" {{ (old('category_id', $product->category_id) == '') ? 'selected' : ''}} disabled >Kategoria</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : ''}} >
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                        @error('category_id')
                        <small class="form-text text-danger mb-4">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-center text-md-left">
                        <div class="md-form">
                            <textarea id="description" name="description" class="md-textarea form-control" rows="10">{{ old('description', $product->description) }}</textarea>
                            <label for="description">Popis</label>
                            @error('description')
                            <small class="form-text text-danger mb-4">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 text-center text-md-left">
                        <div class="md-form form-lg">
                            <input type="text" name="price" id="price" class="form-control form-control-lg" value="{{ old('price', $product->price) }}">
                            <label for="price">Cena</label>
                            @error('price')
                            <small class="form-text text-danger mb-4">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div id="hidden-inputs-area" class="d-none"></div>
            </form>
            <!-- Form -->

            <!-- Dropzone -->
            <div class="dropzone-area my-4 m-0">
                <form method="get" action="{{ route('product.image.store')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                    @csrf
                </form>
            </div>
            <!-- Dropzone -->

            <!-- Submit Button -->
            <div class="submit-btn-area">
                <div class="col"></div>
                <div class="col-auto text-center text-md-left text-md-right mt-3" >
                    <button type="submit" id="form-submit" class="btn btn-success btn-rounded waves-effect waves-light">
                        Uložiť
                    </button>
                </div>
            </div>
            <!-- Submit Button -->

        </div>
        <!-- Card -->

        <!-- Scripts -->
        @push('scripts')

            <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>

            <script type="text/javascript">
                Dropzone.autoDiscover = false;

                var cover_img = {{  $product->cover_product_image_id ?? 'null' }};

                var images = {{ json_encode($product->images->pluck('id')->toArray() ?? []) }};

                var dropzone = new Dropzone("#dropzone",{
                    maxFilesize: 12, //MB
                    parallelUploads: 1,
                    maxFiles: 6,
                    acceptedFiles: '.jpeg,.jpg,.png,.gig',
                    addRemoveLinks: true,
                    timeout: 60000,

                    success: function(file, response) {
                        file.id = response.id;
                        $(file.previewElement).attr("img-id", file.id);

                        images.push(file.id);

                        if (file.previewElement) {
                            return file.previewElement.classList.add("dz-success");
                        }
                    },

                    renameFile: function(file) {
                        var dt = new Date();
                        var time = dt.getTime();
                        return time + file.name;
                    },

                    removedfile: function(file) {
                        var id = file.id;

                        if ( $(file.previewElement).hasClass("dz-success") ) {
                            $.ajax({
                                type: 'POST',
                                url: '{{ route("product.image.destroy") }}',
                                data: {
                                    id: id,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function (data) {},
                                error: function(e) {
                                    console.log(e);
                                },
                            });
                        } else {
                            dropzone.options.maxFiles++;
                        }

                        images = images.filter(function(images) {
                            return images !== id;
                        });

                        if (id == cover_img){
                            cover_img = null;
                        }

                        var fileRef;
                        return (fileRef = file.previewElement) != null ? fileRef.parentNode.removeChild(file.previewElement) : void 0;
                    },

                    previewTemplate: `
                        <div class="dz-preview dz-file-preview">
                            <div class="dz-image  card">
                                <img data-dz-thumbnail />
                            </div>
                            <div class="dz-details d-none">
                                <span class="dz-name" data-dz-name></span>
                            </div>
                            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                            <div class="dz-success-mark">
                                <i class="fas fa-check-circle" style="font-size: 54px;"></i>
                            </div>
                        </div>
                    `,
                });


                @foreach ($product->images as $image)
                    var f = { id: {{ $image->id }}, name: "{{ $image->id }}", size: 0 };
                    dropzone.emit("addedfile", f);
                    dropzone.emit("thumbnail", f, "{{ $image->url_small }}");
                    dropzone.emit("complete", f);
                    $(".dz-preview:last-child").attr('img-id', {{ $image->id }});
                @endforeach

                dropzone.options.maxFiles = dropzone.options.maxFiles - {{ $product->images->count() }};


                var old_cover_img;
                $(function() {

                    if(cover_img){
                        $('.dz-preview[img-id=' + cover_img + ']').find('.dz-image').addClass("dz-selected");
                    }

                    $(document).delegate('.dz-image', 'click', function() {
                        old_cover_img = cover_img;
                        cover_img = $(this).parent().attr('img-id') ;

                        $('.dz-preview[img-id=' + old_cover_img + ']').find('.dz-image').removeClass("dz-selected");
                        $('.dz-preview[img-id=' + cover_img + ']').find('.dz-image').addClass("dz-selected");
                    });


                    $("#form-submit").click(function() {
                        $('#hidden-inputs-area').append('<input type="hidden" name="cover_image" value="' + (cover_img ? cover_img : '') + '">')

                        images.forEach(image_id => {
                            $('#hidden-inputs-area').append('<input type="hidden" name="product_images[]" value="' + image_id +'">')
                        });

                        $("#form").submit();
                    });

                });
            </script>

        @endpush
        <!-- Scripts -->

    </div>
</div>
@endsection

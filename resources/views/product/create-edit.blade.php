@extends('master')
@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">

                    {{$error}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
        @endif
        @if(isset($product))
            <form method="post" enctype="multipart/form-data" id="form"
                  action="{{route('product.update',$product->id)}}">
                @method('put')
                @else
                    <form method="post" enctype="multipart/form-data" id="form" action="{{route('product.store')}}">
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <h2>Termék hozzáadása</h2>
                                {{-- Termék neve--}}

                                <h5>Termék neve</h5>
                                <div class="form-group ">
                                    <input type="text" name="name" class="form-control col-12" id="name"
                                           placeholder="Termék neve" required value="{{$product->name ?? ''}}">
                                </div>

                                {{-- Leírás --}}
                                <h5>Leírás</h5>
                                <div class="form-group ">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab"
                                               href="#description_hu"
                                               role="tab" aria-controls="description_hu" aria-selected="true">Magyar</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab"
                                               href="#description_en" role="tab"
                                               aria-controls="description_en" aria-selected="false">Angol</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab"
                                               href="#description_de" role="tab"
                                               aria-controls="description_de" aria-selected="false">Német</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="description_hu" role="tabpanel"
                                         aria-labelledby="home-tab">
                                        <textarea name="lang[1]" id="hu" cols="70" rows="5"
                                                  placeholder="">{{$description['hu'] ?? ""}}</textarea>
                                    </div>
                                    <div class="tab-pane fade" id="description_en" role="tabpanel"
                                         aria-labelledby="profile-tab">
                                        <textarea name="lang[2]" id="en" cols="70"
                                                  rows="5">{{$description['en'] ?? ""}}</textarea>
                                    </div>
                                    <div class="tab-pane fade" id="description_de" role="tabpanel"
                                         aria-labelledby="contact-tab">
                                        <textarea name="lang[3]" id="de" cols="70"
                                                  rows="5">{{$description['de'] ?? ""}}</textarea>
                                    </div>
                                </div>

                                {{-- Termék címkék--}}

                                <h5>Termék címkék</h5>
                                <div class="form-group">
                                    @foreach($tags ?? '' as $tag)
                                        <div class="form-check">
                                            <input class="form-check-input" name="tags[{{$tag->id}}]" type="checkbox"
                                                   id="{{$tag->code}}" {{ isset($product_tags[$tag->id]) ? "checked" : "" }} value="{{$tag->id}}" >
                                            <label class="form-check-label" for="{{$tag->code}}">
                                                {{$tag->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Kép feltöltése --}}

                                <h5>Kép feltöltése</h5>
                                <div class="form-group custom-file">
                                    {{--TODO inputEmail4 etc cserre--}}
                                    <input type="file" name="image" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="customFile">Válasszon képet</label>
                                    <div class="container  d-flex p-0 mt-2">
                                        @if(isset($product))
                                            <img class="img-fluid" id="preview"
                                                 src="{{url('/uploads')."/".$product->image}}"/>
                                        @else
                                            <img class="img-fluid" id="preview" src="#" hidden/>
                                        @endif
                                    </div>
                                </div>

                                {{-- Publikálás --}}

                                <h5 class="mt-3">Publikálás</h5>
                                <div class="form-group">
                                    <br>
                                    <input class="col-5 datepicker" name="publish_start" type="date" id="publish_start"
                                           value="{{$product->publish_start ?? "" }}"> -
                                    <input class="col-5 datepicker" name="publish_end" type="date" id="publish_end"
                                           value="{{$product->publish_end ?? "" }}">
                                </div>

                                {{-- Ár --}}

                                <h5>Ár</h5>
                                <div class="form-group input-group">
                                    <div class="form-row">
                                    </div>
                                    <input type="number" name="price" class="form-control col-4 ml-2"
                                           value="{{$product->price ?? ''}}" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"> Ft</span>
                                    </div>
                                </div>

                                {{-- Feltöltés --}}
                                <button type="submit" class="btn btn-primary mt-3">Termék feltöltése</button>
                                @if(isset($product))
                                    <button type="submit" class="btn btn-danger mt-3 delete-button"
                                            data-product="{{$product->id}}" name="delete-product" id="delete">Termék
                                        törlése
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
    </main>
@endsection
@section('additional-scripts')
    @if($product ?? "")
        @include('assets.js.delete-ajax')
    @endif
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function () {
            $("#preview").removeAttr('hidden');
            readURL(this);
        });
    </script>
@endsection

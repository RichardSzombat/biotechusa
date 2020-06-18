@extends('master')
@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

        <form>
            <div class="row">
                <div class="col-6">
                    <h2>Termék hozzáadása</h2>
                    {{-- Termék neve--}}

                    <h5>Termék neve</h5>
                    <div class="form-group ">
                        <input type="text" class="form-control col-12" id="name" placeholder="Termék neve">
                    </div>

                    {{-- Leírás --}}
                    <h5>Leírás</h5>
                    <div class="form-group ">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#description_hu"
                                   role="tab" aria-controls="description_hu" aria-selected="true">Magyar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#description_en" role="tab"
                                   aria-controls="description_en" aria-selected="false">Angol</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#description_de" role="tab"
                                   aria-controls="description_de" aria-selected="false">Német</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        {{--TODO insert data if we have--}}
                        <div class="tab-pane fade show active" id="description_hu" role="tabpanel"
                             aria-labelledby="home-tab">
                            <textarea name="hu" id="hu" cols="70" rows="5" placeholder=""></textarea>
                        </div>
                        <div class="tab-pane fade" id="description_en" role="tabpanel" aria-labelledby="profile-tab">
                            <textarea name="en" id="en" cols="70" rows="5"></textarea>
                        </div>
                        <div class="tab-pane fade" id="description_de" role="tabpanel" aria-labelledby="contact-tab">
                            <textarea name="de" id="de" cols="70" rows="5"></textarea>
                        </div>
                    </div>

                    {{-- Termék címkék--}}

                    <h5>Termék címkék</h5>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" name="protein" type="checkbox" id="protein">
                            <label class="form-check-label" for="protein">
                                Fehérje
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="fatburner" type="checkbox" id="fatburner">
                            <label class="form-check-label" for="fatburner">
                                Zsírégető
                            </label>
                        </div>
                    </div>

                    {{-- Kép feltöltése --}}

                    <h5>Kép feltöltése</h5>
                    <div class="form-group custom-file">
                        {{--TODO inputEmail4 etc cserre--}}
                        <input type="file" name="image" class="custom-file-input" id="image">
                        <label class="custom-file-label" for="customFile">Válasszon képet</label>
                    </div>

                    {{-- Publikálás --}}

                    <h5 class="mt-3">Publikálás</h5>
                    <div class="form-group">
                        <br>
                        <input class="col-3 datepicker" name="publish_start" type="text" id="datepicker"> -
                        <input class="col-3 datepicker" name="publish_end" type="text" id="datepicker2">
                    </div>

                    {{-- Ár --}}

                    <h5>Ár</h5>
                    <div class="form-group input-group">
                        <div class="form-row">
                        </div>
                        <input type="number" name="price" class="form-control col-4 ml-2">
                        <div class="input-group-append">
                            <span class="input-group-text"> Ft</span>
                        </div>
                    </div>

                    {{-- Feltöltés --}}
                    <button type="submit" class="btn btn-primary mt-3">Termék feltöltése</button>
                </div>
            </div>
        </form>
    </main>
@endsection

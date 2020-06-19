@extends('master')
@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <h2>Összes termék</h2>
        <div class="table-responsive">
            <table class="table all-product table-striped table-sm">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Termék</th>
                    <th>Ár (Ft)</th>
                    <th>Szerkesztés</th>
                    <th>Törlés</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td><a href="{{route('product.edit',$product->id)}}"> <button type="button" class="btn btn-primary btn-sm " name="edit-product" data-product="{{$product->id}}">Szerkesztés</button></a></td>
                    <td> <button type="button" class="btn btn-danger btn-sm delete-button" name="delete-product" data-product="{{$product->id}}" id="delete"  >Törlés</button> </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </main>

@endsection
@section('additional-scripts')
    @include('assets.js.delete-ajax')

@endsection

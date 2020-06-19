@extends('master')
@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <h2>Összes termék</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Termék</th>
                    <th>Leírás</th>
                    <th>Szerkesztés</th>
                    <th>Törlés</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{$product->product_id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->text}}</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </main>

@endsection

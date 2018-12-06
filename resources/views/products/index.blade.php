@extends('layouts.master')


@section('content')
    <div class="ht-top offset-md-4 col-md-3">
    <table class="table table-hover table-dark">
        <thead>
            <tr>
                <td>
                    Products
                </td>
                <td>
                    <a href="{{route('product.create')}}" class="btn btn-primary btn-sm"><i class="material-icons">person_add</i>Product</a>
                </td>
            </tr>
            <tr>
                <th scope="col">#</th>
                <th hidden></th>
                <th scope="col">Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key=>$product)
            <tr>
            <th scope="row">{{$key+1}}</th>
            <td hidden>{{$product->id}}</td>
            <td><a href="product/{{$product->id}}">{{$product->name}}</a></td>
            </tr>
            @endforeach
        
          </tbody>
    </table>
    {{ $products->links() }}
    </div>
@endsection
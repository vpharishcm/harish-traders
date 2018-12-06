@extends('layouts.master')


@section('content')
    <div class="ht-top offset-md-4 col-md-3" >
    <table class="table table-hover table-dark">
        <thead>
            <tr>
                <td>
                    Suppliers
                </td>
                <td>
                    <a href="{{route('supplier.create')}}" class="btn btn-primary btn-sm"><i class="material-icons">person_add</i>Supplier</a>
                </td>
            </tr>
            <tr>
                <th scope="col">S.no</th>
                <th hidden></th>
                <th scope="col">Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $key=>$supplier)
            <tr>
            <th scope="row">{{$key+1}}</th>
            <td hidden>{{$supplier->id}}</td>
            <td><a href="supplier/{{$supplier->id}}">{{$supplier->name}}</a></td>
            </tr>
            @endforeach
        
          </tbody>
    </table>
    {{ $suppliers->links() }}
    </div>
@endsection
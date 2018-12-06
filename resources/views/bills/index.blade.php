@extends('layouts.master')


@section('content')
    <div class="ht-top offset-md-4 col-md-4">
    <table class="table table-hover table-dark">
        <thead>
            <tr>
                <td colspan="2">
                    Bills
                </td>
                <td>
                    <a href="{{route('bill.create')}}" class="btn btn-primary btn-sm"><i class="material-icons">add</i>Bill</a>
                </td>
            </tr> 
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Date</th>
                <th scope="col">Supplier</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bills as $key=>$bill)
            <tr>
            <th scope="row">{{$key+1}}</th>
            <td hidden>{{$bill->id}}</td>
            <td><a href="/bill/{{$bill->id}}">{{$bill->d_date}}</a></td>
            <td><a href="/supplier/{{$bill->supplier_id}}">{{$bill->supplier->name}}</td>
            </tr>
            @endforeach
        
          </tbody>
    </table>
    {{ $bills->links() }}
    </div>
@endsection
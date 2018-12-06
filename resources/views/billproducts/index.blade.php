@extends('layouts.master')


@section('content')
    <div class="ht-top">
    <table class="table table-hover table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th hidden></th>
                <th scope="col">Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expences as $key=>$expence)
            <tr>
            <th scope="row">{{$key+1}}</th>
            <td hidden>{{$expence->id}}</td>
            <td><a href="expence/{{$expence->id}}">{{$expence->name}}</a></td>
            </tr>
            @endforeach
        
          </tbody>
    </table>
    {{ $expences->links() }}
    </div>
@endsection
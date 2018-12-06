@extends('layouts.master')

@section('content')
<div class="card ht-top col-lg-8 col-md-8  ">
        <div class="card-header ht-bg-primary ">
            <h3 class="card-title text-center">
                expence Detiles
            </h3>
            
        </div>
        <div class="card-body">
            <h4>Name:</h4>{{$expence->name}}<br>
            
            
            <div class="row">
                    <form action="/expence/{{$expence->id}}/edit" method="get">
                        <button type="submit" class="btn btn-warning pull-right">Edit</button>
                    </form>
                    &nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#deleteexpence" id="delete">Delete</button>
            </div>
        </div>
        
    </div>
    <div class="modal fade" id="deleteexpence" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">Delete expence</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
        <form action="/expence/{{$expence->id}}" method="POST">
            @csrf
            <input type="hidden" value="DELETE" name="_method">
            <button class="btn btn-danger" >Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

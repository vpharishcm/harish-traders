@extends('layouts.master')

@section('content')
<div class="card ht-top col-lg-8 col-md-8  ">
        <div class="card-header ht-bg-primary ">
            <h3 class="card-title text-center">
                supplier Detiles
            </h3>
            
        </div>
        <div class="card-body">
            <h4>Name:</h4>{{$supplier->name}}<br>
            <h4>Place:</h4>{{$supplier->place}}<br>
            
            <div class="row">
                    <form action="/supplier/{{$supplier->id}}/edit" method="get">
                        <button type="submit" class="btn btn-warning pull-right">Edit</button>
                    </form>
                    &nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#deletesupplier" id="delete">Delete</button>
            </div>
        </div>
        <table class="table table-striped table-dark">
          <thead>
            <tr>
              <th scope="col">S.No</th>
              <th scope="col">Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($supplier->bill as $key=>$bill)
              <tr>
                <td>
                  {{$key+1}}
                </td>
                <td>
                  <a href="\bill\{{$bill->id}}">{{$bill->bill_date}}</a>
                </td>
              </tr>
            @endforeach
            
          </tbody>
        </table>
    </div>

    <div class="modal fade" id="deletesupplier" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">Delete supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            Are you sure you want to delete?
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
        <form action="/supplier/{{$supplier->id}}" method="POST">
            @csrf
            <input type="hidden" value="DELETE" name="_method">
            <button class="btn btn-danger" >Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

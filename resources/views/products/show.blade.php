@extends('layouts.master')

@section('content')
<div class="card ht-top offset-md-2  col-lg-8 col-md-8  ">
    
          <div class="card-header ht-bg-primary ">
              <h3 class="card-title text-center">
                  Product Detiles
              </h3>
              
          </div>
          <div class="card-body">
              <h4>Name:</h4>{{$product->name}}<br>
              @if($product->image!="")
                  <img src="{{$product->url}}">
              @endif
              <br />
              <div class="row">
                      <form action="/product/{{$product->id}}/edit" method="get">
                          <button type="submit" class="btn btn-warning pull-right">Edit</button>
                      </form>
                      &nbsp;&nbsp;&nbsp;
                      <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#deleteProduct" id="delete">Delete</button>
              </div>
          </div>
        
          <table class="table table-striped table-dark">
            <thead>
              <tr>
                <th scope="col">S.No</th>
                <th scope="col">Date</th>
                <th scope="col">Supplier</th>
                <th scope="col">Quantity</th>
                <th scope="col">price</th>
                
              </tr>
            </thead>
            <tbody>
              
              @foreach ($bill as $key=>$billProduct)
                <tr>
                  <td>
                    {{$key+1}}
                  </td>
                  <td>
                      <a href="\bill\{{$billProduct->bill_id}}"> {{$billProduct->bill_date}} </a>
                  </td>
                  <td>
                      <a href="\supplier\{{$billProduct->supplier->id}}"> {{$billProduct->supplier->name}} </a>
                      
                  </td>
                  <td>
                      {{$billProduct->quantity}}
                  </td>
                  <td>
                      {{$billProduct->price}}
                  </td>
                </tr>
              @endforeach 
              
            </tbody>
          </table>
        <div >
          {!! $chart->container() !!}
        </div>
    

    </div>
    <div class="modal fade" id="deleteProduct" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">Delete Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
        <form action="/product/{{$product->id}}" method="POST">
            @csrf
            <input type="hidden" value="DELETE" name="_method">
            <button class="btn btn-danger" >Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $chart->script() !!}
@endpus

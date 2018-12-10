@extends('layouts.master')

@section('content')
<div class="card ht-top col-md-10 col-lg-10">
  <div class="card-header ht-bg-primary ">
    <div class="row">
      <div class="col col-md-6 col-lg-6">
        <h3 class="card-title text-center">
          bill Detiles
        </h3>
      </div>
      <div class="col col-md-6 col col-lg-6 text-right">
        <button class="btn btn-warning pull-right" data-toggle="modal" data-target="#editbill" id="edit">Edit</button>
        &nbsp;&nbsp;&nbsp;
        <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#deletebill" id="delete">Delete</button>
      </div>
    </div>
  </div>
  <div class="card-body">
    <h4>Supplier Name:<a href="\supplier\{{$bills['bill']->supplier_id}}"> {{$bills['bill']->supplier->name}}</a></h4><br>
    <h4>Bill Date:{{$bills['bill']->d_date}}</h4><br>
      @if($bills['bill']->bill_status==0)
        <h4>Supplier Status:Without</h4><br>
      @else
        <h4>Supplier Status:Billed</h4><br>
      @endif
      {{--table for products--}}
      <table class="table table-striped table-dark" id="productstable">
          <thead>
            <tr >
              <td colspan="6" class="text-center">
                <h3>Products</h3>
              </td>
              <td>
              <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#addproduct"><i class="fas fa-plus"></i> Add Products </button>
              <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#creatrporduct"><i class="fas fa-plus"></i> Create New Products </button>
              </td>
            </tr>
            <tr>
              <th scope="col">S.no</th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Quantity</th>
              <th scope="col">Price</th>
              <th scope="col">Amount</th>
              <th scope="col">Action</th>

            </tr>
          </thead>
          <tbody>
            <?php $productTotal=0; ?>
            @foreach($bills['bill']->products as $key=>$billProduct)
              
                <tr id="{{$billProduct->id}}">
                  <th scope="row" >{{$key+1}}</th>
                  <td><a href="\product\{{$billProduct->product_id}}"> {{$billProduct->product->name}}</a><p hidden> </p></td>
                  <td>{{$billProduct->description}}</td>
                  <td>{{$billProduct->quantity}}</td>
                  <td>{{$billProduct->price}}</td>
                  <td>{{$billProduct->quantity*$billProduct->price}} </td>
                  <td><button class="btn btn-warning btn-sm " data-id="{{$key+1}}" data-toggle="modal"  data-target="#editproduct"><i class="fas fa-edit"></i></button>/<button class="btn btn-danger btn-sm " data-toggle="modal" data-id="{{$key+1}}" data-target="#deleteproduct"><i class="fas fa-trash-alt"></i></button> </td>
                </tr>
                <?php $productTotal=$productTotal+($billProduct->quantity*$billProduct->price);?>
            @endforeach
          </tbody>
          <tfoot>
                <tr>
                  <td colspan="5" class="text-right">
                    Total
                  </td>
                  <td>
                    {{$productTotal}}
                  </td>
                  <td>

                  </td>
                </tr>
                <?php $expenceTotal=0; ?>
                <?php $k=$key+3; ?>
            @foreach ($bills['bill']->expences as $key=>$billexpence)
              <tr id="{{$billexpence->id}}">
                  <td colspan="5" class="text-right">{{$billexpence->expence->name}}</td>
                  <td>{{$billexpence->amount}}</td>
                  <td><button class="btn btn-warning btn-sm " data-id="{{$k}}" data-toggle="modal"  data-target="#editexpence"><i class="fas fa-edit"></i></button>/<button class="btn btn-danger btn-sm " data-toggle="modal" data-id="{{$k++}}" data-target="#deleteexpence"><i class="fas fa-trash-alt"></i></button>  </td>
                </tr>
                <?php $expenceTotal=$expenceTotal+$billexpence->amount; ?>
            @endforeach
             <tr>
                  <td colspan="5" class="text-right">
                    Total Expence
                  </td>
                  <td>
                    {{$expenceTotal}}
                  </td>
                  <td>
                    <button class="btn btn-primary pull-right addexpences" data-toggle="modal" data-target="#addexpence"><i class="fas fa-plus"></i> Add Expences </button>
                    <button class="btn btn-primary pull-right addexpences" data-toggle="modal" data-target="#createexpence"><i class="fas fa-plus"></i> Add new Expences </button>
                  </td>
                </tr>
                <tr>
                  <td colspan="5" class="text-right">
                    Grand Total
                  </td>
                  <td>
                    {{$productTotal+$expenceTotal}}
                  </td>
                </tr>

          </tfoot>
        </table>
               
          </tfoot>
        </table>
  </div>
</div>
{{--  bill modals  --}}
<div class="modal fade" id="deletebill" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLongTitle">Delete bill</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Are you sure you want to delete?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
          <form action="/bill/{{$bills['bill']->id}}" method="POST">
            @csrf
            <input type="hidden" value="DELETE" name="_method">
            <button class="btn btn-danger" >Yes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

{{--  products modals --}}
<div class="modal fade" id="addproduct" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">Add product to bill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ui-front">
          @include('billproducts.createForm');
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editproduct" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">edit product to bill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ui-front">
          @include('billproducts.updateForm')
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteproduct" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLongTitle">Delete bill</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Are you sure you want to delete this product row?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
          <form  method="POST">
            @csrf
            <input type="hidden" value="DELETE" name="_method">
            <input type="hidden" name="id" id="id">
            <button class="btn btn-danger" >Yes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{--  expence modals --}}
<div class="modal fade" id="addexpence" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">Add product to bill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ui-front">
          @include('billexpences.createForm');
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editexpence" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">edit product to bill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ui-front">
          @include('billexpences.updateForm')
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteexpence" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLongTitle">Delete bill</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Are you sure you want to delete this product row?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
          <form  method="POST">
            @csrf
            <input type="hidden" value="DELETE" name="_method">
            <input type="hidden" name="id" id="id">
            <button class="btn btn-danger" >Yes</button>
          </form>
        </div>
      </div>
    </div>
  </div>


 <div class="modal fade" id="creatrporduct" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">Create New Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ui-front">
          @include('products.createForm')
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="createexpence" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">Create New Expences</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ui-front">
          @include('expences.createForm')
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editbill" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">Edit Bill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ui-front">
          @include('bills.updateForm')
      </div>
    </div>
  </div>
</div>

@endsection
@push('script')
{{--  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>  --}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
      {{--  edit Product modal  --}}
        $('#editproduct').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          
          var r_id = button.data('id'); // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var row=$('#productstable tr').eq(r_id+1);
          var tableData = $(row).children("td").map(function() {
                           return $(this).text();
                          }).get();
          var modal = $(this);
          var id=$(row).attr("id");
          $('#editproduct form').attr('action', '\\billproduct\\'+id);
          modal.find('.modal-body #product_name').val(tableData[0]);
          modal.find('.modal-body #id').val(id);
          modal.find('.modal-body #description').val(tableData[1]);

          modal.find('.modal-body #quantity').val(tableData[2]);
          modal.find('.modal-body #price').val(tableData[3]);
        });
        {{--  Delete product Modal   --}}
        $('#deleteproduct').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          
          var r_id = button.data('id'); // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var row=$('#productstable tr').eq(r_id+1);
          var tableData = $(row).children("td").map(function() {
                           return $(this).text();
                          }).get();
          var modal = $(this);
          var id=$(row).attr("id");
          $('#deleteproduct form').attr('action', '\\billproduct\\'+id);
          modal.find('.modal-footer #id').val(id);
          });
          {{--  Edit Expences modal  --}}
          $('#editexpence').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          
          var r_id = button.data('id'); // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var row=$('#productstable tr').eq(r_id+1);
          var tableData = $(row).children("td").map(function() {
                           return $(this).text();
                          }).get();
          var modal = $(this);
           var id=$(row).attr("id");
          $('#editexpence form').attr('action', '\\billexpence\\'+id);
          modal.find('.modal-body #expence_name').val(tableData[0]);
          modal.find('.modal-body #id').val(id);
          modal.find('.modal-body #expenceamount').val(tableData[1]);
        });
        {{--  Delete Expence  --}}
        $('#deleteexpence').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          
          var r_id = button.data('id'); // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var row=$('#productstable tr').eq(r_id+1);
          var tableData = $(row).children("td").map(function() {
                           return $(this).text();
                          }).get();
          var modal = $(this);
           var id=$(row).attr("id");
          $('#deleteexpence form').attr('action', '\\billexpence\\'+id);
          modal.find('.modal-footer #id').val(id);
          });
          
          $('#editbill').on('show.bs.modal', function (event){ 
          var modal = $(this);
           
          $('#editbill form').attr('action', '\\bill\\'+{{$bills['bill']->id}});
          modal.find('.modal-body #supplier').val("{{$bills['bill']->supplier->name}}");
          modal.find(".modal-body #dateofbill" ).datepicker({dateFormat: "dd-mm-y"});
          modal.find('.modal-body #dateofbill').val("{{$bills['bill']->bill_date}}");
          if({{$bills['bill']->bill_status}}==0){
            modal.find('.modal-body #status #1').attr('selected', 'selected');
          }else{
            modal.find('.modal-body #status #2').attr('selected', 'selected');
          }
          
        });

      var products=[
    @foreach ($bills['products'] as $product)
        {
        id:{{$product->id}},
        value:"{{$product->name}}"
        },
    @endforeach];
    $('#product').autocomplete({
        source:products,
        
        {{-- function(request,response){
            response($.map(products,function(item){
                return{
                    id:item.id,
                    value:item.value
                }
            }))
        }, --}}
        select:function(event,ui){
            $(this).val(ui.item.value)
            $('#product_id').val(ui.item.id);
        },
        minLength:0,
        autoFocus:true,
      });


      var expences=[
    @foreach ($bills['expences'] as $expence)
        {
        id:{{$expence->id}},
        value:"{{$expence->name}}"
        },
    @endforeach];
    $('#expence').autocomplete({
        source:expences,
        
        {{-- function(request,response){
            response($.map(expences,function(item){
                return{
                    id:item.id,
                    value:item.value
                }
            }))
        }, --}}
        select:function(event,ui){
            $(this).val(ui.item.value)
            $('#expence_id').val(ui.item.id);
        },
        minLength:0,
        autoFocus:true,
      });
      
    var suppliers=[
    @foreach ($bills['suppliers'] as $supplier)
        {
        id:{{$supplier->id}},
        value:"{{$supplier->name}}"
        },
    @endforeach];
    $('#supplier').autocomplete({
        source:suppliers,
        
        {{-- function(request,response){
            response($.map(suppliers,function(item){
                return{
                    id:item.id,
                    value:item.value
                }
            }))
        }, --}}
        select:function(event,ui){
            $(this).val(ui.item.value)
            $('#supplier_id').val(ui.item.id);
        },
        minLength:0,
        autoFocus:true,
      });
      $("#dateofbill").css({"z-index":"2147483647"} );
    </script>
@endpush
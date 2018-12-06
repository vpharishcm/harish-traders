
<div class="card ht-top offset-lg-2 offset-md-2 col-lg-8 col-md-8  ">
    <div class="card-header ht-bg-primary text-center">
        <h3 class="card-title">
            Add new Bill
        </h3>
    </div>
    <div class="card-body">
        <form action={{route('bill.store')}} method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-6 col-lg-6">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="Name">Name</label><input id="supplier" >
                            <input type="hidden" id="supplier_id" name="supplier_id">
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addsupplier" id="newSupplierBtn" type="button">Create New Supplier</button>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6 col-lg-6">
                    <label for="date">date</label>
                    <input id="dateofbill" name="bill_date" >
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 col-lg-6">
                    <label for="status">Name</label>
                    <select name="status">
                        <option value="without">Without</option>
                        <option value="billed">Billed</option>
                    </select>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary ">Submit</button>
        </form>
    </div>
    
</div>
<div class="modal fade" id="addsupplier" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">Create New Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ui-front">
          @include('suppliers.createForm');
      </div>
    </div>
  </div>
</div>

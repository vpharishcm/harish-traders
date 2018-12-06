
<div class="card col-lg-8 col-md-8  ">
    <div class="card-header ht-bg-primary text-center">
        <h3 class="card-title">
            Add expence to bill
        </h3>
    </div>
    <div class="card-body">
        <form action={{route('billexpence.store')}} method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="Name">Expence Name</label>
                <input class="form-control" id="expence" autocomplete="off" required>
                <input type="hidden" id="expence_id" name="expence_id">
                <input type="hidden" name="bill_id" value="{{$bills['bill']->id}}">
            </div>
            <div class="form-group">
                <label for="price">amount</label>
                <input type="text" class="form-control" name="amount" required>
            </div>
            <button type="submit" class="btn btn-primary ">Submit</button>
        </form>
    </div>
    
</div>

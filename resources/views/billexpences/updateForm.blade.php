
<div class="card col-lg-8 col-md-8  ">
        <div class="card-header ht-bg-primary text-center">
            <h3 class="card-title">
                Update expence
            </h3> 
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" id="">
                @csrf
                <input type="hidden" value="PUT" name="_method">
                <div class="form-group">
                    <label for="Name">Expence Name</label>
                    <input class="form-control" id="expence_name" autocomplete="off" required>
                    <input type="hidden" id="expence_id" name="expence_id">
                    <input type="hidden" name="bill_id" value="{{$bills['bill']->id}}">
                    <input type="hidden" name="id" id="id">
                </div>
                <div class="form-group">
                    <label for="price">amount</label>
                    <input type="text" class="form-control" name="amount" id='expenceamount' required>
                </div>
                <button type="submit" class="btn btn-primary  ">Update</button>
                
            </form>
        </div>
    </div>
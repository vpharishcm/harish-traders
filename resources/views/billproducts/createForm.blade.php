
<div class="card col-lg-8 col-md-8  ">
    <div class="card-header ht-bg-primary text-center">
        <h3 class="card-title">
            Add Product to bill
        </h3>
    </div>
    <div class="card-body">
        <form action={{route('billproduct.store')}} method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="Name">Product Name</label>
                <input class="form-control" id="product" autocomplete="off" required>
                <input type="hidden" id="product_id" name="product_id">
                <input type="hidden" name="bill_id" value="{{$bills['bill']->id}}">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="text" class="form-control" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" name="price" required>
            </div>
            <button type="submit" class="btn btn-primary ">Submit</button>
        </form>
    </div>
    
</div>

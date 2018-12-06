
<div class="card col-lg-8 col-md-8  ">
        <div class="card-header ht-bg-primary text-center">
            <h3 class="card-title">
                Update expence
            </h3>
        </div>
        <div class="card-body">
            <form  method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="PUT" name="_method">
                <div class="form-group">
                    <label for="Name">Product Name</label>
                    <input class="form-control" id="product_name" autocomplete="off" required>
                    <input type="hidden" id="product_id" name="product_id">
                    <input type="hidden" name="bill_id" value="{{$bills['bill']->id}}">
                    <input type="hidden" name="id" id="id">

                </div>
                <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="text" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>
                <button type="submit" class="btn btn-primary  ">Update</button>
                
            </form>
        </div>
    </div>
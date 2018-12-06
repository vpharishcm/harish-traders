
<div class="card ht-top col-lg-8 col-md-8  ">
        <div class="card-header ht-bg-primary text-center">
            <h3 class="card-title">
                Update Product
            </h3>
        </div>
        <div class="card-body">
            <form action={{route('product.update',$product->id)}} method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="PUT" name="_method">
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" class="form-control" id="name" name="name"  value="{{$product->name}}"required>
                </div>
                <div class="form-group">
                    <label for="img">image</label>
                    @if($product->image!="")
                        <img src="{{$product->url}}">
                        <input type="file" class="form-control" id="img" name="img">
                    @else
                        <input type="file" class="form-control" id="img" name="img" >
                    @endif
                 </div>
                 <input type="hidden" value="{{$product->id}}" name="id">
                <button type="submit" class="btn btn-primary  ">Update</button>
                
            </form>
        </div>
    </div>
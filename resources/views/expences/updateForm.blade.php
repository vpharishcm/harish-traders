
<div class="card ht-top col-lg-8 col-md-8  ">
        <div class="card-header ht-bg-primary text-center">
            <h3 class="card-title">
                Update expence
            </h3>
        </div>
        <div class="card-body">
            <form action={{route('expence.update',$expence->id)}} method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="PUT" name="_method">
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" class="form-control" id="name" name="name"  value="{{$expence->name}}"required>
                </div>
                
                 <input type="hidden" value="{{$expence->id}}" name="id">
                <button type="submit" class="btn btn-primary  ">Update</button>
                
            </form>
        </div>
    </div>
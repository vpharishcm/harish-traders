
<div class="card col-lg-8 col-md-8  ">
    <div class="card-header ht-bg-primary text-center">
        <h3 class="card-title">
            Add new expence
        </h3>
    </div>
    <div class="card-body">
        <form action={{route('expence.store')}} method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary ">Submit</button>
        </form>
    </div>
    
</div>

<x-agentheader />
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">



          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Top Products</p>
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addproduct">
                        Add New Product
                    </button>
                    <!-- The Modal -->
                    <div class="modal" id="addproduct">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add New Product</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="{{ URL::to('addnewproduct') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label for="">Title</label>
                                    <input type="text" name="title" placeholder="Enter Title" class="form-control mb-2" id="">
                                    <label for="">Price</label>
                                    <input type="text" name="price" placeholder="Enter Price ($)" class="form-control mb-2" id="">
                                    <label for="">Quantity</label>
                                    <input type="text" name="quantity" placeholder="Enter Quantity" class="form-control mb-2" id="">
                                    <label for="">Picture</label>
                                    <input type="file" name="file" class="form-control mb-2" id="">
                                    <label for="">Description</label>
                                    <input type="text" name="description" placeholder="Enter Description" class="form-control mb-2" id="">
                                    <label for="">Category</label>
                                    <select name="category" placeholder="Enter Category" class="form-control mb-2" id="">
                                        <option value="">Select Category</option>
                                        <option value="Grains">Grains</option>
                                        <option value="Liquids">Liquids</option>
                                        <option value="Fruits and vegetables">Fruits and vegetables</option>
                                        <option value="Leaf">Leaf</option>
                                    </select>
                                    <select name="type" placeholder="Enter Type" class="form-control mb-2" id="">
                                        <option value="">Select Type</option>
                                        <option value="Best Sellers">Best Sellers</option>
                                        <option value="new-arrivals">New Arrivals</option>
                                        <option value="sale">Hot Sales</option>
                                    </select>
                                    <input type="submit" name="save" class="btn btn-success" value="Save now" id="">
                                </div>
                            </div>
                        </div>
                    </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Picture</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Category</th>
                          <th>Type</th>
                          <th>Update</th>
                          <th>Delete</th>
                        </tr>  
                      </thead>
                      <tbody>
                        @foreach($products as $item)
                        <tr>
                          <td>{{ $item->title }}</td>
                          <td><img src="{{ URL::asset('uploads/products/'.$item->picture) }}" width="100px" alt=""></td>
                          <td class="font-weight-bold">{{ $item->price }}</td>
                          <td>{{ $item->quantity }}</td>
                          <td class="font-weight-medium">
                            <div class="badge badge-success">{{ $item->category }}</div></td>
                            <td class="font-weight-medium">
                            <div class="badge badge-info">{{ $item->type }}</div></td>
                            <td>
                            <a href="" class="btn btn-success">Update</a>
                            </td>
                            <td>
                                <a href="{{ URL::to('deleteproduct/'.$item->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <x-agentfooter />
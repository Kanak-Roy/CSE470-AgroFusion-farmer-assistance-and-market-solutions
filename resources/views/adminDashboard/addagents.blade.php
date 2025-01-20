<x-adminheader />
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
          
          
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">Top Products</p>
                  <!-- Button to Open the Modal -->
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                    Add New Agent
                  </button>
                <!-- The Modal -->
                <div class="modal" id="myModal">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Add New Agent</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                        <form action="{{URL:: to('addnewagents')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <lable for="">Full Name</lable>
                          <input type="text" name="fullname" placeholder="Enter Full Name" class="form-control mb-2" id="">

                          <lable for="">Email</lable>
                          <input type="email" name="email" placeholder="Enter Email" class="form-control mb-2" id="">

                          <lable for="">Password</lable>
                          <input type="password" name="password" placeholder="Enter Password" class="form-control mb-2" id="">

                          
                          <lable for="">Picture</lable>
                          <input type="file" name="file" class="form-control mb-2" id="">

                          <input type="submit" name="save" class="btn btn-success" value="Save Now" id="">
                        
                        </form>
                      </div>

                      

                    </div>
                  </div>
                </div>


                  </button>

                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          
                          <th>Full Name</th>
                          <th>picture</th>
                          <th>Email</th>
                          <th>Type</th>
                          <th>Registration Date</th>
                          <th>Status</th>
                          
                        </tr>  
                      </thead>
                      <tbody>
                       
                        @foreach ($addagents as $item)
                        

                        <tr>
                            
                            <td>{{ $item->fullname}}</td>
                            <td><img src="{{ URL::asset('uploads/profiles/'.$item->picture) }}" width="100px" alt=""> </td>
                            <td>{{ $item->email}}</td>
                            <td class="font-weight-bold">{{ $item->type}}</td>
                            <td>{{ $item->created_at}}</td>
                            <td class="font-weight-bold">{{ $item->status}}</td>
                            
                            

                          
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
        
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <x-adminfooter />
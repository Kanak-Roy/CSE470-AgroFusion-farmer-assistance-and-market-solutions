<x-adminheader />
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
          
          
          <div class="row">
            <div class="col-md-12 col-md-6 col-lg-4 mx-auto grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">My Profile</p>

                  <div class="contact__form">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            <p> {{ session()->get('success') }} </p>
                        </div>
                    @endif

                    <img src="{{ URL::asset('uploads/profiles/'.$user->picture) }}" class="mx-auto d-block mb-2" width="300px" alt="">
                    <form action="{{ URL::to('updateUser') }}" method ="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="fullname" placeholder="Name" class="form-control mb-2" value=" {{ $user->fullname }}" readonly required>
                            </div>
                            <div class="col-lg-6">
                                <input type="email" name="email" placeholder="Email" class="form-control mb-2" value=" {{ $user->email }}" readonly required>
                            </div>

                            <div class="col-lg-12">
                                <input type="file" name="file" class="form-control mb-2">
                            </div>
                             

                            <div class="col-lg-12">
                                
                                <button type="submit" name="register" class="btn btn-info">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
                  
                </div>
              </div>
            </div>
            
        
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

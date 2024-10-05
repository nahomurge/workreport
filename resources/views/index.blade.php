@extends('adminMaster')
@section('content')
<body class="hold-transition sidebar-mini dark-mode">
  <!-- Site wrapper -->
  <div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add Place</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="">Add Place</a></li>
                <li class="breadcrumb-item active">Places</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- row -->
        <div class="row text-sm">
            <div class="col-md-12 col-12 callout callout-info">
                <div class="text-center">
                <h4 class = "text-gray float-left">Place Data</h4>
                <button type="button" class="btn btn-primary float-right btn-md" data-toggle="modal" data-target="#modal-newplace">
                  New Place <span class="fa fa-plus"></span>
                </button>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <div class="modal fade" id="modal-newplace">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Add New Place </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="{{route('createplaces')}}">
                          @csrf
                          <div class="card-body">
                            <div class="form-group">
                              <label for="name">Place Name</label>
                              <input name="name" required type="text" class="form-control" id="name"
                                placeholder="Type the name o the place here">
                            </div>
                            <div class="form-group">
                              <label for="description">Company Name</label>
                              <textarea name="description" class="form-control" rows="4" id="description"
                                placeholder="Type some description"></textarea>
                            </div>
                          </div>
                          <!-- /.card-body -->
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right">Add Place</button>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- list of registered roles in table -->
                <table id="example1" class="table table-bordered table-striped table-sm dTable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Place Name</th>
                      <th>Company</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($myPlaceData as $key=>$myPlace)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$myPlace->name}}</td>
                      <td>{{$myPlace->description}}</td>
                      <td class="text-center">
                        <div class="btn-group bg-success">
                        <a id='delete' href="{{route('deleteplace', $myPlace->id)}}"  type="button" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Company</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </section>
    </div>
  </div>
  <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="assets/plugins/toastr/toastr.min.js"></script>
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "buttons": ['copyHtml5', 'excelHtml5', 'pdfHtml5', 'csv', 'print','colvis']
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
  
</body>
@endsection
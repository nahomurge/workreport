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
              <h1>Records</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="">Records</a></li>
                <li class="breadcrumb-item active">Add Record</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Genetal expense widgets -->
        <!-- row -->
        <div class="row text-sm">
            <div class="col-md-12 col-12 callout callout-info">
                <div class="row">
                    <div class="col-2">
                        <h4 class = "text-gray float-left">Works Data</h4>
                    </div>
                    <div class="col-8">
                        <form action="{{route('filterwork')}}">
                            <div class="row">
                                <div class="form-group col-4 text-center">
                                    <label for="date">From Date:</label>
                                    @if(!empty($fromDate))
                                        <input name="fromdate" value="{{$fromDate}}" type="date" class="form-control" id="date">
                                    @else
                                        <input name="fromdate" type="date" class="form-control" id="date">
                                    @endif
                                </div>
                                <div class="form-group col-4 text-center">
                                    <label for="date2">To Date:</label>
                                    @if(!empty($toDate))
                                    <input name="todate" type="date" value="{{$toDate}}" class="form-control" id="date">
                                    @else
                                    <input name="todate" type="date" class="form-control" id="date">
                                    @endif
                                </div>
                                <div class="form-group col-4 text-center">
                                    <label for="place">Place</label>
                                    <select name="placeid" id="place" class="form-control">
                                        <option value="">---Choose Place---</option>
                                        @if(!empty($placeid))
                                        @foreach($placeData as $key=>$place)
                                        <option {{$placeid == $place->id?"selected":""}} value="{{$place->id}}">{{$place->name}}</option>
                                        @endforeach
                                        @else
                                        @foreach($placeData as $key=>$place)
                                        <option value="{{$place->id}}">{{$place->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>



                            </div>
                            <div class="text-center">
                            <label for="place"></label>
                                    <button type="submit" class="btn btn-success">Filter <i class="fa fa-search"></i></button>
                                </div>
                        </form>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-primary btn-lg float-right btn-md" data-toggle="modal" data-target="#modal-newplace">
                        New Record <span class="fa fa-plus"></span>
                        </button>
                    </div>
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
                        <h4 class="modal-title">Add New Record </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="{{route('createrecord')}}">
                          @csrf
                          <div class="card-body">
                            <div class="form-group">
                              <label for="date">Date</label>
                              <input name="date" required type="date" class="form-control" id="date">
                            </div>
                            <div class="form-group">
                              <label for="name">Place</label>
                              <select name="placeid" required id="placeid" class="form-control">
                                <option value="">---Choose Place---</option>
                                @foreach($placeData as $key=>$place)
                                <option value="{{$place->id}}">{{$place->name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="duration">Hour</label>
                              <input name="duration" required type="number" min="0.00" step=".01" placeholder="Enter duration in hour" class="form-control" id="duration">
                            </div>
                            <div class="form-group">
                              <label for="distance">Distance</label>
                              <input name="distance" type="number" min="0" placeholder="Enter the distance in meter" class="form-control" id="distance">
                            </div>
                            <div class="form-group">
                              <label for="description">Description</label>
                              <textarea name="description" class="form-control" rows="4" id="description"
                                placeholder="Type some description"></textarea>
                            </div>
                          </div>
                          <!-- /.card-body -->
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right">Add Record</button>
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
                      <th>Date</th>
                      <th>Place</th>
                      <th>Hour</th>
                      <th>Distance</th>
                      <th>Description</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $totalDistance = 0.00;
                    $totalDuration = 0.00;
                    @endphp
                    @foreach($recordData as $key=>$record)
                    @php
                    $totalDistance += $record->distance;
                    $totalDuration += $record->duration;
                    @endphp
                    <tr>
                      <td>{{$record->date}}</td>
                      <td>{{$record['place']['name']}}</td>
                      <td class="fieldCell">{{$record->duration}}</td>
                      <td>{{$record->distance}}</td>
                      <td>{{$record->description}}</td>
                      <td class="text-center">
                        <div class="btn-group bg-success">
                          <button type="button" data-toggle="modal" data-target="#modal-edit{{$record->id}}" class="btn btn-secondary btn-sm float-left"><i class="fas fa-edit"></i></button>
                          <a id='delete' href="{{route('deleterecord', $record->id)}}"  type="button" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <div class="modal fade text-left" id="modal-edit{{$record->id}}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Workhour</h4>
                            <button type="button" class="close" data-dismiss="modal" area-label="close">
                              <span area-hidden="true">&times</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <form method="POST" action="{{route('editrecord', $record->id)}}">
                            @csrf
                            <div class="card-body">
                              <div class="form-group">
                                <label for="date">Date</label>
                                <input name="date" value="{{$record->date}}" required type="date" class="form-control" id="date">
                              </div>
                              <div class="form-group">
                                <label for="name">Place</label>
                                <select name="placeid" id="placeid" class="form-control">
                                  <option value="">---Choose Place---</option>
                                  @foreach($placeData as $key=>$place)
                                  <option {{$place->id == $record->placeid ? "selected":""}} value="{{$place->id}}">{{$place->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="duration">Hour</label>
                                <input name="duration" value="{{$record->duration}}" type="number" min="0" placeholder="Enter duration in hour" class="form-control" id="duration">
                              </div>
                              <div class="form-group">
                                <label for="distance">Distance</label>
                                <input name="distance" value="{{$record->distance}}" type="number" min="0" placeholder="Enter the distance in meter" class="form-control" id="distance">
                              </div>
                              <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" rows="4" id="description"
                                  placeholder="Type some description">{{$record->description}}</textarea>
                              </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="form-group">
                              <button type="submit" class="btn btn-primary float-right">Save</button>
                            </div>
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                    <tr class="bg-info">
                      <td><b>Total Hour</b></td>
                      <td> ∼ </td>
                      <td class="fieldCell"><b>{{$totalDuration}}</b></td>
                      <td><b>{{$totalDistance}}</b></td>
                      <td> ∼</td>
                      <td></td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Date</th>
                      <th>Place</th>
                      <th>Hour</th>
                      <th>Distance</th>
                      <th>Description</th>
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
  <script language="javascript" type="text/javascript">

var tds = document.getElementById('example').getElementsByTagName('td');
var sum = 0;
for(var i = 0; i < tds.length; i ++){
if(tds[i].className == 'fieldCell' ) {
sum += isNaN(tds[i].innerHTML) ? 0 : parseInt(tds[i].innerHTML);
}
}
// document.getElementById('example1').innerHTML += '<tr><td> Total </td> <td colspan = "2"></td> <td> ' + sum + '</td><td colspan = "3"></td>  </tr> ';
//document.getElementById('example1').innerHTML += '<tr><td> Total Hr </td> <td></td><td></td> <td> ' + sum + '</td><td></td><td></td><td></td>  </tr> ';
</script>
  <script>
    $(function () {
      var colsToExport = [0,1,2,3];
      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": true,
        "bPaginate": false,
        "buttons": [{
        extend: 'copyHtml5',
        text: 'copy',
        exportOptions: {
          columns: colsToExport
        }
      } , {
        extend: 'excelHtml5',
        text: 'excel',
        exportOptions: {
          columns: colsToExport
        }
      }, {
        extend: 'pdfHtml5',
        text: 'pdf',
        exportOptions: {
          columns: colsToExport
        },
        customize: function (doc) {
                    doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                  }
      }, {
        extend: 'csv',
        text: 'csv',
        exportOptions: {
          columns: colsToExport
        }
      },
      {
        extend: 'print',
        text: 'print',
        exportOptions: {
          columns: colsToExport
        }
      },'colvis']
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>

</body>
@endsection

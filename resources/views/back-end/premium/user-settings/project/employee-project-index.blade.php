@extends('back-end.premium.layout.employee-setting-main')
@section('content')
<?php
use App\Models\User;
?>
    <section class="main-contant-section">


        <div class=" mb-3">

            @if(Session::get('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif
            @if((Auth::user()->company_profile == 'Yes'))
                <button type="button" class="edit-btn btn btn-grad mr-2" data-toggle="modal" data-target="#addModal">
                    <i class="fa fa-plus"></i> {{__('Add Project')}}</button>
            @endif

        </div>

        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{__('Project List')}} </h1>
            </div>
        </div>
            <!-- Add Modal Starts -->

            <div id="addModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">{{_('Add Project')}}</h5>
                            <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{route('add-employee-projects')}}" class="form-horizontal" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" class="form-control" name="assign_to[]" value="{{Session::get('employee_setup_id')}}">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Project Name</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-product-hunt" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="project_name" placeholder="Project Name" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Priority</label>
                                        <select class="form-control" name="project_priority">
                                            <option>Choose a Priority</option>
                                            <option value="High">High</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Low">Low</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>Client Name</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="project_client_name" placeholder="Client Name" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>Start Date</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="date" name="project_start_date" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>End Date</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="date" name="project_end_date" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>Project Progress (%)</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-spinner" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="progress_progress" placeholder="10" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-4">
                                    <button class="btn btn-grad" type = "submit"> <i class="fa fa-plus" aria-hidden="true"></i> Add </button> 
                                        <!-- <input type="submit" name="action_button" class="btn btn-primary btn-block" value="{{__('Add')}}"/> -->

                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Add Modal Ends -->

        <div class="content-box">
        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Project Name')}}</th>
                        <th>{{__('Assigned To')}}</th>
                        <th>{{__('Priority')}}</th>
                        <th>{{__('Client Name')}}</th>
                        <th>{{__('Start Date')}}</th>
                        <th>{{__('End Date')}}</th>
                        <th>{{__('Project Progress (%)')}}</th>
                        @if((Auth::user()->company_profile == 'Yes'))
                        <th>{{__('Action')}}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                        @php($i=1)
                        @foreach($projects as $projects_value)
                        @foreach(json_decode($projects_value->assign_to) as $test)
                        @if($test == Session::get('employee_setup_id'))

                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$projects_value->project_name}}</td>
                            <td>
                            @foreach(json_decode($projects_value->assign_to) as $test)
                            <?php
                            $users = User::where('id',$test)->get(['first_name','last_name']);
                            foreach($users as $users_data){
                            echo $users_data->first_name.' '.$users_data->last_name.'<br>';
                            }
                            ?>
                            @endforeach
                            </td>
                            <td>{{$projects_value->project_priority}}</td>
                            <td>{{$projects_value->project_client_name}}</td>
                            <td>{{$projects_value->project_start_date}}</td>
                            <td>{{$projects_value->project_end_date}}</td>
                            <td>{{$projects_value->progress_progress}}</td>
                            @if((Auth::user()->company_profile == 'Yes'))
                            <td>
                                <a href="javascript:void(0)" class="btn edit" data-id="{{$projects_value->id}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>  </a>
                                <a href="{{route('delete-employee-projects',['id'=>$projects_value->id])}}" class="btn delete delete-post"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a>
                            </td>
                            @endif
                        </tr>
                        @endif
                        @endforeach
                        @endforeach
                </tbody>

            </table>

        </div>
        </div>
    </section>






        <!-- edit boostrap model -->
        <div class="modal fade" id="edit-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="edit_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                        <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <label>Project Name</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-product-hunt" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="project_name" id="project_name" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Priority</label>
                                        <select class="form-control" name="project_priority" id="project_priority">
                                            <option>Choose a Priority</option>
                                            <option value="High">High</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Low">Low</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>Client Name</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="project_client_name" id="project_client_name" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>Start Date</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="date" name="project_start_date" id="project_start_date" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>End Date</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="date" name="project_end_date" id="project_end_date" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                        <label>Project Progress (%)</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-spinner" aria-hidden="true"></i> </span>
                                            </div>
                                            <input type="text" name="progress_progress" id="progress_progress" class="form-control" value="">
                                        </div>
                                    </div>
                            
                            <div class="col-sm-offset-2 col-sm-10 mt-4">
                                <button type="submit" class="btn btn-grad">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
                </div>
            </div>
            </div>
        <!-- end bootstrap model -->



<script type="text/javascript">

$(document).ready( function () {

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

      $('#user-table').DataTable({

            "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
            "iDisplayLength": 25,
              dom: '<"row"lfB>rtip',

              buttons: [
                  {
                      extend: 'pdf',
                      text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                      exportOptions: {
                          columns: ':visible:Not(.not-exported)',
                          rows: ':visible'
                      },
                  },
                  {
                      extend: 'csv',
                      text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                      exportOptions: {
                          columns: ':visible:Not(.not-exported)',
                          rows: ':visible'
                      },
                  },
                  {
                      extend: 'print',
                      text: '<i title="print" class="fa fa-print"></i>',
                      exportOptions: {
                          columns: ':visible:Not(.not-exported)',
                          rows: ':visible'
                      },
                  },
                  {
                      extend: 'colvis',
                      text: '<i title="column visibility" class="fa fa-eye"></i>',
                      columns: ':gt(0)'
                  },
              ],
          });





             //value retriving and opening the edit modal starts

             $('.edit').on('click', function () {
                var id = $(this).data('id');

                $.ajax({
                    type:"POST",
                    url: 'employee-project-by-id',
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                    $('#ajaxModelTitle').html("Edit");
                    $('#edit-modal').modal('show');
                    $('#id').val(res.id);
                    $('#project_name').val(res.project_name);
                    $('#project_priority').val(res.project_priority);
                    $('#project_client_name').val(res.project_client_name);
                    $('#project_start_date').val(res.project_start_date);
                    $('#project_end_date').val(res.project_end_date);
                    $('#progress_progress').val(res.progress_progress);
                }
                });
            });

           //value retriving and opening the edit modal ends

             // edit form submission starts

          $('#edit_form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                console.log(formData);
                $('#error-message').text('');

                $.ajax({
                    type:'POST',
                    url: `/update-employee-project`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        window.location.reload();
                        if (response) {
                        this.reset();
                        alert('Data has been updated successfully');
                        }
                    },
                    error: function(response){
                        console.log(response);
                            $('#error-message').text(response.responseJSON.errors.file);
                    }
                });
            });

            // edit form submission ends








  } );


</script>



@endsection

















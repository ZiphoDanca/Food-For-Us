@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li><a href="{{ url('/inactiveUsers') }}">Inactive Users</a></li>
        <li><a href="{{ url('/deactivatedUser') }}"> De-actived App Users</a></li>
        <li class="active">Active App Users</li>
        {{--<li class="active"><a>  </a></li>--}}
        {{--<li class="active"><a>Posts</a></li>--}}
    </ol>
    <h4 class="page-title">Active App Users</h4>

<div class="tab-pane" id="active">
    <div class="row">
        <div class="col-md-12" >
            <div class="tab-pane" id="closure">
                <!-- Responsive Table -->
                <div class="block-area" id="responsiveTable">
                    <div class="table-responsive">
                        <h3 class="block-title"> Active User  List</h3><h16>&nbsp</h16>
                        <a href="{{ url('userroleslist') }}" class="btn btn-sm">
                            <i aria-hidden="true" title="Filter Users By User Group" data-toggle="tooltip">Filter By User Group</i>
                        </a>
                        <table class="table tile table-striped" id="activeUsersTable">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Cellphone</th>
                                <th>Email</th>
                                <th>Cellphone</th>
                                <th>Interest </th>
                                <th>Last Login </th>
                                <th>Location</th>
                                <th>Gps Lat</th>
                                <th>Gps Long</th>
                                <th>Travel Radius</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
    <script>

        $(document).ready(function () {



            $('#activeUsersTable').dataTable({


                ajax:"{!! url('/active/')!!}","processing": true,

                columns: [

                    { data: 'id' },
                    { data: 'name' },
                    { data: 'surname' },
                    { data: 'cellphone' },
                    { data: 'email' },
                    { data: 'cellphone'},
                    { data: 'intrest' },
                    { data: 'last_login' },
                    { data: 'location' },
                    { data: 'gps_lat' },
                    { data: 'gps_long' },
                    { data: 'travelRadius' },
                    { data: 'descriptionOfAcces' },
                    { data: 'created_at' },
                    { data: function (data, type, row)
                        {
                        return "<a href='{!! url('logins/" + data.id + "') !!}' class='btn btn-sm'>" + 'View' + "</a>"+
                            "<a href='{!! url('inactivateUsers/" + data.id + "') !!}' class='btn btn-sm'>" + 'DeActivate' + "</a>";

                        data.replace( /[$,]/g, '' )
                            data;
                    }
                    }
                ],
                dom: 'Bfrtip',
                "scrollX": true,
                "bAutoWidth": false,
                "aaSorting": [],
                "buttons":
                    [
                        'copyHtml5',
                        'excelHtml5',
                        ,{
                        extend : 'pdfHtml5',
                        title  : 'Food_For_Us',
                        header : 'I am text in',
                    },
                    ],
                "buttons": [
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
            });

        })
    </script>
@endsection
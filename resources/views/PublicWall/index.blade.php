@extends('master')
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{ url('/users') }}">Home</a></li>
        <li class="active">Recipes List</li>
    </ol>
    <h4 class="page-title">Recipes Listing</h4>

    <input type="text" class="hidden" style="color:black" id="role" value={!! Auth::user()->role !!} />

    <div class="row">
        <div class="col-md-12" >
            <div class="tab-pane" id="closure">
                <!-- Responsive Table -->
                <div class="block-area" id="responsiveTable">
                    <div class="table-responsive">
                        <h3 class="block-title">RECIPES </h3>
                        <a href="{{ url('addRecipe') }}" class="btn btn-sm hidden">
                            <i class="fa fa-plus" aria-hidden="true" title="Add new recipe" data-toggle="tooltip"></i>
                        </a>
                        <table class="table tile table-striped" id="publicWallTable">
                            <thead>
                            <tr>
                                {{--<th>Id</th>--}}
                                <th>Type</th>
                                <th>Title </th>
                                <th>Methods</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('footer')
    <script>

        jQuery(document).ready(function($){

            if($( "#role" ).val() == "admin") {
                $('.btn').removeClass('hidden');
            }

            var publicWallTable     = $('#publicWallTable').DataTable({
                "autoWidth": false,
                "processing": true,
                speed: 500,
                "dom": 'Bfrtip',
                "buttons": [
                    'copyHtml5',
                    'excelHtml5',
                    ,{
                        extend : 'pdfHtml5',
                        title  : 'Siyaleader_Report',
                        header : 'I am text in',
                    },
                ],

                "order" :[[0,"desc"]],
                "ajax": "{!! url('/allRecipes/')!!}",
                "processing": true,
                "serverSide": true,
                "order" :[[0,"desc"]],

                "buttons": [
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],


                "columns": [
//                    {data: 'id', name: 'id'},
                    {data: 'type', name: 'type'},
                    {data: 'name', name: 'name'},


                    {data: 'methods', name: 'methods'},
                    {data: 'created_at', name: 'created_at'},

                    {data: function(d)
                    {

                        if($( "#role" ).val() == "admin") {
                            return "<a href='{!! url('RecipeProfile/" + d.id + "') !!}' class='btn btn-sm'>" + 'Read more' + "</a>" +
                                "<a href='{!! url('deleteRecipe/" + d.id + "') !!}' class='btn btn-sm'>" + 'Delete' + "</a>";
                        }
                        else if($( "#role" ).val() == "manager")
                        {
                            return "<a href='{!! url('RecipeProfile/" + d.id + "') !!}' class='btn btn-sm'>" + 'Read more' + "</a>";
                        }

                    }},
                ],

                "aoColumnDefs": [
                    { "bSearchable": false, "aTargets": [ 4] },
                    { "bSortable": false, "aTargets": [ 4] }
                ]

            });
        });
    </script>
@endsection
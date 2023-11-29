{{--@extends('backend.layouts.user_master')--}}
{{--@section('title', ' All Posts')--}}
{{--@section('content')--}}
{{--    <div class="app-page-title">--}}
{{--        <div class="page-title-wrapper">--}}
{{--            <div class="page-title-heading">--}}
{{--                <div class="page-title-icon">--}}
{{--                    <i class="pe-7s-users icon-gradient bg-mean-fruit"> </i>--}}
{{--                </div>--}}
{{--                <div>All Posts</div>--}}
{{--                <div class="d-inline-block ml-2">--}}
{{--                    <a href="{{ URL :: to('/user/posts/create') }}">--}}
{{--                        <button class="btn btn-success" ><i--}}
{{--                                class="glyphicon glyphicon-plus"></i>--}}
{{--                            New Post--}}
{{--                        </button>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-12 col-sm-12">--}}
{{--            <div class="main-card mb-3 card">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table id="manage_all"--}}
{{--                               class="align-middle mb-0 table table-borderless table-striped table-hover">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>Title</th>--}}
{{--                                <th>Description</th>--}}
{{--                                <th>Category</th>--}}
{{--                                <th>Status</th>--}}
{{--                                <th>Action</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


{{--    <style>--}}
{{--        @media screen and (min-width: 768px) {--}}
{{--            #myModal .modal-dialog {--}}
{{--                width: 70%;--}}
{{--                border-radius: 5px;--}}
{{--            }--}}
{{--        }--}}
{{--    </style>--}}

{{ Html::script('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js') }}
    <script>
        $(document).ready(function () {
            $.ajax({
                url: "/user/personal-posts",
                method: 'get',
                async: false,
                data: {},
                success: function (response) {
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        });

        // $(function () {
        //     let table = $('#manage_all').DataTable({
        //         processing: true,
        //         serverSide: true,
        //         // ajax: '/user/personal-posts',
        //         ajax: {
        //             url: "/user/personal-posts",
        //             type: 'get',
        //             data: {},
        //             error: function (xhr, err) {
        //                 if (err === 'parsererror')
        //                     this.draw(false);
        //                 console.log('Err:', err);
        //                 console.log('XHR', xhr);
        //                 // location.reload();
        //             }
        //         },
        //         columns: [
        //             {data: 'title', name: 'title'},
        //             {data: 'description', name: 'description'},
        //             {data: 'category', name: 'category'},
        //             {data: 'status', name: 'status'},
        //             {data: 'action', name: 'action'}
        //         ],
        //         "columnDefs": [
        //             {"className": "", "targets": "_all"}
        //         ],
        //         "autoWidth": false,
        //     });
        //     $('.dataTables_filter input[type="search"]').attr('placeholder', 'Type here to search...').css({
        //         'width': '220px',
        //         'height': '30px'
        //     });
        // });

        function reload_table() {
            table.ajax.reload(null, false); //reload datatable ajax
        }

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function () {
            $("#manage_all").on("click", ".delete", function () {
                var id = $(this).attr('id');
                swal({
                    title: "Are you sure?",
                    text: "Deleted data cannot be recovered!!",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel"
                }, function () {
                    $.ajax({
                        url: '/user/posts/' + id,
                        type: 'DELETE',
                        headers: {
                            "X-CSRF-TOKEN": CSRF_TOKEN,
                            "Authorization": "Bearer {{ Cookie::get('access_token') }}",
                        },
                        "dataType": 'json',
                        success: function (data) {

                            if (data.type === 'success') {

                                swal("Done!", "Successfully Deleted", "success");
                                reload_table();

                            } else if (data.type === 'danger') {

                                swal("Error deleting!", "Try again", "error");

                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            swal("Error deleting!", "Try again", "error");
                        }
                    });
                });
            });
        });
    </script>
{{--@stop--}}

@extends('tema.default')

@section('title')
    Users
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <h3>User</h3>
            </div>
            <div class="card-body">
                <div class="dt-responsive">
                    <table id="user" class="table table-striped table-bordered nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="vertical-align : middle;text-align:center;">No</th>
                                <th style="vertical-align : middle;text-align:center;">Name</th>
                                <th style="vertical-align : middle;text-align:center;">Email</th>
                                <th style="vertical-align : middle;text-align:center;">Verified</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        var table = null;
        $(document).ready(function () {
            table = $('#user').DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                "ajax": {
                    "url": "user/json",
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    }, 
                    {
                        data: "name",
                    },
                    {
                        data: "email",
                    }, 
                    {
                        data: "email_verified_at",
                    }, 
                ],
            });
        })
    </script>
@endsection
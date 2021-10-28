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
                @if ($level->level == 99)
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success" data-toggle="tooltip" title="Add Item" onclick="ClearScreen();"><i class="fa fa-plus"></i></button>
                        <div>
                            <a href="user/excel" class="btn btn-primary" data-toggle="tooltip" title="Download Excel"><i class="fa fa-file-excel"></i></a>
                            <a href="user/pdf" class="btn btn-info" data-toggle="tooltip" title="Download PDF"><i class="fa fa-file-pdf"></i></a>
                        </div>
                    </div>
                </div>
                @endif
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
                                <th style="vertical-align : middle;text-align:center;">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="inpModal" role="dialog" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Data</h4>
                <button type="button" class="close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <form id="formmodal">
                    <input type="number" name="id" id="id" class="form-control" hidden>
                    <label>Name </label>
                    <div class="form-group">
                        <input type="text" name="name" id="name" class="form-control">
                        <p id="errname" class="text-danger" hidden></p>
                    </div>
                    <label>Email </label>
                    <div class="form-group">
                        <input disabled type="email" name="email" id="email" class="form-control">
                        <p id="erremail" class="text-danger" hidden></p>
                    </div>
                    <label>Password </label>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control">
                        <p id="errpassword" class="text-danger" hidden></p>
                    </div>
                    <label>Confirm Password </label>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        <p id="errconfirmpassword" class="text-danger" hidden></p>
                    </div>
                    @if ($level->level == 99)
                    <label>Role </label>
                    <div class="form-group">
                        <select name="level" id="level" class="form-select">
                            <option value=""></option>
                            <option value="10">User</option>
                            <option value="99">Admin</option>
                        </select>
                    </div>
                    @else
                    <input type="text" name="level" id="level" hidden>
                    @endif
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="Save" onclick="Crup();">Save</button>
                <button type="button" class="btn btn-warning" id="Update" onclick="Crup();">Update</button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var table = null;
    $(document).ready(function () {
        if ({{$level->level}} == 99) {
            $('#level').select2({
            placeholder: "Select Role",
            dropdownParent: $('#inpModal'),
            width: '100%',
        })
        }

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
                {
                    data: null,
                    sortable: false,
                    render: function(data, type, row) {
                        if ({{ $level->level }} == 99) {
                            return '<button class="btn btn-warning" data-toggle="tooltip" title="Edit" onclick="return GetById(' + row.id + ')"><i class="fa fa-edit"></i></button>' + '&nbsp;' +
                            '<button class="btn btn-danger" data-toggle="tooltip" title="Delete" onclick="return Delete(' + row.id + ')"><i class="fa fa-trash"></i></button>'
                        } else if ({{ $level->level }} == 10 && data.id == {{ Auth::user()->id }}) {
                            return '<button class="btn btn-warning" data-toggle="tooltip" title="Edit" onclick="return GetById(' + row.id + ')"><i class="fa fa-edit"></i></button>'
                        } else {
                            return ''
                        }
                    }
                }
            ],
        });
    })

    function ClearScreen() {
        $('#inpModal').modal('show');
        $('.modal-header').removeClass('bg-warning');
        $('.modal-header').addClass('bg-success');
        $('#Update').attr('hidden', true);
        $('#Save').attr('hidden', false);

        $('#email').attr('disabled', false);

        $('#id').val('');
        $('#name').val('');
        $('#email').val('');
        $('#password').val('');
        $('#password_confirmation').val('');
        $('#level').val('10').trigger('change');

        $('#errname').attr('hidden', true);
        $('#errname').val('');
        $('#erremail').attr('hidden', true);
        $('#erremail').val('');
        $('#errpassword').attr('hidden', true);
        $('#errpassword').val('');
        $('#errconfirmpassword').attr('hidden', true);
        $('#errconfirmpassword').val('');
    }

    function Crup() {
        var id = $('#id').val();
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();
        var level = $('#level').val();
        $.ajax({
            url: "user/crup",
            type: "POST",
            cache: false,
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                name: name,
                email: email,
                password: password,
                password_confirmation: password_confirmation,
                level: level,
            },
            success: function(data) {
                $('#inpModal').modal('hide');
                Swal.fire('Success', 'Data Added Successfully', 'success');
                table.ajax.reload();
            },
            error: function(response) {
                var err = response.responseJSON.errors;
                $('#errname').attr('hidden', false);
                $('#errname').html(err.name);
                $('#erremail').attr('hidden', false);
                $('#erremail').html(err.email);
                $('#errpassword').attr('hidden', false);
                $('#errpassword').html(err.password);
            }
        })
    }

    function GetById(id) {
        $.get('user/' + id + '/edit', function (data) {
            $('#id').val(id);
            $('#name').val(data.isi.name);
            $('#email').val(data.isi.email);
            $('#password').val(data.isi.password);
            $('#level').val(data.isi.level).trigger('change');
            $('#inpModal').modal('show');
            $('.modal-header').removeClass('bg-success');
            $('.modal-header').addClass('bg-warning');
            $('#Save').attr('hidden', true);
            $('#Update').attr('hidden', false);

            $('#email').attr('disabled', true);

            $('#errname').attr('hidden', true);
            $('#errname').val('');
            $('#erremail').attr('hidden', true);
            $('#erremail').val('');
            $('#errpassword').attr('hidden', true);
            $('#errpassword').val('');
        })
    }

    function Delete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "user/delete/" + id,
                    type: "GET",
                }).then((result) => {
                    if (result) {
                        Swal.fire('Success', 'Delete Successfully', 'success');
                        table.ajax.reload();
                    } else {
                        Swal.fire('Error', result, 'error');
                    }
                })
            }
        })
    }
</script>
@endsection
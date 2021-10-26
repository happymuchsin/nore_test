@extends('tema.default')

@section('title')
    List Item
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <h3>List Item</h3>
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success" data-toggle="tooltip" title="Add Item" onclick="ClearScreen();"><i class="fa fa-plus"></i></button>
                        <div>
                            <a href="list/excel" class="btn btn-primary" data-toggle="tooltip" title="Download Excel"><i class="fa fa-file-excel"></i></a>
                            <a href="list/pdf" class="btn btn-info" data-toggle="tooltip" title="Download PDF"><i class="fa fa-file-pdf"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="dt-responsive">
                    <table id="tabel" class="table table-striped table-bordered nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="vertical-align : middle;text-align:center;">No</th>
                                <th style="vertical-align : middle;text-align:center;">Name</th>
                                <th style="vertical-align : middle;text-align:center;">Price</th>
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
                    <label>Price </label>
                    <div class="form-group">
                        <input type="number" name="price" id="price" class="form-control">
                        <p id="errprice" class="text-danger" hidden></p>
                    </div>
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
            table = $('#tabel').DataTable({
                columnDefs: [{
                    render: function(data, type, row) {
                        return commaNumb(data);
                    },
                    targets: [2]
                }, ],
                processing: true,
                serverSide: true,
                ordering: false,
                "ajax": {
                    "url": "list/json",
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
                        data: "price",
                    }, 
                    {
                        data: null,
                        sortable: false,
                        render: function(data, type, row) {
                            return '<button class="btn btn-warning" data-toggle="tooltip" title="Edit" onclick="return GetById(' + row.id + ')"><i class="fa fa-edit"></i></button>' + '&nbsp;' +
                                '<button class="btn btn-danger" data-toggle="tooltip" title="Delete" onclick="return Delete(' + row.id + ')"><i class="fa fa-trash"></i></button>'
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

            $('#id').val('');
            $('#name').val('');
            $('#price').val('');

            $('#errname').attr('hidden', true);
            $('#errname').val('');
            $('#errprice').attr('hidden', true);
            $('#errprice').val('');
        }

        function Crup() {
            var id = $('#id').val();
            var name = $('#name').val();
            var price = $('#price').val();
            $.ajax({
                url: "list/crup",
                type: "POST",
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    name: name,
                    price: price,
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
                    $('#errprice').attr('hidden', false);
                    $('#errprice').html(err.price);
                }
            })
        }

        function GetById(id) {
            $.get('list/' + id + '/edit', function (data) {
                $('#id').val(id);
                $('#name').val(data.isi.name);
                $('#price').val(data.isi.price);
                $('#inpModal').modal('show');
                $('.modal-header').removeClass('bg-success');
                $('.modal-header').addClass('bg-warning');
                $('#Save').attr('hidden', true);
                $('#Update').attr('hidden', false);

                $('#errname').attr('hidden', true);
                $('#errname').val('');
                $('#errprice').attr('hidden', true);
                $('#errprice').val('');
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
                        url: "list/delete/" + id,
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
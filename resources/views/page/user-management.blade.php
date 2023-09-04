@extends('layout.master')
@section('content')
<link rel="stylesheet" href="/assets/css/data/style.css">
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/export/bootstrap-table-export.min.js"></script>



<h3 class="title-heading">User & Role Management</h3>


<div id="toolbar" class="select">
    <button id="button-add" type="button" class="btn btn-primary mb-1">Add User</button>
</div>

<div id="delete" class="opacity delete">
    <div class="box-modal-delete">
        <img src="/assets/images/delete.svg" alt="">
        <h4>Are you sure want to delete this data?</h4>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th class="border" scope="row">Name</th>
                    <td id="table-name" class="border"></td>
                </tr>
                <tr>
                    <th class="border" scope="row">Email</th>
                    <td id="table-email" class="border"></td>
                </tr>
                <tr>
                    <th class="border" scope="row">Gender</th>
                    <td id="table-gender" class="border"></td>
                </tr>
                <tr>
                    <th class="border" scope="row">Role</th>
                    <td id="table-role" class="border"></td>
                </tr>
            </tbody>
        </table>
        <div class="bottom d-flex align-items-space-between justify-content-space-between">
            <button id="button-close-delete" class="button close">Cancel</button>
            <form action="/delete/v1/data/revenue" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" id="ids" name="ids">
                <button class="button"  type="submit">Delete Data</button>
            </form>
        </div>
    </div>
</div>

<div id="update" class="opacity update">
    <div class="box-modal">
        <form action="/update/v1/data/revenue" class="forms" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="ids-update" name="ids">
            <div class="top">
                <h3 style="">Edit User Data</h3>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Name" required>
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="role">Role</label>
                    <select class="form-select" name="role" id="role" required>
                        <option value="" disabled selected>Role</option>
                        <option value="1">Master</option>
                        <option value="2">Admin</option>
                        <option value="3">User</option>
                    </select>
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="gender">Gender</label>
                    <select class="form-select" name="gender" id="gender" required>
                        <option value="" disabled selected>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="input-placeholder photo d-flex align-items-center">
                    <label for="photo">Profile Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="bottom d-flex align-items-center justify-content-end">
                <p id="button-close-update" class="outlined-button">Cancel</p>
                <button class="reguler-button" type="submit">Update Data</button>
            </div>
        </form>
    </div>
</div>

<div id="add" class="opacity add">
    <div class="box-modal">
        <form action="{{route('addDataUser')}}" method="POST" class="forms" enctype="multipart/form-data">
            @csrf
            <div class="top">
                <h3 style="">Add User Data</h3>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Name" required>
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="role">Role</label>
                    <select class="form-select" name="role" id="role" required>
                        <option value="" disabled selected>Role</option>
                        <option value="2">Admin</option>
                        <option value="3">User</option>
                    </select>
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="gender">Gender</label>
                    <select class="form-select" name="gender" id="gender" required>
                        <option value="" disabled selected>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="input-placeholder photo d-flex align-items-center">
                    <label for="photo">Profile Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="bottom d-flex align-items-center justify-content-end">
                <p id="button-close" class="outlined-button">Cancel</p>
                <button class="reguler-button" type="submit">Add Data</button>
            </div>
        </form>
    </div>
</div>


<div class="containerize-tables">
    <table
        id="table"
        data-toolbar="#toolbar"
        data-show-toggle="false"
        data-pagination="true"
        data-sortable="true"
        data-search="true"
        data-page-list="[10, 25, 50, 100]">
        <thead>
            <tr>
                <th data-field="name" data-cell-style="cellStyle">Name</th>
                <th data-field="email" data-cell-style="cellStyle">Email</th>
                <th data-field="role_id" data-formatter="roleFormatter" data-cell-style="cellStyle">Role</th>
                <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents" data-cell-style="cellStyle" data-width="100">Events</th>
            </tr>
        </thead>
    </table>
</div>


<script>
    var $table = $('#table')
    $(document).ready( function () {
        var da = {!! json_encode($users->toArray()) !!}
        $table.bootstrapTable({data: da})
    });

    function roleFormatter(value, row, index){
        switch (value) {
            case 1:
                return ['MASTER'];
                break;
            case 2:
                return ['ADMIN'];
                break;
            case 3:
                return ['USER'];
                break;

            default:
                break;
        }
    }

    function operateFormatter(value, row, index) {
        return [
            '<a class="like" href="javascript:void(0)" title="Like">',
            '<i class="bi bi-pencil" style="font-size:20px;"></i>',
            '</a>  ',
            '<a class="remove" href="javascript:void(0)" title="Remove">',
            '<i class="bi bi-trash" style="font-size:20px;"></i>',
            '</a>'
        ].join('')
    }

    window.operateEvents = {
        'click .like': function (e, value, row, index) {
            $("#update").show();
            $('#name').val(row.name)
            $('#email').val(row.email)
            $('#gender').val(row.gender)
            $('#role').val(row.role_id)
            // alert('You click like action, row: ' + JSON.stringify(row))
        },
        'click .remove': function (e, value, row, index) {

            $('#delete').show();
            $('#table-name').html(row.name)
            $('#table-email').html(row.email)
            $('#table-gender').html(row.gender)

            switch (row.role_id) {
                case 1:
                    $('#table-role').html('Master')
                    break;
                case 2:
                    $('#table-role').html('Admin')
                    break;
                default:
                    $('#table-role').html('User')
                    break;
            }

        }
    }


</script>
<script>
    function cellStyle(value, row, index) {
        if (index % 2 == 0) {
            return {
                css: {
                    background: '#F5F5F5'
                }
            }
        }
        return {
            css: {
                background: '#FFFFFF'
            }
        }
    }
</script>
<script>
    $('#button-add').on('click', function(){
        $('#add').show();
    })

    $('#button-close').on('click', function(){
        $('#add').hide();
    })

    $('#button-close-delete').on('click', function(){
        $('#delete').hide();
    })
    $('#button-close-update').on('click', function(){
        $('#update').hide();
    })
</script>

@endsection

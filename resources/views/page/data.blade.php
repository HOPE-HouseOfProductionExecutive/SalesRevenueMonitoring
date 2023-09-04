@extends('layout.master')
@section('content')
<link rel="stylesheet" href="/assets/css/data/style.css">

<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/export/bootstrap-table-export.min.js"></script>

<h3 class="title-heading">Revenue Data</h3>

<div id="toolbar" class="select">
    <button id="button-add" type="button" class="btn btn-primary mb-1">Add Data</button>
    <select class="form-control">
        <option value="">Select Export Option</option>
        <option value="all">Export All</option>
        <option value="selectedJanuary">January</option>
        <option value="selectedFebruary">February</option>
        <option value="selectedMarch">March</option>
        <option value="selectedApril">April</option>
        <option value="selectedMay">May</option>
        <option value="selectedJune">June</option>
        <option value="selectedJuly">July</option>
        <option value="selectedAugust">August</option>
        <option value="selectedSeptember">September</option>
        <option value="selectedOctober">October</option>
        <option value="selectedNovember">November</option>
        <option value="selectedDecember">December</option>
    </select>
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
                    <th class="border" scope="row">Supervisor Name</th>
                    <td id="table-spv" class="border"></td>
                </tr>
                <tr>
                    <th class="border" scope="row">Month</th>
                    <td id="table-month" class="border"></td>
                </tr>
                <tr>
                    <th class="border" scope="row">New</th>
                    <td id="table-new" class="border"></td>
                </tr>
                <tr>
                    <th class="border" scope="row">Upgrade</th>
                    <td id="table-upgrade" class="border"></td>
                </tr>
                <tr>
                    <th class="border" scope="row">Churn</th>
                    <td id="table-churn" class="border"></td>
                </tr>
                <tr>
                    <th class="border" scope="row">Downgrade</th>
                    <td id="table-downgrade" class="border"></td>
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
                <h3 style="">Update Revenue Data</h3>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="table-name-update" placeholder="Name" required>
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="spv">Supervisor Name</label>
                    <select class="form-select" name="spv" id="table-spv-update" required>
                        {{-- <option value="" disabled selected>Supervisor Name</option> --}}
                        <option value="Andry Setiawan">Andry Setiawan</option>
                        <option value="Debby Tri">Debby Tri</option>
                        <option value="Emihl Rembo">Emihl Rembo</option>
                        <option value="Fransiscus Yura">Fransiscus Yura</option>
                        <option value="Fredericksen">Fredericksen</option>
                        <option value="Fredy Mercury">Fredy Mercury</option>
                    </select>
                </div>

                <div class="input-placeholder d-flex align-items-center">
                    <label for="month" style=" font-weight: normal; font-style: normal;">Month</label>
                    <select class="form-select" name="month" id="table-month-update" required>
                        {{-- <option value="" disabled selected>Month</option> --}}
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>

                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="new">New</label>
                    <input type="number" name="new" id="table-new-update" placeholder="New" required>
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="upgrade">Upgrade</label>
                    <input type="number" name="upgrade" id="table-upgrade-update" placeholder="Upgrade" required>
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="churn">Churn</label>
                    <input type="number" name="churn" id="table-churn-update" placeholder="Churn" required>
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="downgrade">Downgrade</label>
                    <input type="number" name="downgrade" id="table-downgrade-update" placeholder="Downgrade" required>
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
        <form action="{{route('addData')}}" method="POST" class="forms">
            @csrf
            <div class="top">
                <h3 style="">Add Revenue Data</h3>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Name" required>
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="spv">Supervisor Name</label>
                    <select class="form-select" name="spv" id="spv" required>
                        <option value="" disabled selected>Supervisor Name</option>
                        <option value="Andry Setiawan">Andry Setiawan</option>
                        <option value="Debby Tri">Debby Tri</option>
                        <option value="Emihl Rembo">Emihl Rembo</option>
                        <option value="Fransiscus Yura">Fransiscus Yura</option>
                        <option value="Fredericksen">Fredericksen</option>
                        <option value="Fredy Mercury">Fredy Mercury</option>
                    </select>
                </div>

                <div class="input-placeholder d-flex align-items-center">
                    <label for="month" style=" font-weight: normal; font-style: normal;">Month</label>
                    <select class="form-select" name="month" id="month" required>
                        <option value="" disabled selected>Month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>

                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="new">New</label>
                    <input type="number" name="new" id="new" placeholder="New" required>
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="upgrade">Upgrade</label>
                    <input type="number" name="upgrade" id="upgrade" placeholder="Upgrade" required>
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="churn">Churn</label>
                    <input type="number" name="churn" id="churn" placeholder="Churn" required>
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="downgrade">Downgrade</label>
                    <input type="number" name="downgrade" id="downgrade" placeholder="Downgrade" required>
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
        data-click-to-select="true"
        data-pagination="true"
        data-sortable="true"
        data-search="true"
        data-data-field="items"
        data-show-columns="true"
        data-show-export="true"
        data-url="{{route('getDatas')}}"
        data-page-list="[10, 25, 50, 100]">
        <thead>
            <tr>
                {{-- <th data-field="state" data-checkbox="true" data-cell-style="cellStyle"></th> --}}
                <th data-field="name"  data-sortable="true" data-cell-style="cellStyle">Name</th>
                <th data-field="spv"  data-sortable="true" data-cell-style="cellStyle">Supervisor</th>
                <th data-field="month" data-formatter="formatDate" data-sortable="true" data-cell-style="cellStyle">Month</th>
                <th data-field="new" data-formatter="formatNumberPrice" data-sortable="true" data-cell-style="cellStyle">New</th>
                <th data-field="upgrade" data-formatter="formatNumberPrice" data-sortable="true" data-cell-style="cellStyle">Upgrade</th>
                <th data-field="churn" data-formatter="formatNumberPrice" data-sortable="true" data-cell-style="cellStyle">Churn</th>
                <th data-field="downgrade" data-formatter="formatNumberPrice" data-sortable="true" data-cell-style="cellStyle">Downgrade</th>
                <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents" data-cell-style="cellStyle" data-width="90">Events</th>
            </tr>
        </thead>
    </table>
</div>




<script>
    var $table = $('#table')
    $(document).ready( function () {
        var da = {!! json_encode($data->toArray()) !!}
        $table.bootstrapTable({data: da})
    });

    function formatDate(value, row, index) {
        switch (value) {
            case 1:
                return ['January'];
                break;
            case 2:
                return ['February'];
                break;
            case 3:
                return ['March'];
                break;
            case 4:
                return ['April'];
                break;
            case 5:
                return ['May'];
                break;
            case 6:
                return ['June'];
                break;
            case 7:
                return ['July'];
                break;
            case 8:
                return ['August'];
                break;
            case 9:
                return ['September'];
                break;
            case 10:
                return ['October'];
                break;
            case 11:
                return ['November'];
                break;
            case 12:
                return ['December'];
                break;
            default:
                return [value]
                break;
        }
    }

    function formatNumberPrice(value, row, index) {
        var num = Intl.NumberFormat('en-US', { style: 'currency', currency: 'IDR' }).format(value);
        return [num];
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
            // alert('You click like action, row: ' + JSON.stringify(row))
            $("#update").show();
            var name = document.getElementById("table-name-update");
            var spv = document.getElementById("table-spv-update");
            var month = document.getElementById("table-month-update");
            var news = document.getElementById("table-new-update");
            var upgrade = document.getElementById("table-upgrade-update");
            var churn = document.getElementById("table-churn-update");
            var downgrade = document.getElementById("table-downgrade-update");
            var idItem = document.getElementById("ids-update");

            idItem.value = row.id + ""
            spv.value = row.spv
            month.value = row.month

            name.value = row.name + ""
            news.value = row.new
            upgrade.value = row.upgrade
            churn.value = row.churn
            downgrade.value = row.downgrade

        },
        'click .remove': function (e, value, row, index) {

            $('#delete').show();
            var name = document.getElementById("table-name");
            var spv = document.getElementById("table-spv");
            var month = document.getElementById("table-month");
            var news = document.getElementById("table-new");
            var upgrade = document.getElementById("table-upgrade");
            var churn = document.getElementById("table-churn");
            var downgrade = document.getElementById("table-downgrade");
            var idItem = document.getElementById("ids");
            // var id-item =
            console.log(row.id)
            idItem.value = row.id + ""
            name.innerHTML = row.name
            spv.innerHTML = row.spv
            news.innerHTML = Intl.NumberFormat('en-US', { style: 'currency', currency: 'IDR' }).format(row.new)
            upgrade.innerHTML = Intl.NumberFormat('en-US', { style: 'currency', currency: 'IDR' }).format(row.upgrade)
            churn.innerHTML = Intl.NumberFormat('en-US', { style: 'currency', currency: 'IDR' }).format(row.churn)
            downgrade.innerHTML = Intl.NumberFormat('en-US', { style: 'currency', currency: 'IDR' }).format(row.downgrade)
            switch (row.month) {
                case 1:
                    month.innerHTML = 'January';
                    break;
                case 2:
                    month.innerHTML = 'February';
                    break;
                case 3:
                    month.innerHTML = 'March';
                    break;
                case 4:
                    month.innerHTML = 'April';
                    break;
                case 5:
                    month.innerHTML = 'May';
                    break;
                case 6:
                    month.innerHTML = 'June';
                    break;
                case 7:
                    month.innerHTML = 'July';
                    break;
                case 8:
                    month.innerHTML = 'August';
                    break;
                case 9:
                    month.innerHTML = 'September';
                    break;
                case 10:
                    month.innerHTML = 'October';
                    break;
                case 11:
                    month.innerHTML = 'November';
                    break;
                case 12:
                    month.innerHTML = 'December';
                    break;
                default:
                    month.innerHTML = row.month;
                    break;
            }


            // $table.bootstrapTable('remove', {
            //     field: 'id',
            //     values: [row.id]
            // });

        }
    }

    $(function() {
        $('#toolbar').find('select').change(function (val, a) {
            var selected = $('select').val()
            var sel = selected.substring(0, 8)
            var monthVal = selected.substring(8)
            var da = {!! json_encode($data->toArray()) !!}
            // $table.bootstrapTable('uncheckAll')
            $table.bootstrapTable('destroy').bootstrapTable({
                data: da,
                exportDataType: sel == 'selected' ? 'selected' : 'all',
                exportTypes: ['json', 'xml', 'csv', 'txt', 'sql', 'excel', 'pdf'],

            })
            setTimeout(() => {
                $table.bootstrapTable('checkBy', {field: 'month', values: monthVal})
                console.log('asdfasdfa');
            }, 1000);
        });
    })

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

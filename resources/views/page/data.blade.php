@extends('layout.master')
@section('content')
<link rel="stylesheet" href="assets/css/data/style.css">

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

<div id="add" class="opacity add">
    <div class="box-modal">
        <form action="">
            <div class="top">
                <h3 style="">Add Revenue Data</h3>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="">Supervisor Name</label>
                    <input type="text" name="" id="" placeholder="Supervisor Name">
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="" style=" font-weight: normal; font-style: normal;">Month</label>
                    <input type="text" name="" id="" placeholder="Month">
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="">New</label>
                    <input type="text" name="" id="" placeholder="New">
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="">Upgrade</label>
                    <input type="text" name="" id="" placeholder="Upgrade">
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="">Churn</label>
                    <input type="text" name="" id="" placeholder="Churn">
                </div>
                <div class="input-placeholder d-flex align-items-center">
                    <label for="">Downgrade</label>
                    <input type="text" name="" id="" placeholder="Downgrade">
                </div>
            </div>
            <div class="bottom d-flex align-items-center justify-content-end">
                <p id="button-close" class="outlined-button">Cancel</p>
                <button class="reguler-button"  type="submit">Add Data</button>
            </div>
        </form>
    </div>
</div>


<div class="containerize-tables">
    <table
        id="table"

        data-toolbar="#toolbar"
        data-show-toggle="false"
        {{-- data-show-columns="true" --}}
        {{-- data-toolbar-align="" --}}
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
                <th data-field="spv"  data-sortable="true" data-cell-style="cellStyle">Supervisor</th>
                <th data-field="month" data-sortable="true" data-cell-style="cellStyle">Month</th>
                <th data-field="new" data-sortable="true" data-cell-style="cellStyle">New</th>
                <th data-field="upgrade" data-sortable="true" data-cell-style="cellStyle">Upgrade</th>
                <th data-field="churn" data-sortable="true" data-cell-style="cellStyle">Churn</th>
                <th data-field="downgrade" data-sortable="true" data-cell-style="cellStyle">Downgrade</th>
                <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents" data-cell-style="cellStyle" data-width="100">Events</th>
            </tr>
        </thead>
    </table>
</div>




<script>
    var $table = $('#table')
    $(document).ready( function () {
        var da = {!! json_encode($data->toArray()) !!}
        $table.bootstrapTable({data: da})
    } );



    function operateFormatter(value, row, index) {
        return [
            '<a class="like" href="javascript:void(0)" title="Like">',
            '<i class="fa fa-heart"></i>',
            '</a>  ',
            '<a class="remove" href="javascript:void(0)" title="Remove">',
            '<i class="bi bi-trash"></i>',
            '</a>'
        ].join('')
    }

    window.operateEvents = {
        'click .like': function (e, value, row, index) {
            alert('You click like action, row: ' + JSON.stringify(row))
        },
        'click .remove': function (e, value, row, index) {
            $table.bootstrapTable('remove', {
                field: 'id',
                values: [row.id]
            });

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
</script>

@endsection

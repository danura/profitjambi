@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')

    <link href="{{ asset('public/assets/vendor/datetimepicker/css/classic.css') }}" rel="stylesheet" />
	<link href="{{ asset('public/assets/vendor/datetimepicker/css/classic.time.css') }}" rel="stylesheet" />
	<link href="{{ asset('public/assets/vendor/datetimepicker/css/classic.date.css') }}" rel="stylesheet" />

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Body & Paint Care</h3>

            </div>
           
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Price List Body & Paint</h4>
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#exampleSmallModal">
                                    <i class="fa fa-plus"></i>
                                        Kalkulasi Data
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="display datatable table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>ITEM</th>
                                            <th>PRICE</th>
                                            <th>KETERANGAN</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <div class="modal fade" id="exampleSmallModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">Kalkulasi Biaya Body & Paint Care</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addunit">
                    <div class="modal-body">
                   
                        {{csrf_field()}}
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <select class="form-select" name="optjobid" id="optjobid" required>
                                    <option value=""> PILIH PEKERJAAN </option>
                                </select>
                            </div>
                            <div class="col-sm-4 ">
                                <input type="text" class="form-control" id="optjobprice" name="optjobprice"  placeholder="Harga Pekerjaan" autocomplete="off" readonly>
                                <input type="hidden"  id="optjobname" name="optjobname" readonly>
                            </div>

                            <div class="col-sm-4">
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-primary " id="addtorows">Add</button>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="table-responsive">
                                <table id="kalkulasi" class="display table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>ITEM</th>
                                            <th>PRICE</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan='2' align='center'>TOTAL</td>
                                            <td><span id="totalSum">0.00</span></td>
                                        </tr>
                                        
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                       
                    </div>
                    <div class="modal-footer">
                        <!--<button type="submit" class="btn btn-primary">Register</button>-->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('public/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/datetimepicker/js/legacy.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/datetimepicker/js/picker.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/datetimepicker/js/picker.time.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/datetimepicker/js/picker.date.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            GenerateTable();
            LoadThisJobPaint();

            let counter = 1;
            let sum = 0;
            $('#addtorows').on('click', function () {

                var optjobname = $('#optjobname').val();
                var optjobprice = parseInt($('#optjobprice').val());

                sum += optjobprice;
                //var price = parseFloat($('#price').val());

                // Check if values are valid
                //if (isNaN(quantity) || isNaN(price)) {
                   // alert("Please enter valid numbers for both quantity and price.");
                    //return;
               // }

                // Calculate total
                /////var total = quantity * price;
                
               var newRow = `
                <tr>
                    <td>${counter}</td> <!-- Counter number -->
                    <td>${optjobname}</td> <!-- Example Name -->
                    <td>${formatMoney(optjobprice)}</td> <!-- Example Age -->
                </tr>`;

                // Append the new row to the table's tbody
                $('#kalkulasi tbody').append(newRow);
                $('#totalSum').text(formatMoney(sum));
                counter++;

                $('#optjobname').val('');
                $('#optjobprice').val('');
            });
        });

        function formatMoney(amount) {
            var formattedAmount = parseFloat(amount); 
            return 'Rp. ' + parseFloat(amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            
        }

       
        ////////return '$' + formattedAmount.slice(0, -3).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        ///////return '$' + formattedAmount.replace(/\d(?=(\d{3})+\.)/g, '$&,');
    

        function LoadThisJobPaint() {
            $.getJSON("{{ URL('/admin/bodypaint/joblist/') }}", function(result){
                $("#optjobid").empty();
                $("#optjobid").append('<option value="">PILIH PEKERJAAN</option>');
                $.each(result,function(key,value){
                    $("#optjobid").append('<option value="'+key+'">'+value+'</option>');
                });
            });
        }

        $('#optjobid').on('change', function () {
            var selectedValue = $(this).val();
            var selectedText = $(this).find("option:selected").text();
            var selectedValue = $(this).val();
            $('#optjobprice').val(selectedValue); // selectedText
            $('#optjobname').val(selectedText);
        });

       
        var dataTable;
        function GenerateTable(){
            dataTable = $('.datatable').DataTable({
                oLanguage: {
                    sProcessing: "<div class='spinner-border text-primary' role='status'> <span class='visually-hidden'>Loading...</span></div><div class='spinner-border text-warning' role='status'> <span class='visually-hidden'>Loading...</span></div>"
                },
                responsive: false,
                bDeferRender: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
                ordering:false,
                "order": [[ 2, "ASC" ]],
                bFilter: false,
                bInfo: false,

                ajax: {
                    url: "{{ route('listbp') }}",
                    dataType: "json",
                    type: "POST",
                    data: function (d) {
                        d.search = $('input[type="search"]').val();
                        d.unitmodel = $('#optmodel').val();
                        d.unittype = $('#opttype').val();
                        d._token = "{{csrf_token()}}";
                    }
                },
                columns: [
                    {data: 'DT_RowIndex',},
                    {data: 'item', name: 'item'},
                    {data: 'price', name: 'price'},
                    {data: 'desc', name: 'desc'},
                ]
            });

        }

        $('#ngserc').click(function(e){
            dataTable.draw();
        });

        function reload_table()
        {
            dataTable.ajax.reload(null,false); //reload datatable ajax
        }

        

    </script>

@endsection

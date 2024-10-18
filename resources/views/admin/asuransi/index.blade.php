@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')

    <link href="{{ asset('public/assets/vendor/datetimepicker/css/classic.css') }}" rel="stylesheet" />
	<link href="{{ asset('public/assets/vendor/datetimepicker/css/classic.time.css') }}" rel="stylesheet" />
	<link href="{{ asset('public/assets/vendor/datetimepicker/css/classic.date.css') }}" rel="stylesheet" />

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Data Reminder Asuransi</h3>
                
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <select class="form-control" name="optmodel" id="optmodel">
                                        <option value="">SEMUA MODEL </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <select class="form-control" name="opttype" id="opttype">
                                        <option value="">SEMUA TYPE </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <button type="button" id="ngserc" class="btn btn-danger mb-2 btn-block">
                                        <i class="fas fa-search"></i> Display Data
                                    </button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table
                                    id="dataTable"
                                    class="display datatable table table-striped table-hover table-bordered"
                                >
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NO RANGKA</th>
                                            <th>MODEL</th>
                                            <th>WARNA</th>
                                            <th>TGL ASURANSI</th>
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


    <script src="{{ asset('public/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/datetimepicker/js/legacy.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/datetimepicker/js/picker.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/datetimepicker/js/picker.time.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/datetimepicker/js/picker.date.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('.datepicker').pickadate({
                selectMonths: true,
                selectYears: true,
                format: 'yyyy-mm-dd',
                min: -100
            });

            LoadComboAllModel();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
           
            
        });

        function LoadComboAllModel() {
            var roleid = $("#roleid").val();
            $.getJSON("{{ URL('/admin/dropmodel/') }}", function(result){
                $("#optmodel").empty();
                $("#optmodel").append('<option value="">SEMUA MODEL</option>');
                $.each(result,function(key,value){
                    $("#optmodel").append('<option value="'+key+'">'+value+'</option>');
                });
            }).done(GenerateTable);
        }

        $('#optmodel').on('change',function(e) {
            var optmodel = $("#optmodel").val();
            $.getJSON("{{ URL('/admin/dropdowntype/') }}/"+optmodel, function(result){
                $("#opttype").empty();
                $("#opttype").append('<option value="">PILIH TYPE</option>');
                $.each(result,function(key,value){
                    $("#opttype").append('<option value="'+key+'">'+value+'</option>');
                });
            });
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
                    url: "{{ route('listvehicle') }}",
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
                    {data: 'norangka', name: 'norangka'},
                    {data: 'model', name: 'model'},
                    {data: 'warna', name: 'warna'},
                    {data: 'tglbeli', name: 'tglbeli'},
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
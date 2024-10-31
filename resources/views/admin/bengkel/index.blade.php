@extends('layouts.app', ['title' => 'Dashboard'])
@section('content')

    <link href="{{ asset('public/assets/vendor/datetimepicker/css/classic.css') }}" rel="stylesheet" />
	<link href="{{ asset('public/assets/vendor/datetimepicker/css/classic.time.css') }}" rel="stylesheet" />
	<link href="{{ asset('public/assets/vendor/datetimepicker/css/classic.date.css') }}" rel="stylesheet" />

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Data Reminder Service</h3>
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
                                    <div class="d-grid gap-2">
                                        <button type="button" id="ngserc" class="btn btn-danger mb-2 btn-block">
                                            <i class="fas fa-search"></i> Display Data
                                        </button>
                                    </div>
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
                                <table id="dataTable" class="display datatable table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NO RANGKA</th>
                                            <th>MODEL</th>
                                            <th>WARNA</th>
                                            <th>LAST SERVICE</th>
                                            <th>NEXT SERVICE</th>
											
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
	
	<div class="modal fade hide in" id="SyncModalData" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Konfirmasi </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="frmsyncdata">
                    {{csrf_field()}}
                    <input type="hidden" readonly id="fu_no_rangka" name="fu_no_rangka">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <p id="titleWord">Apakah anda ingin melakukan sinkronisasi untuk unit ini ?</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btnYes">Ya</button>
                        <button type="button" class="btn btn-secondary" id="btnNo" data-bs-dismiss="modal">Tidak</button>

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
            LoadComboAllModel();

             $.notify({
                icon: 'icon-bell',
                title: 'Info Service, +628117483800',
                message: '<a href="https://wa.me/+628117483800" target="_blank">'+'Segera Hubungi MRA Kami Klik Disini</a>',
            },{
                type: 'secondary',
                placement: {
                    from: "bottom",
                    align: "right"
                },
                time: 1000,
            });
		
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $("#frmsyncdata").submit(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    data: $('#frmsyncdata').serialize(),
                    url: "{{URL('/admin/bengkel/prosesSync/')}}",
                    type: "POST",
                    dataType: 'json',
					beforeSend: function(){
						$("#btnYes, #btnNo").attr("disabled", true);
						$("#btnYes, #btnNo").html("Loading");
						$('#SyncModalData').modal({backdrop: 'static', keyboard: false})
					},
                    success: function (data) {						
						$("#btnYes, #btnNo").removeAttr("disabled");
						$("#btnYes").html("Ya");
						$("#btnNo").html("Tidak");
						
                        swal("Sinkronisasi data kendaraan berhasil!", {
                            buttons: {
                                confirm: {
                                className: "btn btn-success",
                                },
                            },
                        });
                        $('#SyncModalData').modal('hide');
                        reload_table();
                        $('#frmsyncdata').trigger("reset");
                    },
                    error: function (data) {
                        alert("ada Error Kirim Data ke Server");
                    }
                });
            });
        });
		
		function syncData(norangka){
			$("#fu_no_rangka").val(norangka);
			$("#SyncModalData").modal("show");
			$("#titleWord").html('Apakah anda ingin melakukan sinkronisasi untuk unit dengan no. rangka <b>'+norangka+'</b> ?');
		}
        
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
                lengthChange: true,
                ordering:false,
                "order": [[ 2, "ASC" ]],
                bFilter: false,
                bInfo: false,

                ajax: {
                    url: "{{ route('listbengkel') }}",
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
                    {data: 'lastservice', name: 'lastservice'},
                    {data: 'nextservice', name: 'nextservice'},
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

        function getDetailUnit(fu_id){
			window.location.href = "{{ URL('/admin/vehicle/detail/') }}/"+fu_id;
		}

    </script>


@endsection
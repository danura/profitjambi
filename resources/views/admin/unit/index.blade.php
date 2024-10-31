@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')

    <link href="{{ asset('public/assets/vendor/datetimepicker/css/classic.css') }}" rel="stylesheet" />
	<link href="{{ asset('public/assets/vendor/datetimepicker/css/classic.date.css') }}" rel="stylesheet" />

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Database Vehicle</h3>
                
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
                                        <button type="button" id="ngserc" class="btn btn-danger mb-2 btn-blk">
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
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Unit Terdaftar</h4>
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#exampleSmallModal">
                                    <i class="fa fa-plus"></i>
                                        Tambah Unit
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTable" 
                                class="display table table-striped table-hover datatable table-head-bg-info ">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>UNIT</th>
                                            <th>STNK</th>
                                            <th>LAST SERVICE</th>
                                            <th>ASURANSI</th>
                                            <th>CLIENT</th>
											<th>DETAIL</th>
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
                    <h5 class="modal-title">Add Unit Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addunit">
                    <div class="modal-body">
                   
                        {{csrf_field()}}
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="inputEnterYourName" class="col-form-label">Apakah Unit Beli di AT ?</label>
                                <select class="form-select" name="buyonat" id="buyonat" required>
                                    <option value=""> PILIH PEMBELIAN </option>
                                    <option value="1"> Ya, Unit Ini Beli di Agung Toyota </option>
                                    <option value="2"> Tidak, Unit Dibeli Diluar AT  </option>
                                </select>
                            </div>

                            <div class="col-sm-6 buyinat">
                                <label for="inputEnterYourName" class="col-form-label">No Rangka</label>
                                <input type="text" class="form-control" id="norangka" name="norangka"  placeholder="Masukan No Rangka" autocomplete="off">
                            </div>
                        </div>

                        <div class="row mb-3 nonauto">
                            <div class="col-sm-6">
                                <label for="inputEnterYourName" class="col-form-label">No Rangka</label>
                                <input type="text" class="form-control" id="othnorangka" name="othnorangka"  placeholder="Masukan No Rangka" autocomplete="off">
                            </div>
                            <div class="col-sm-6">
                                <label for="inputEnterYourName" class="col-form-label">No Polisi</label>
                                <input type="text" class="form-control" id="othnopol" name="othnopol"  placeholder="Masukan No Polisi" autocomplete="off">
                            </div>
                        </div>

                        <div class="row mb-3 nonauto">
                            <div class="col-sm-4">
                                <label for="inputEnterYourName" class="col-form-label">Model</label>
                                <input type="text" class="form-control" id="othmodel" name="othmodel"  placeholder="Model Kendaraan" autocomplete="off">
                            </div>
                            <div class="col-sm-4">
                                <label for="inputEnterYourName" class="col-form-label">Type</label>
                                <input type="text" class="form-control" id="othtype" name="othtype"  placeholder="Type Kendaraan" autocomplete="off">
                            </div>
                            <div class="col-sm-4">
                                <label for="inputEnterYourName" class="col-form-label">Warna</label>
                                <input type="text" class="form-control" id="othwarna" name="othwarna"  placeholder="Warna Kendaraan" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Register</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

     <div class="modal fade" id="EditModalData" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Detail Unit </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="detailunit">
                    {{csrf_field()}}
                    <input type="hidden" readonly id="fu_id" name="fu_id">
                 
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <label for="inputEnterYourName" class="col-form-label">No Rangka</label>
                                <input type="text" class="form-control" id="fu_no_rangka" name="fu_no_rangka"  placeholder="No Rangka" autocomplete="off" readonly>
                            </div>
                            <div class="col-sm-4">
                                <label for="inputEnterYourName" class="col-form-label">No Polisi</label>
                                <input type="text" class="form-control" id="fu_no_pol" name="fu_no_pol"  placeholder="No Polisi" autocomplete="off">
                            </div>
                             <div class="col-sm-4">
                                <label for="inputEnterYourName" class="col-form-label">Tanggal Next Service</label>
                                <input type="text" class="form-control datepicker" id="fu_tgl_next_service" name="fu_tgl_next_service"  placeholder="Last Service" autocomplete="off">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <label for="inputEnterYourName" class="col-form-label">Model</label>
                                <input type="text" class="form-control" id="fu_model" name="fu_model"  placeholder="Model" autocomplete="off" readonly>
                            </div>
                            <div class="col-sm-4">
                                <label for="inputEnterYourName" class="col-form-label">Type</label>
                                <input type="text" class="form-control" id="fu_type" name="fu_type"  placeholder="Type" autocomplete="off" readonly>
                            </div>
                            <div class="col-sm-4">
                                <label for="inputEnterYourName" class="col-form-label">Warna</label>
                                <input type="text" class="form-control" id="fu_color" name="fu_color"  placeholder="Warna" autocomplete="off" readonly>
                            </div>
                        </div>
                         <div class="row mb-3">
                            <div class="col-sm-3">
                                <label for="inputEnterYourName" class="col-form-label">Tanggal Beli</label>
                                <input type="text" class="form-control datepicker" id="fu_tgl_bp" name="fu_tgl_bp"  placeholder="Tanggal BP / Faktur" autocomplete="off">
                            </div>
                            <div class="col-sm-3">
                                <label for="inputEnterYourName" class="col-form-label">Tanggal STNK</label>
                                <input type="text" class="form-control datepicker" id="fu_tgl_stnk" name="fu_tgl_stnk"  placeholder="Tanggal STNK" autocomplete="off">
                            </div>
                            <div class="col-sm-3">
                                <label for="inputEnterYourName" class="col-form-label">Tanggal BPKB</label>
                                <input type="text" class="form-control datepicker" id="fu_tgl_bpkb" name="fu_tgl_bpkb"  placeholder="Tanggal BPKB" autocomplete="off">
                            </div>
                            <div class="col-sm-3">
                                <label for="inputEnterYourName" class="col-form-label">Tanggal Service Terakhir</label>
                                <input type="text" class="form-control datepicker" id="fu_tgl_last_service" name="fu_tgl_last_service"  placeholder="Last Service" autocomplete="off">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="inputEnterYourName" class="col-form-label">Client</label>
                                <input type="text" class="form-control" id="fu_client" name="fu_client"  placeholder="Client" autocomplete="off">
                            </div>

                             <div class="col-sm-6">
                                <label for="inputEnterYourName" class="col-form-label">Client Keterangan</label>
                                <textarea class="form-control" id="fu_client_note" name="fu_client_note"  placeholder="Client Notes" autocomplete="off"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">UPDATE DATA</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
	
	<div class="modal fade" id="DeleteModalData" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Konfirmasi Hapus </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="frmhapusunit">
                    {{csrf_field()}}
                    <input type="hidden" readonly id="fu_id_del" name="fu_id">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                Apakah anda ingin menghapus data ini ?
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Ya</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>

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
            $("#addunit").submit(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    data: $('#addunit').serialize(),
                    url: "{{URL('/admin/vehicle/store/')}}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        swal("Data Sukses Disimpan!", {
                            buttons: {
                                confirm: {
                                className: "btn btn-success",
                                },
                            },
                        });
                        $('#exampleSmallModal').modal('hide');
                        reload_table();
                        $('#addunit').trigger("reset");
                    },
                    error: function (data) {
                        alert("ada Error Kirim Data ke Server");
                    }
                });
            });

            $("#detailunit").submit(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var data = new FormData($('#detailunit')[0]);
                $.ajax({
                    url: "{{route('updatevehicle')}}",
                    type: "POST",
                    data:new FormData(this),
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    success: function (data) {
                        $('#EditModalData').modal('hide');
                        $('#detailunit').trigger("reset");
                        reload_table();
                        swal("Data Sukses Disimpan!", {
                            buttons: {
                                confirm: {
                                className: "btn btn-success",
                                },
                            },
                        });

                    },
                    error: function (data) {
                        alert("ada Error Kirim Data ke Server");
                        reload_table();
                    }
                });
            });
			
			
			 $("#frmhapusunit").submit(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var data = new FormData($('#frmhapusunit')[0]);
                $.ajax({
                    url: "{{route('deletevehicle')}}",
                    type: "POST",
                    data:new FormData(this),
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    success: function (data) {
                        $('#DeleteModalData').modal('hide');
                        $('#frmhapusunit').trigger("reset");
                        reload_table();
                        swal("Data Telah Dihapus!", {
                            buttons: {
                                confirm: {
                                className: "btn btn-success",
                                },
                            },
                        });

                    },
                    error: function (data) {
                        alert("ada Error Kirim Data ke Server");
                        reload_table();
                    }
                });
            });
            
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
                lengthChange: true,
                ordering:false,
                "order": [[ 2, "ASC" ]],
                bFilter: true,
                bInfo: true,

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
                    
                   
                    
                    {data: 'tglstnk', name: 'tglstnk'},
                    {data: 'tgllast', name: 'tgllast'},
                    {data: 'tglinsurance', name: 'tglinsurance'},
                    {data: 'client', name: 'client'},
                    {data: 'action', name: 'action'},
                   
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

        $(function() {
            $('.buyinat').hide();
            $('.nonauto').hide();
            $('#buyonat').change(function(){
                if($('#buyonat').val() == '1'){
                    $('.buyinat').show();
                    $('.nonauto').hide();
                }else{
                    $('.buyinat').hide();
                    $('.nonauto').show();
                }
            });
        });

        
        $('body').on('click', '#getDataCustId', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $(".datepicker").attr("readonly", false); 
            $.ajax({
                url: "{{ URL('/admin/vehicle/editdata/') }}/"+id,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('[name="fu_no_rangka"]').val(data.fu_no_rangka);
                    $('[name="fu_no_pol"]').val(data.fu_no_pol);
                    $('[name="fu_model"]').val(data.fu_model);
                    $('[name="fu_type"]').val(data.fu_type);
                    $('[name="fu_color"]').val(data.fu_color);
                    $('[name="fu_tgl_bp"]').val(data.fu_tgl_bp);
                    $('[name="fu_tgl_bpkb"]').val(data.fu_tgl_bpkb);
                    $('[name="fu_tgl_stnk"]').val(data.fu_tgl_stnk);
                    $('[name="fu_tgl_last_service"]').val(data.fu_tgl_last_service);
                    $('[name="fu_tgl_next_service"]').val(data.fu_tgl_next_service);
                    $('[name="fu_id"]').val(data.fu_id);
                    $('[name="fu_client"]').val(data.fu_client);
                    $('[name="fu_client_note"]').val(data.fu_client_note);
          
                }
            });

            $('#EditModalData').modal('show');
        });
		
		function getDetailUnit(fu_id){
			window.location.href = "{{ URL('/admin/vehicle/detail/') }}/"+fu_id;
		}
		
		function hapusUnit(fu_id){
			$("#DeleteModalData").modal("show");
			$("#fu_id_del").val(fu_id);
		}

    </script>

@endsection
@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
 <link href="{{ asset('public/assets/vendor/datetimepicker/css/classic.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/vendor/datetimepicker/css/classic.time.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/vendor/datetimepicker/css/classic.date.css') }}" rel="stylesheet" />
<style>
/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 12px 14px;
  transition: 0.3s;
  font-size: 14px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #2a2f5b;
  color: white;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 10px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
<div class="container">
	<div class="page-inner">
		<div class="page-header">
			<h3 class="fw-bold mb-3">Data Kendaraan Anda</h3>
			
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="card shadow mb-4">
					<div class="card-body">
						<div class="tab">
							<button class="tablinks" onclick="openCity(event, 'unit')" id="defaultOpen">Informasi Unit</button>
							<button class="tablinks" onclick="openCity(event, 'history')">History Service</button>
							<button class="tablinks" onclick="openCity(event, 'appraise')">Harga Mobil Bekas</button>
							<button class="tablinks" onclick="openCity(event, 'priceservice')">Biaya Service</button>
						</div>
						
						<div class="tabcontent" id="unit">
							<div class="row mb-4 nonauto">
								@if($row->fu_no_pol != '')	
									<div class="col-sm-12">
										<table class="table table-bordered table-hover">
											<tr>
												<td> <h3>{{strtoupper($row->fu_no_pol)}}</h3> </td>
											</tr>
										</table>
									</div>
								@endif
								
								<div class="col-sm-12">
									<div class="row mb-4 nonauto">
										<div class="col-sm-7">
											<input type="hidden" id="norangka" value="{{ $row->fu_no_rangka }}">
											<input type="hidden" id="fu_model" value="{{ $row->fu_model }}">
											<table class="table table-bordered table-hover">
												<tr>
													<th width="40%">Model</th>
													<td> {{$row->fu_model}} {{strtoupper($row->fu_type)}} </td>
												</tr>
												<tr>
													<th>Nomor Rangka</th>
													<td> {{$row->fu_no_rangka}} </td>
												</tr>
												<tr>
													<th>Warna</th>
													<td> {{$row->fu_color}} </td>
												</tr>
												
												<tr>
													<th>Tanggal Beli</th>
													<td> {{$row->fu_tgl_bp}} <br>  
														@if($row->usiaunit > 3) 
															<span class="badge bg-danger w-100">{{ $row->usiaunit }} Tahun</span> 
														@else
															<span class="badge bg-info w-100">{{ $row->usiaunit }} Tahun</span>
														@endif
													</td>
												</tr>
												
												<tr>
													<th>Tanggal BPKB</th>
													<td> {{$row->fu_tgl_bpkb}} </td>
												</tr>
												<tr>
													<th>Tanggal STNK</th>
													<td> {{$row->fu_tgl_stnk}} </td>
												</tr>
												<tr>
													<th>Tanggal Service Terakhir</th>
													<td> {{$row->fu_tgl_last_service}} </td>
												</tr>
												<tr>
													<th>Tanggal Service Berikutnya</th>
													<td> {{$row->fu_tgl_next_service}} </td>
												</tr>
											</table>
										</div>
										<div class="col-sm-5">
											
                							<div class="card">
												<div class="card-header">
													<div class="card-title"></div>
												</div>
												<div class="card-body">
													<div class="card-sub">
														@if(!empty($row->fu_image))
															<img src="{{ asset('public/assets/img/unit/')."/".$row->fu_image}}" alt="navbar brand" class="img-fluid"  height="189"/>
														@else
															<img src="{{ asset('public/assets/img/unit/noimg.png') }}" alt="navbar brand"  height="189"/>  
														@endif
													</div>
													
                  								</div>
                							</div>
              							</div>
									</div>
								</div>
							</div>
							<div class="row mb-4 nonauto">
								<div class="col-sm-2">
									<button class="btn btn-danger btn-sm" type="button" id="btnBack">
										<i class="fas fa-arrow-left"></i> Back
									</button>
								</div>
							</div>
						</div>
						<div class="tabcontent" id="history">
							<div class="card-body">
								<div class="table-responsive">
									<table id="datatable" class="display datatable table table-striped table-hover table-bordered" width="100%">
										<thead>
											<tr>
												<th><div align="center">No.</div></th>
												<th><div align="center">Nopol</div></th>
												<th><div align="center">Repair Type</div></th>
												<th><div align="center">Repair Date</div></th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>	
								</div>
							</div>
						</div>

						<div class="tabcontent" id="appraise">
							<div class="card-body">
								<div class="table-responsive">
									<table id="" class="display datatable table table-striped table-hover table-bordered" width="100%">
										<thead>
											<tr>
												<th><div align="center">NO</div></th>
												<th><div align="center">HARGA</div></th>
												<th><div align="center">TANGGAL</div></th>
												<th><div align="center">LOKASI</div></th>
												<th><div align="center">APPRAISE BY</div></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th><div align="center">1</div></th>
												<th><div align="center">{{ number_format($row->fu_appraise_price,0,",",".") }} </div></th>
												<th><div align="center">{{$row->fu_appraise_date}}</div></th>
												<th><div align="center">{{$row->fu_appraise_location}}</div></th>
												<th><div align="center">{{$row->fu_appraise_by}}</div></th>
											</tr>
										</tbody>
									</table>	
								</div>
							</div>
						</div>


						<div class="tabcontent" id="priceservice">
							<div class="card-body">
								<div class="table-responsive">
									<table id="datatableapp" class="display datatable table table-striped table-hover table-bordered" width="100%">
										<thead>
											<tr>
												<th>NO</th>
												<th>MODEL</th>
												<th>KM</th>
												<th>JASA</th>
												<th>PART</th>
												<th>TOTAL</th>
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
		$(document).ready(function(){
			document.getElementById("defaultOpen").click();
			
			$("#btnBack").click(function(){
				window.location.href = "{{ URL('admin/vehicle') }}";
			});
			
			
			hist_service();
			getDataBiayaService();

			
		});
 
		function hist_service(){
			var norangka = $("#norangka").val();
			var dataTable = $('#datatable').DataTable({
				"processing": true,
				"serverSide": true,
				"bLengthChange": false,
				"searching": false,
				"destroy": true,
				stateSave: false,
				pageLength: 10,
				"ajax":{
						"url": "{{ route('histservice') }}",
						"dataType": "json",
						"type": "GET",
						"data": {
								_token: "{{csrf_token()}}",
								norangka:norangka,
							}
					},
				"columns": [
					{
						"data": "no"
					},
					{
						"data": "police_no"
					},
					{
						"data": "repair_type"
					},
					{
						"data": "repair_date"
					},
				],
			});
			
			dataTable.ajax.reload(null,false);
		}

		function getDataBiayaService(){
			var dataTables = $('#datatableapp').DataTable({
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
						url: "{{ route('listpriceservice') }}",
						dataType: "json",
						type: "POST",
						data: function (d) {
							d.search = $('input[type="search"]').val();
							d.modelid = $('#fu_model').val();
							d._token = "{{csrf_token()}}";
						}
					},
					columns: [
						{data: 'DT_RowIndex',},
						{data: 'model', name: 'model'},
						{data: 'km', name: 'km'},
						{data: 'jasa', name: 'jasa'},
						{data: 'part', name: 'part'},
						{data: 'total', name: 'total'},
					]
			});
		}
 
		function openCity(evt, cityName) {
			var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent");
			for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			}
			tablinks = document.getElementsByClassName("tablinks");
			for (i = 0; i < tablinks.length; i++) {
				tablinks[i].className = tablinks[i].className.replace(" active", "");
			}
			document.getElementById(cityName).style.display = "block";
			evt.currentTarget.className += " active";  
		}

 	</script>
@endsection
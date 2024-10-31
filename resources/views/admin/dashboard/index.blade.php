@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')

    <?php 
        $percent_service  = ($services / $units) * 100;
        $percent_stnk = ($stnk / $units ) * 100;
        $percent_insu = ($insurance / $units ) * 100;

    ?>
    <link href="{{ asset('public/assets/vendor/fullcalendar/css/main.min.css') }}" rel="stylesheet" />
    <style>
        .fc-toolbar .fc-button {
            background: #000000;
            border: 0;
            text-shadow: none !important;
            padding: 8px 12px;
            height: auto;
            font-size: 1.04em;
        }
      
    </style>

    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h6 class="op-7 mb-2">Dashboard Fleet users</h6>
                </div>
                
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Unit Terdaftar</p>
                                        <h4 class="card-title">{{ $units }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small" >
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Need Service</p>
                                        <h4 class="card-title">{{ $services }}  | <small class="text-danger">{{  number_format($percent_service,0,",",".") }}%</small></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-luggage-cart"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">STNK Expire</p>
                                        <h4 class="card-title">{{ $stnk }} |  <small class="text-danger">{{  number_format($percent_stnk,0,",",".") }}%</small></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small" >
                                        <i class="far fa-check-circle"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Insurance </p>
                                        <h4 class="card-title">{{ $insurance }} |  <small class="text-danger">{{  number_format($percent_insu,0,",",".") }}%</small></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Service Activity  <span class="badge bg-warning">Next Service</span></div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                           <div id='calendar'></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">UNIT STNK EXPIRED</div>
                        </div>
                        <div class="card-body pb-0">

                           
                          
                            <ul class="demo2 list-group" >
                                <li class="news-item list-group-item">LIST DATA UNIT </li>
                                <li class="news-item list-group-item">STNK EXPIRED</li>
                                <li class="news-item list-group-item">~SEGERA LAKUKAN PERPANJANGAN~</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-card-no-pd">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">PROMO TOYOTA</h4>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('public/assets/img/promo/BP1.PNG') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('public/assets/img/promo/BP2.PNG') }}" class="d-block w-100" alt="...">
                            </div>
                           
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div id="carouselExampleSlidesOnlyx" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('public/assets/img/promo/GR1.PNG') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('public/assets/img/promo/GR2.PNG') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('public/assets/img/promo/GR3.PNG') }}" class="d-block w-100" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
             
            </div>

        </div>
    </div>

    <div class="modal fade" id="EditModalData" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
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
                                <input type="text" class="form-control" id="fu_no_pol" name="fu_no_pol"  placeholder="No Polisi" autocomplete="off" readonly>
                            </div>
                             <div class="col-sm-4">
                                <label for="inputEnterYourName" class="col-form-label">Next Service</label>
                                <input type="text" class="form-control bg-danger text-white" id="next_services" name="next_services"  placeholder="No Polisi" autocomplete="off" >
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
                                <label for="inputEnterYourName" class="col-form-label">Tanggal Service Terakhir</label>
                                <input type="text" class="form-control datepicker bg-warning text-white" id="fu_tgl_last_service" name="fu_tgl_last_service"  placeholder="Last Service" autocomplete="off" >
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                       
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="IklanModalData" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title"><div class="text-white" id="headerid"></div></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="img-status img-fluid">
                </div>
            </div>
        </div>
    </div>
            
    <script src="{{ asset('public/assets/vendor/ticker/scripts/jquery.bootstrap.newsbox.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/vendor/fullcalendar/js/main.min.js') }}"></script>

    <script>
        $(function () {
            $(".demo2").bootstrapNews({
                newsPerPage: 5,
                autoplay: true,
                pauseOnHover: true,
                navigation: false,
                direction: 'up',
                newsTickerInterval: 1500,
                onToDo: function () {
                //console.log(this);
                }
            });
        });

        $('#ngserc').click(function(e){
            RenderCalendar();
        });

        $(document).ready(function() {
        
            $.notify({
                icon: 'icon-bell',
                title: 'Haii, Pelanggan Fleet AT Jambi II',
                message: '<a href="https://wa.me/+628117483800" target="_blank">'+'Info Harga Toyota Klik Disini</a>',
            },{
                type: 'secondary',
                placement: {
                    from: "bottom",
                    align: "right"
                },
                time: 1000,
            });

            RenderCalendar();
            LoadThisStnkExpire();
        });

        function RenderCalendar() {
            var SITEURL = "{{ url('/admin/') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var calendarEl = document.getElementById('calendar');
			var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
					left: 'prev,next today',
					center: 'title',
					right: 'dayGridMonth,timeGridWeek,timeGridDay'
				},
				navLinks: true,
				selectable: true,
				nowIndicator: true,
				editable: true,
				selectable: true,
                events: function (fetchInfo, successCallback, failureCallback) {
                    $.ajax({
                        url: SITEURL + "/calendar-event-source",
					    type: 'GET',
                        success: function (res) {
                            var events = [];
                            res.forEach(function (evt) {
                                events.push({
                                    title: evt.title,
                                    start: evt.start,
                                    color: evt.color,
                                    id: evt.id,

                                });
                            });
                            successCallback(events);
                        },
                    });
                },

                eventClick: function(info) {
                    /*info.event.id,*/
                    $.ajax({
                        url: "{{ URL('/admin/vehicle/editdata/') }}/"+info.event.id,
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
                            $('[name="fu_id"]').val(data.fu_id);
                            $('[name="next_services"]').val(data.fu_tgl_next_service);
                            
                        }
                    });

                    $('#EditModalData').modal('show');
                },

			});

            calendar.render();
		}

        function LoadThisStnkExpire(){
            $.getJSON("{{ URL('/admin/stnk/listexpire/') }}/", function(result){
                $.each(result,function(i, rows){
                    $('.demo2').append('<li class="list-group-item list-group-item-danger"><b>'+rows.fu_no_pol+'</b> - '+rows.fu_model+'</li>');
                });
            });
        }

       
        
    </script>
@endsection
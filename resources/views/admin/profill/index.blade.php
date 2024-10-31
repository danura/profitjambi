@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form id="formprofile">
                                {{csrf_field()}}
                                <input type="hidden" value="{{ auth()->user()->id }}" id="idusers" name="idusers">
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label for="inputEnterYourName" class="col-form-label">Nama Perusahaan</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" id="namausaha" name="namausaha"  placeholder="Nama Perusahaan" autocomplete="off">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="inputEnterYourName" class="col-form-label">E-Mail Account</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->email }}" id="emailusaha" name="emailusaha"  placeholder="E-Mail Account" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label for="inputEnterYourName" class="col-form-label">No HP PIC</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->customer_pic_hp }}" id="nohppic" name="nohppic"  placeholder="No Handphone PIC" autocomplete="off">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="inputEnterYourName" class="col-form-label">Nama PIC</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->customer_pic }}" id="namapic" name="namapic"  placeholder="Nama PIC" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label for="inputEnterYourName" class="col-form-label">No Telpon</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->customer_hp }}" id="notelpon" name="notelpon"  placeholder="No Telpon" autocomplete="off">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="inputEnterYourName" class="col-form-label">Alamat Lengkap</label>
                                        <textarea class="form-control" id="alamatlengkap" name="alamatlengkap"  placeholder="Alamat Lengkap" autocomplete="off">{{ auth()->user()->customer_address }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12 ">
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary" type="button">UPDATE</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Cari Lokasi Kami</div>
                  </div>
                  <div class="card-body">
                    <iframe
                      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24885863.413500495!2d66.6800421!3d-1.6722323999999982!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2586fe9eb9de1b%3A0x9ca6a8c825401af1!2sAgung%20Toyota%20Jambi%20Pall%2010!5e1!3m2!1sen!2sid!4v1730356762827!5m2!1sen!2sid"
                      width="600"
                      height="450"
                      style="border: 0; width: 100%"
                      allowfullscreen=""
                      loading="lazy"
                      referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                  </div>
                </div>
              </div>
            </div>
            
        </div>
    </div>

    <script src="{{ asset('public/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $("#formprofile").submit(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    data: $('#formprofile').serialize(),
                    url: "{{URL('/admin/profill/store/')}}",
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
                    },
                    error: function (data) {
                        alert("ada Error Kirim Data ke Server");
                    }
                });
            });
        });
    </script>

@endsection
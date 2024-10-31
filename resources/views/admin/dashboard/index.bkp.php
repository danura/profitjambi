 <!--@foreach($banners as $banner)
                                <div class="d-flex">
                                    <div class="avatar">
                                        <img src="{{ asset('public/assets/img/cart.png') }}" alt="{{ $banner->b_header }}" class="avatar-img rounded-circle">
                                    </div>
                                    <a href="#" id="getDataIklanId" data-id="{{ $banner->b_id }}">
                                        <div class="flex-1 pt-1 ms-2">
                                            <h6 class="fw-bold mb-1">{{ $banner->b_header }}</h6>
                                            <small class="text-muted">{{ $banner->b_desc }}</small>
                                        </div>
                                    </a>
                                
                                </div>
                                <div class="separator-dashed"></div>



                                $('body').on('click', '#getDataIklanId', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $("#headerid").empty();
            $(".img-status").empty();
            $.ajax({
                url: "{{ URL('/admin/get-banner/') }}/"+id,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $("#headerid").append(data.b_header.toUpperCase());
                    var source = "{!! asset('public/assets/img/promo/') !!}/"+data.b_image;
                    $('.img-status').attr('src', source);

                }
            });

            $('#IklanModalData').modal('show');
        });
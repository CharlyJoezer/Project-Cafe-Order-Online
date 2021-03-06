@extends('template.index')
@section('body')

    @auth
    <script>$('.header-home').css('display', 'none')</script>
    <div class="header-profil">
        <img src="asset/img/avatar.png" width="40" height="40" alt="">
        <div class="profil-name">{{ auth()->user()->username }}</div>
        <div class="saldo">Rp.xxx.xxx</div>
    </div>
    <hr>

    <div class="list-status-pesanan">
        <div class="status-diproses" id="diproses">
            <img src="asset\img\icons8-cooking-64.png" width="40" height="40" alt="">
            <div>Diproses</div>
        </div>
        <div class="status-dikirim" id="dikirim">
            <img src="asset\img\icons8-motorcycle-64.png" width="40" height="40" alt="">
            <div>Dikirim</div>
        </div>
        <div class="status-diterima" id="diterima">
            <img src="asset\img\icons8-delivery-64.png" width="40" height="40" alt="">
            <div>Diterima</div>
        </div>
        <div class="status-penilaian" id="penilaian">
            <img src="asset\img\icons8-rating-60.png" width="40" height="40" alt="">
            <div>Penilaian</div>
        </div>
    </div>

    <div class="center-image-background" id="center-image-background">
        <img class="center-image" src="asset\img\LOGO_PROJET_CAFE_ORDER.png" alt="COFFE LATTE">
    </div>

    <div class="riwayat-status-header" id="riwayat-status-header">Diproses</div>
    <div class="box-riwayat-order" id="box-riwayat-order">
        <div class="list-riwayat-order" id="list-riwayat-order">
        </div>
    </div>
    <div class="total-harga" id="total-harga">
        <span class="sistem-pembayaran">Pembayaran: Cash</span>
        <div class="total-pembayaran">Total : <span class="total-harga2">Rp. 12.000</span></div>
    </div>
    
    @else
    <div class="container">
        <div class="center-image" style="text-align: center;">
            <img src="asset/img/icons8-person-64.png" width="130" height="130" alt="">
            <h4 class="belumlogin">Anda belum login</h4>
        </div>
        <button class="btn-masuk" id="userlogin" type="submit">Masuk</button>
    </div>
    @endauth
    <script>
        $('#userlogin').click(function(){
            window.location = url + '/UserLogin';
        });
        $('#diproses').click(() => {
            $('#riwayat-status-header').html('Diproses')
            getdata('Diproses');
        })
        $('#dikirim').click(() => {
            $('#riwayat-status-header').html('Dikirim')
            getdata('Dikirim');
        })
        $('#diterima').click(() => {
            $('#riwayat-status-header').html('Diterima')
            getdata('Diterima');
        })
        $('#penilaian').click(() => {
            $('#riwayat-status-header').html('Penilaian')
            getdata('Penilaian');
        })
        let data2 = [];
        function getdata(status){
            $('#center-image-background').css('display', 'none')
            $('#riwayat-status-header').css('display','flex')
            $('#box-riwayat-order').css('display','block')
            $('#total-harga').css('display','flex')

            $('#riwayat-status-header').html(status+`
                    <div class="dropdown-order" id="dropdown-order">
                        <span class="dropdown-selected" id=""><span id="selected-dropdown">Pesanan 1</span> <img id="dropdown-icon" class="dropdown-icon-1" src="asset/img/icons8-chevron-24.png" width="10px" height="10px" alt=""></span>
                    </div>
            `)
            $('#list-riwayat-order').html(`
            <div class="menu-item-skeleton">
                    <img class="img-menu-skeleton"  width="100" height="100" alt="">
                    <ul>
                        <li class="nama-menu-skeleton"></li>
                        <li class="kategori-menu-skeleton"></li>
                        <li class="harga-menu-skeleton"></li>
                    </ul>
                </div>
                <div class="menu-item-skeleton">
                    <img class="img-menu-skeleton"  width="100" height="100" alt="">
                    <ul>
                        <li class="nama-menu-skeleton"></li>
                        <li class="kategori-menu-skeleton"></li>
                        <li class="harga-menu-skeleton"></li>
                    </ul>
                </div>
                <div class="menu-item-skeleton">
                    <img class="img-menu-skeleton"  width="100" height="100" alt="">
                    <ul>
                        <li class="nama-menu-skeleton"></li>
                        <li class="kategori-menu-skeleton"></li>
                        <li class="harga-menu-skeleton"></li>
                    </ul>
                </div>
                <div class="menu-item-skeleton">
                    <img class="img-menu-skeleton"  width="100" height="100" alt="">
                    <ul>
                        <li class="nama-menu-skeleton"></li>
                        <li class="kategori-menu-skeleton"></li>
                        <li class="harga-menu-skeleton"></li>
                    </ul>
                </div>
            `)
            $.ajax({
                'url' : url + '/getriwayatpesanan',
                'type': 'POST',
                'dataType' : 'JSON',
                'data' : {
                    "_token": "{{ csrf_token() }}",
                    'status': status
                },
                success: (data) => {
                    $('.total-harga').css('display', 'flex')
                    $('.total-harga2').html('')
                    $('#dropdown-order').html(`<span class="dropdown-selected" id="dropdown-selected"><span id="selected-dropdown">Pesanan 1</span> <img id="dropdown-icon" class="dropdown-icon-1" src="asset/img/icons8-chevron-24.png" width="10px" height="10px" alt=""></span>`)
                    $('#list-riwayat-order').html(``)
                    for(let i = 0; i < data.length; i++){
                        $('#dropdown-order').append(`
                        <span class="dropdown-list" id="`+ i +`">Pesanan `+ (i + 1) +`</span>
                        `)
                    }
                    datacontentriwayat(data[0]);
                    
                    $('#dropdown-order').click(function(){
                        $('.dropdown-list').toggleClass('dropdown-toggle')
                        $('#dropdown-icon').toggleClass('dropdown-icon')
                    })
                    $('.dropdown-list').click(function(){
                        $('#selected-dropdown').html($(this).html())
                        $('.dropdown-selected').attr('id', $(this).attr('id'))
                        $('#list-riwayat-order').html('')
                        datacontentriwayat(data[$(this).attr('id')]);
                    })
                    
                }

            });
            function datacontentriwayat(data){
                let totalharga = 0;
                for(i = 0; i < data.length; i++){
                    $('#list-riwayat-order').append(`
                    <div class="box-riwayat-item">
                        <img src="`+ data[i].gambar +`" width="100" height="100" style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;" alt="">
                        <ul class="item-desc">
                            <li class="item-name">`+ data[i].nama +`</li>
                            <li style="opacity: 67%;font-family: Open Sans;font-size: 13px;">`+ data[i].kategori +`</li>
                            <li class="item-jumlah">`+ data[i].jumlah +`x</li>
                            <li class="item-harga">Rp. `+ data[i].harga +`</li>
                        </ul>
                    </div>
                    `);
                    totalharga += data[i].harga;
                }
                $('.total-harga2').html('Rp. '+ totalharga)      
            }
        }
            
    </script>
@endsection
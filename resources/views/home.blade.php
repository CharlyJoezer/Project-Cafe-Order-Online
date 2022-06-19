@extends('template.index')
@section('body')
<meta name="csrf_token" content="{{ csrf_token() }}" />
    <div class="container">
        <div class="pilih-kategori">
            <h4 style="font-family: Roboto;">Pilih Kategori</h4>
        </div>

        {{-- LIST KATEGORI --}}
        <div class="list-kategori">
            <div class="item-kategori" id="minuman">
            <img src="asset/img/minuman.png"alt="">
            <p class="nama-kategori">Minuman</p>
            </div>
            <div class="item-kategori" id="makanan">
            <img src="asset/img/makanan.png"alt="">
            <p class="nama-kategori">Makanan</p>
            </div>
            <div class="item-kategori" id="lainnya">
            <img src="asset/img/lainnya.png"alt="">
            <p class="nama-kategori">Lainnya</p>
            </div>
        </div>

        {{-- MAIN IMAGE CENTER BG --}}
        <div class="main-image">
            <img src="asset/img/HOME_IMAGE.png" width="289" height="289" alt="">
        </div>

        {{-- KOTAK MENU --}}
        <div class="kotak-menu" id="kotak-menu">
            <span class="close-kotak-menu" id="close-kotak-menu"><img src="asset/img/close-button.png" width="40" height="40" alt=""></span>
            <div style="text-align: center;font-family:Roboto;font-size: 18px;"><h4 style="margin: 0px" id="judul-menu"></h4></div>
            <div class="list-menu" style="margin-top: 15px;">
            </div>
        </div>
        
        {{-- ORDER BOX POPUP --}}
        <div class="close-box-order" id="close-box-order"></div>
        <div class="box-order" id="box-order">
            @auth
            <h4 class="header-box-order">Tambahkan Pesanan</h4>
            <div class="box-menu-item" id="box-menu-item">
                {{-- ORDER BOX JS --}}
            </div>
            <div class="jumlahOrder">
                    <img src="asset\img\minus-svgrepo-com.svg" onclick="kurang()" class="tambah-minus" id="minus" alt="">
                    <input name="jumlahorder" class="jumlahangka" id="jumlahangka" value="1" readonly>
                    <img src="asset\img\plus-svgrepo-com.svg" onclick="tambah()" class="tambah-minus" id="tambah" alt="">
            </div>
            <div class="btn-buatpesanan" id="tambahorderan">
                <h4>Tambah Pesanan</h4>
            </div>
            @else
            <div class="not-login" style="text-align: center">
                <div class="center-image-login" style="text-align: center;">
                    <img src="asset/img/icons8-person-64.png" width="130" height="130" alt="">
                    <h4 class="belumlogin">Anda belum login</h4>
                </div>
                <button class="btn-masuk" id="userlogin" type="submit" onclick="login()">Masuk</button>
            </div>    
            @endauth
        </div>

        <div id="wrap-notifbox">
            <div class="notif-masuk-orderan">
                <img src="asset/img/check.gif" style="margin-right: 5px" width="25" height="25" alt="">
                <p style="margin:0px;padding:0px;">Pesanan ditambah ke list orderan </p>
            </div>
        </div>
    </div>
    <script>
        console.log('test')
        const minuman = document.getElementById('minuman')
        const makanan = document.getElementById('makanan')
        const lainnya = document.getElementById('lainnya')
        const kotakmenu = document.getElementById('kotak-menu')
        const closemenu = document.getElementById('close-kotak-menu')
        const judulmenu = document.getElementById('judul-menu')

        $('#minuman').click(function(){
            $('.list-menu').html(`
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
            kotakmenu.style.display = 'block';
            kotakmenu.style.top = '0';
            judulmenu.innerHTML = 'Minuman'
            $('.list-menu').css('display', 'block')

            $.ajax({
                'url': url + '/api/getMenu',
                'type': 'POST',
                'dataType': 'JSON',
                'data': {
                    'kategori': 'minuman'
                },
                success: function(data){
                    $('.list-menu').html('')
                    if(data.length == 0){
                    $('.list-menu').html('<h4 class="kategori-null">Kategori belum tersedia</h4>');
                    }
                    for(var i = 0; i < data.length; i++){
                        $('.list-menu').append(`
                        <div class="menu-item" id="`+data[i].id+`">
                        <img src="`+data[i].gambar+`" width="100" height="100" alt="">
                        <ul>
                            <li class="nama-menu-item">`+ data[i].nama +`</li>
                            <li style="opacity: 67%;font-family: Open Sans;font-size: 13px;">Kategori : `+ data[i].kategori +`</li>
                            <li class="harga-menu" id="`+ data[i].harga +`">Rp. `+ data[i].harga +`</li>
                        </ul>
                        </div>
                    `)
                    }
                    orderbox();
                }
            })
            
        })
        $('#makanan').click(function(){
            $('.list-menu').html(`
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
            kotakmenu.style.display = 'block';
            kotakmenu.style.top = '0';
            judulmenu.innerHTML = 'Makanan'

            $('.list-menu').css('display', 'block')
            $.ajax({
                'url': url + '/api/getMenu',
                'type': 'POST',
                'dataType': 'JSON',
                'data': {
                    'kategori': 'makanan'
                },
                success: function(data){
                    $('.list-menu').html('')
                    if(data.length == 0){
                    $('.list-menu').html('<h4 class="kategori-null">Kategori belum tersedia</h4>');
                    }
                    for(var i = 0; i < data.length; i++){
                        $('.list-menu').append(`
                        <div class="menu-item" id="`+data[i].id+`">
                        <img src="`+data[i].gambar+`" width="100" height="100" alt="">
                        <ul>
                            <li class="nama-menu-item">`+ data[i].nama +`</li>
                            <li style="opacity: 67%;font-family: Open Sans;font-size: 13px;">Kategori : `+ data[i].kategori +`</li>
                            <li class="harga-menu">Rp. `+ data[i].harga +`</li>
                        </ul>
                        </div>
                    `)
                    }
                    orderbox();
                }
            })
        });
        $('#lainnya').click(function(){
            $('.list-menu').html(`
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
            kotakmenu.style.display = 'block';
            kotakmenu.style.top = '0';
            judulmenu.innerHTML = 'Lainnya'

            $('.list-menu').css('display', 'block')
            $.ajax({
                'url': url + '/api/getMenu',
                'type': 'POST',
                'dataType': 'JSON',
                'data': {
                    'kategori': 'lainnya'
                },
                success: function(data){
                    $('.list-menu').html('')
                    if(data.length == 0){
                    $('.list-menu').html('<h4 class="kategori-null">Kategori belum tersedia</h4>');
                    }
                    for(var i = 0; i < data.length; i++){
                        $('.list-menu').append(`
                        <div class="menu-item" id="`+data[i].id+`">
                        <img src="`+data[i].gambar+`" width="100" height="100" alt="">
                        <ul>
                            <li class="nama-menu-item">`+ data[i].nama +`</li>
                            <li style="opacity: 67%;font-family: Open Sans;font-size: 13px;">Kategori : `+ data[i].kategori +`</li>
                            <li class="harga-menu">Rp. `+ data[i].harga +`</li>
                        </ul>
                        </div>
                    `)
                    }
                    orderbox()
                }
            })
        });
        closemenu.addEventListener('click', function(){
            kotakmenu.style.top = '100%';
            $('#box-order').css('display', 'none')
        })

        function orderbox(){
            $('#box-order').css('display', 'block')
            $('.menu-item').click(function(){
                $('#box-order').css('transform', 'translateY(0)')
                $('#close-box-order').css('display', 'block')
                $('#wrap-wrap-notifbox').css('display', 'block')
                $('#box-menu-item').html($(this).clone())
                $('#jumlahangka').val(1)
            })
            $('#close-box-order').click(function(){
                $('#close-box-order').css('display', 'none')
                $('#box-order').css('transform', 'translateY(100%)')
            }); 
        }
        function kurang(){
            const val = parseInt($('#jumlahangka').val()) - 1;
                if(val == 0){
                    return false;
                }
                $('#jumlahangka').val(val)
        }
        function tambah(){
            const val = parseInt($('#jumlahangka').val()) + 1
                $('#jumlahangka').val(val)
        }
        
        $('#tambahorderan').click(function(){
            sendData(
                $('#box-menu-item').children([0]).attr('id'),
                $('#jumlahangka').val(),
                $('#box-menu-item').children([0]).children([1]).children([1])[0].innerHTML,
                parseInt($('#box-menu-item').children([0]).children([1]).children([1])[2].getAttribute('id')) * parseInt($('#jumlahangka').val())    
            )
        })
        function sendData(menu, jumlah, nama, total){
            $.ajax({
                'url' : url + '/sendkeranjang',
                'type': 'POST',
                'dataType': 'JSON',
                'data' : {
                    "_token": "{{ csrf_token() }}",
                    'menu' : menu,
                    'jumlah': jumlah,
                    'nama': nama,
                    'total': total,
                },
                success: function(data){
                    
                }
            })
           setTimeout(() => {
            $('#close-box-order').css('display', 'none')
            $('#box-order').css('transform', 'translateY(100%)')
           }, 300);
           setTimeout(() => {
            $('.notif-masuk-orderan').css('top', '5%')
           }, 400);
           setTimeout(() => {
            $('.notif-masuk-orderan').css('top', '-50%')
           }, 5000);
        }
        function login(){
            window.location = url + '/UserLogin'
        }
        

    </script>
@endsection
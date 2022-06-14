{{-- @dd($data) --}}
@extends('template.index')
@section('body')

<div class="container">
    <div class="header-text" id="header">
        <h4>List Orderan</h4>
    </div>

    <div class="box-pesanan">
        @if ($data->count() == 0)
            {{-- <h1 class="">TEST</h1> --}}
        @else
        @foreach ($data as $item)
        <div class="menu-item" id="{{ $item->id }}">
            <img src="{{ $item->menu->gambar }}" width="100" height="100" alt="">
            <ul>
                <li class="nama-menu-item">{{ $item->nama_menu }}</li>
                <li style="opacity: 67%;font-family: Open Sans;font-size: 13px;">Kategori : {{ $item->menu->kategori }}</li>
                <li class="harga-menu" id="{{ $item->total_harga }}">Rp. {{ $item->total_harga }}</li>
                <li class="jumlah-order" style="font-family: open sans;opacity:50%;font-size:14px;" id="{{ $item->jumlah_dipesan }}">x{{ $item->jumlah_dipesan }}</li>
            </ul>
            <span class="btn-delete" id=""><img src="asset/img/x-icon.svg" width="20" height="20" alt=""></span>
        </div>
        @endforeach
        @endif
    </div>

    <div class="total-label">
        <p style="padding: 0px;margin:0px;">Total Pembayaran : </p>
        <p id="total" class="total2" style="padding: 0px;margin:0px;color: #2ACA5f">
        @if ($data->count() == 0)
        Rp. 0
        @else
        Rp. {{ $total_harga }}
        @endif
        </p>
    </div>

    <div class="btn-buatpesanan" id="buat-pesanan">
        <h4>Buat Pesanan</h4>
    </div>
    <div class="cancel-konfirmasi-pesanan" id="cancel-konfirmasi"></div>
    <div class="konfirmasi-pesanan" id="konfirmasi-pesanan">
        <ul class="list-order-konfirmasi" id="list-order-konfirmasi">
        </ul>
        <hr>
        <div class="total-pembayaran-konfirmasi">
            <span class="tunai-text">Total : </span>
            <span id="total-harga-order">Rp. {{ $total_harga }}</span>
        </div>
        <div class="btn-konfirmasi"id="konfirmasi">
            <span >Konfirmasi</span>
        </div>
    </div>
</div>
    <script>
            $('.btn-delete').click(function(){
                
                $(this).parent().remove()
                $.ajax({
                    'url' : url + '/delete/item-keranjang',
                    'type': 'POST',
                    'dataType': 'JSON',
                    'data' : {
                        '_token': '{{ csrf_token() }}',
                        'id' : $(this).parent().attr('id')
                    },
                    success: function(data){
                        $('.total2').html('Rp.'+data.data)
                        $('.total2').attr('id', data.data)
                        $('#total-harga-order').html('Rp. '+data.data)
                    }
                })
                // window.location = url + '/list-pesanan'
            })
            
            $('#buat-pesanan').click(function(){
                $('#list-order-konfirmasi').html('')
                if($('.menu-item')[0]){
                    for(let i = 0; i < $('.menu-item').length; i++){
                        $('#list-order-konfirmasi').append(`
                        <li class="item-order-konfirmasi">
                            <span>`+$('.nama-menu-item')[i].innerHTML+` <span style="opacity: 0.5;font-size:12px;">x`+$('.jumlah-order')[0].getAttribute('id')+`</span></span>
                            <span>`+$('.harga-menu')[i].innerHTML+`</span>
                        </li>
                        `)
                    }
                    
                    $('#cancel-konfirmasi').css('display', 'block')
                    $('#cancel-konfirmasi').click(function(){
                        $('#cancel-konfirmasi').css('display', 'none')
                        $('#konfirmasi-pesanan').css('transform', 'translateY(100%)')
                    })
                    $('#konfirmasi-pesanan').css('transform', 'translate(0)')
                }else{
                    alert('You must have minimum 1 order')
                }
                
            })
            
            $('#konfirmasi').click(function(){
                $.ajax({
                    'url' : url+'/konfirmasi/buatpesanan',
                    'type': 'POST',
                    'dataType': 'JSON',
                    'data' : {"_token": "{{ csrf_token() }}"},
                    success: function(data){
                        $('#cancel-konfirmasi').css('display', 'none')
                        $('#konfirmasi-pesanan').css('transform', 'translateY(100%)')
                        $('.menu-item').css('display', 'none');
                        $('.total2').html('Rp. 0')
                        $('.total2').attr('total')

                    }
                })
            })

    </script>
@endsection
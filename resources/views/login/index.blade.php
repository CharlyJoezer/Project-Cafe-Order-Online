@extends('template.index')
@section('body')
    <div class="container">
        <div class="kotak-login">
            <header class="login">LOGIN</header>
            <form action="/loginAkun" method="post">
                @csrf
                <div style="margin-bottom: 5px;">
                    <input type="email" class="InputEmail" placeholder="Email" name="email" autocomplete="off" required>
                    @error('email') <div class="error-input">{{ $message }}</div> @enderror
                </div>
                <div style="margin-bottom: 5px;">
                    <input type="password" class="InputPassword" placeholder="Password" name="password" autocomplete="off" required>
                    @error('password') <div class="error-input">{{ $message }}</div> @enderror
                </div>
                <button class="btn-masuk" type="submit">Masuk</button>
                <div class="daftarX" style="margin-top: 5px;">or</div>
                <div class="daftarX" id="daftar" onclick="daftar();"><a href="#">Daftar</a></div>
            </form>
        </div>
    </div>
    <script>
        function daftar(){
            $('.kotak-login').html(`
            <header class="daftar" id="daftarheader">DAFTAR</header>
            <form action="/daftarAkun" method="post">
                @csrf
                <div style="margin-bottom: 5px;">
                    <input type="text" id="inputdaftarusername" class="InputUsername" placeholder="Username" name="username" required>
                </div>
                <div style="margin-bottom: 5px;">
                    <input type="email" id="inputdaftaremail" class="InputEmail" placeholder="Email" name="email" required>
                </div>
                <div style="margin-bottom: 5px;">
                    <input type="password" id="inputdaftarpassword" class="InputPassword" placeholder="Password" name="password" required>
                </div>
                <button class="btn-masuk" type="submit">DAFTAR</button>
                <div class="daftarX" style="margin-top: 5px;">or</div>
                <div class="daftarX" onclick="login();"><a href="#">Login</a></div>
            </form>
            `)
        }
        function login(){
                $('.kotak-login').html(`
                <header class="login">LOGIN</header>
                <form action="/loginAkun" method="post">
                    @csrf
                    <div style="margin-bottom: 5px;">
                        <input type="email" class="InputEmail" placeholder="Email" name="email" required>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <input type="password" class="InputPassword" placeholder="Password" name="password" required>
                    </div>
                    <button class="btn-masuk" type="submit">Masuk</button>
                    <div class="daftarX" style="margin-top: 5px;">or</div>
                    <div class="daftarX" id="daftar" onclick="daftar()"><a href="#">Daftar</a></div>
                </form>
                `)
        }
        
    </script>
@endsection
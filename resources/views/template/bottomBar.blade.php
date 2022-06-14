
    <ul class="bottom-bar" style="list-style-type: none;margin: 0px;padding: 0px;">
        <li style="cursor: pointer;" id="home">
            <img src="asset/img/icons8-home.svg" width="30" height="30" alt="">
        </li>
        <li style="cursor: pointer;" id="order">
            <img src="asset\img\icons8-purchase-order.png" width="30" height="30" alt="">
        </li>
        <li style="cursor: pointer;" id="profil">
            <img src="asset\img\icons8-person.png" width="30" height="30" alt="">
        </li>
    </ul>
    <script>
        $('#home').click(function(){
            window.location = url
        })
        $('#order').click(function(){
            window.location = url + '/list-pesanan'
        })
        $('#profil').click(function(){
            window.location = url + '/profil'
        })
    </script>
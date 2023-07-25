<nav class="menu">
    <img class="logo" src="{{asset('images/ali_logo.PNG')}}" alt="hiii">
    
    <ul>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="fa fa-bell"></i>
            </a>
            <ul class="dropdown-menu" id="notificationDropdownn" style="min-width: 290px;">
                      
        
                     


                        @php
                            $admin_id_list = [1, 2, 35]; // Manually define the admin IDs
                        @endphp
                        @foreach (\App\Models\Notification::where('notifiable_id', 'IN', $admin_id_list)->get() as $notification)
                            <li>{{ $notification->data['data'] }}</li>
                        @endforeach




                      
        </li>
        <li>
            <a href="{{route('home2')}}">
                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024"><path fill="currentColor" d="M946.5 505L534.6 93.4a31.93 31.93 0 0 0-45.2 0L77.5 505c-12 12-18.8 28.3-18.8 45.3c0 35.3 28.7 64 64 64h43.4V908c0 17.7 14.3 32 32 32H448V716h112v224h265.9c17.7 0 32-14.3 32-32V614.3h43.4c17 0 33.3-6.7 45.3-18.8c24.9-25 24.9-65.5-.1-90.5z"/></svg> --}}
                <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
<lord-icon
    src="https://cdn.lordicon.com/osuxyevn.json"
    trigger="hover"
    colors="primary:#121331"
    style="width:40px;height:40px">
</lord-icon>
            </a>
        </li>
        <li>
            <a href="{{route('wishlist')}}">
                @auth
                <span class="info-count">{{count(auth()->user()->wishlist)}}</span>

                @endauth
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M10 19q-.425 0-.713-.288T9 18q0-.425.288-.713T10 17h10q.425 0 .713.288T21 18q0 .425-.288.713T20 19H10Zm0-6q-.425 0-.713-.288T9 12q0-.425.288-.713T10 11h10q.425 0 .713.288T21 12q0 .425-.288.713T20 13H10Zm0-6q-.425 0-.713-.288T9 6q0-.425.288-.713T10 5h10q.425 0 .713.288T21 6q0 .425-.288.713T20 7H10ZM5 20q-.825 0-1.413-.588T3 18q0-.825.588-1.413T5 16q.825 0 1.413.588T7 18q0 .825-.588 1.413T5 20Zm0-6q-.825 0-1.413-.588T3 12q0-.825.588-1.413T5 10q.825 0 1.413.588T7 12q0 .825-.588 1.413T5 14Zm0-6q-.825 0-1.413-.588T3 6q0-.825.588-1.413T5 4q.825 0 1.413.588T7 6q0 .825-.588 1.413T5 8Z"/></svg>            </a>
        </li>
        <li>
            <a href="{{route('cart')}}">
                <span class="info-count">{{session()->has('cart') ? count(session('cart')) : 0}}</span>
                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="1.19em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1664 1408"><path fill="currentColor" d="M1280 448q0-26-19-45t-45-19t-45 19l-147 146V256q0-26-19-45t-45-19t-45 19t-19 45v293L749 403q-19-19-45-19t-45 19t-19 45t19 45l256 256q19 19 45 19t45-19l256-256q19-19 19-45zm-640 832q0 53-37.5 90.5T512 1408t-90.5-37.5T384 1280t37.5-90.5T512 1152t90.5 37.5T640 1280zm896 0q0 53-37.5 90.5T1408 1408t-90.5-37.5t-37.5-90.5t37.5-90.5t90.5-37.5t90.5 37.5t37.5 90.5zm128-1088v512q0 24-16 42.5t-41 21.5L563 890q1 7 4.5 21.5t6 26.5t2.5 22q0 16-24 64h920q26 0 45 19t19 45t-19 45t-45 19H448q-26 0-45-19t-19-45q0-14 11-39.5t29.5-59.5t20.5-38L268 128H64q-26 0-45-19T0 64t19-45T64 0h256q16 0 28.5 6.5t20 15.5t13 24.5T389 73t5.5 29.5T399 128h1201q26 0 45 19t19 45z"/></svg> --}}
                <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                <lord-icon
                    src="https://cdn.lordicon.com/hyhnpiza.json"
                    trigger="hover"
                    colors="primary:#121331"
                    style="width:40px;height:40px">
                </lord-icon>
            </a>
        </li>
        
        <li>
            <a href="{{route('account')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="currentColor" d="M472 48H40a24.028 24.028 0 0 0-24 24v368a24.028 24.028 0 0 0 24 24h88v-58.822a20.01 20.01 0 0 1 10.284-17.478l91.979-51.123L200 260.919V200a56 56 0 0 1 112 0v60.919l-30.263 75.655l91.979 51.126A20.011 20.011 0 0 1 384 405.178V464h88a24.028 24.028 0 0 0 24-24V72a24.028 24.028 0 0 0-24-24Zm-8 384h-48v-26.822a52.027 52.027 0 0 0-26.738-45.451L321.915 322.3L344 267.081V200a88 88 0 0 0-176 0v67.081l22.085 55.219l-67.347 37.432A52.027 52.027 0 0 0 96 405.178V432H48V80h416Z"/></svg>
            </a>
        </li>
    </ul>

</nav>
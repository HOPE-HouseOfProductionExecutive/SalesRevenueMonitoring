<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compa                                                     tible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/master/style.css">

    {{-- ICON --}}
    <link rel="icon" href="/assets/images/logo.png" type="image/x-icon">

    {{-- FONT --}}
    <link rel="preload" href="/public/assets/fonts/Rotunda-font/Rotunda-Black.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/public/assets/fonts/Rotunda-font/RotundaVariable-Regular.woff2" as="font" type="font/woff2" crossorigin>


    {{-- BOOTSTRAP ICON --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    {{-- JQUERY AJAX --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Sales Revenue Monitoring</title>
</head>
<body>
    <input type="checkbox" class="checkboxx" id="click" hidden>
    <div class="main">
        <div class="nav-left aktip">
            <div class="sidebar-heading">
                <p>Halo, {{Auth::user()->name}}</p>
                <label for="click">
                    <i class="bi bi-list" style="color: #000;" id="ham-btn"></i>
                    {{-- <i class='bx bx-menu' style="color: #fff;" id = 'ham-btn'></i> --}}
                </label>
            </div>
            <ul class="navlist">
                <li>
                    <a href="/">
                        <i class="bi bi-grid-fill"></i>
                        <span class="links">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/revenue">
                        <i class="bi bi-database-fill-add"></i>
                        <span class="links">Revenue Data</span>
                    </a>
                </li>
                <li>
                    <a href="/search-data">
                        <i class="bi bi-file-earmark-bar-graph-fill"></i>
                        <span class="links">Analytics</span>
                    </a>
                </li>
                <li>
                    <a href="/register">
                        <i class="bi bi-person-fill-gear"></i>
                        <span class="links">User Control</span>
                    </a>
                </li>
                <li>
                    <a href="/account">
                        <i class="bi bi-person-fill"></i>
                        <span class="links">Account</span>
                    </a>
                </li>
            </ul>


        </div>
        <div class="session-info">
            <div class="left">
                <div class="date"><p id="date"></p></div>
                <div class="time"><p id="time"></p></div>
            </div>
            <div class="right">
                <a href="/logout">Logout</a>
            </div>
        </div>
        <div class="main-content">
            @yield('content')
        </div>
    </div>
</body>
<script type="text/javascript">
    function showtime(){
        const months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        const weekdays = ["Sunday", "Monday", "Tuesday", "Wedesday", "Thrusday", "Friday", "Saturday"];

        var fulldate = new Date();
        let str = "";
        let str1 = "";

        let temp = "";
        let temp1 = "";
        let temp2 = "";

        let day = weekdays[fulldate.getDay()];
        let month = months[fulldate.getMonth()];

        let hour = fulldate.getHours();
        if(hour<10) {
            temp = temp + "0" + hour;
        }
        else {
            temp = temp + hour;
        }

        let minute = fulldate.getMinutes();
        if(minute<10) {
            temp1 = temp1 + "0" + minute;
        }
        else {
            temp1 = temp1 + minute;
        }

        let second = fulldate.getSeconds();
        if(second<10) {
            temp2 = temp2 + "0" + second;
        }
        else {
            temp2 = temp2 + second;
        }

        let ampm = temp >= 12 ? 'PM' : 'AM';

        str = str + day + ", " + fulldate.getDate() + " " + month + " " + fulldate.getFullYear() + ",";
        str1 = str1 + temp + ":" + temp1 + ":" + temp2 + " " + ampm;

        document.getElementById('date').innerHTML = str;
        document.getElementById('time').innerHTML = str1;
    }
    showtime();
    setInterval(showtime, 1000);

</script>
<script type="text/javascript">
    let btn = document.querySelector('#ham-btn');
    let sidebar = document.querySelector('.nav-left');

    btn.onclick = function(){
        sidebar.classList.toggle("aktip");
        document.getElementsByClassName("main").style.gridTemplateColumns  = "20rem 1fr";
    }

</script>
</html>


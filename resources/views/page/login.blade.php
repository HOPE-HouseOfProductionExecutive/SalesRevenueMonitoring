<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales Revenue Monitoring</title>
    <link rel="stylesheet" href="/assets/css/auth/style.css">
    {{-- ICON --}}

    {{-- FONT --}}
    <link rel="preload" href="/public/assets/fonts/Rotunda-font/Rotunda-Medium.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/public/assets/fonts/Rotunda-font/Rotunda-Bold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/public/assets/fonts/Rotunda-font/Rotunda-ExtraBold.woff2" as="font" type="font/woff2" crossorigin>

    {{-- BOOTSTRAP ICON --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    {{-- JQUERY AJAX --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    <div class="box-container">
        <div class="title">
            <h1>Sales Revenue Monitoring</h1>
        </div>
        <form action="/login/user" method="POST">
            @csrf
            <div class="input-placeholder">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="input-placeholder">
                <label for="password">Password</label>
                <div class="password">
                    <input type="password" name="password" id="password">
                    <i id="toggle" class="bi bi-eye"></i>
                    {{-- <i class="bi bi-eye-slash"></i> --}}
                </div>
                <a href="#">Forgot Password?</a>
            </div>

            <button type="submit">LOGIN</button>
        </form>
    </div>
</body>


<script>
    $(document).ready(function() {
        $('#toggle').on('click', function () {
            if($('#password').attr('type') == 'password'){
                $('#password').attr('type', 'text')
                $('#toggle').attr('class', 'bi bi-eye-slash')
            }
            else {
                $('#password').attr('type', 'password')
                $('#toggle').attr('class', 'bi bi-eye')
            }
        });


    });


</script>

</html>

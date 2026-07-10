<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }} | Admin Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>

        /* CSS Part-2 এখানে দিবো */

    </style>

</head>

<body>

<div class="login-bg">

    <div class="login-card">

        <div class="text-center mb-4">

            <img src="{{ asset(\App\Models\Basicinfo::first()->logo) }}"
                 class="logo">

            <h2 class="mt-3 fw-bold">
                Welcome Back
            </h2>

            <p class="text-muted">
                Sign in to {{ env('APP_NAME') }}
            </p>

        </div>

        @if(Session::has('error'))

            <div class="alert alert-danger">

                {{ Session::get('error') }}

            </div>

        @endif

        <form action="{{ route('admin.login') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label>Email Address</label>

                <div class="input-group">

                    <span class="input-group-text">

                        <i class="fa fa-envelope"></i>

                    </span>

                    <input type="email"
                           name="email"
                           class="form-control"
                           placeholder="Enter Email"
                           required>

                </div>

            </div>

            <div class="mb-4">

                <label>Password</label>

                <div class="input-group">

                    <span class="input-group-text">

                        <i class="fa fa-lock"></i>

                    </span>

                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control"
                           placeholder="Password"
                           required>

                    <span class="input-group-text toggle-password">

                        <i class="fa fa-eye"></i>

                    </span>

                </div>

            </div>

            <div
                class="d-flex justify-content-between align-items-center mb-4">

                <div class="form-check">

                    <input class="form-check-input"
                           type="checkbox"
                           name="remember">

                    <label class="form-check-label">

                        Remember Me

                    </label>

                </div>

                <a href="#">

                    Forgot Password?

                </a>

            </div>

            <button class="btn login-btn">

                <span>

                    Sign In

                </span>

            </button>

        </form>

        <div class="footer">

            © {{ date('Y') }}

            {{ env('APP_NAME') }}

            All Rights Reserved.

        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

$('.toggle-password').click(function(){

    let input=$("#password");

    let icon=$(this).find("i");

    if(input.attr("type")=="password"){

        input.attr("type","text");

        icon.removeClass("fa-eye").addClass("fa-eye-slash");

    }else{

        input.attr("type","password");

        icon.removeClass("fa-eye-slash").addClass("fa-eye");

    }

});

$("form").submit(function(){

    $(".login-btn").html('<span class="spinner-border spinner-border-sm me-2"></span>Signing In...');

    $(".login-btn").prop("disabled",true);

});

</script>
<style>
    *{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    min-height:100vh;
    overflow:hidden;
    background:#0f172a;
}

.login-bg{

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    padding:20px;

    background:
    linear-gradient(rgba(15,23,42,.75),rgba(15,23,42,.75)),
    url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1600&q=80');

    background-size:cover;

    background-position:center;

}

.login-card{

    width:100%;

    max-width:460px;

    background:rgba(255,255,255,.12);

    backdrop-filter:blur(18px);

    border:1px solid rgba(255,255,255,.15);

    border-radius:25px;

    padding:45px;

    box-shadow:0 20px 50px rgba(0,0,0,.45);

    animation:fadeUp .8s;

}

@keyframes fadeUp{

    from{

        opacity:0;

        transform:translateY(40px);

    }

    to{

        opacity:1;

        transform:translateY(0);

    }

}

.logo{

    width:120px;

    height:120px;

    object-fit:contain;

    background:#fff;

    border-radius:50%;

    padding:12px;

    box-shadow:0 10px 25px rgba(0,0,0,.25);

}

h2{

    color:#fff;

}

.text-muted{

    color:#d6d6d6 !important;

}

label{

    color:#fff;

    font-weight:500;

    margin-bottom:8px;

}

.input-group{

    margin-top:8px;

}

.input-group-text{

    background:#fff;

    border:none;

    border-radius:12px 0 0 12px;

}

.form-control{

    border:none;

    height:56px;

    border-radius:0 12px 12px 0;

    font-size:15px;

}

.form-control:focus{

    box-shadow:0 0 0 .25rem rgba(59,130,246,.25);

}

.toggle-password{

    cursor:pointer;

    background:#fff;

    border:none;

}

.form-check-label{

    color:#fff;

}

.form-check-input{

    cursor:pointer;

}

a{

    text-decoration:none;

    color:#FFD54F;

    font-weight:500;

}

a:hover{

    color:#fff;

}

.login-btn{

    width:100%;

    height:58px;

    border:none;

    border-radius:15px;

    color:#fff;

    font-size:18px;

    font-weight:600;

    background:linear-gradient(135deg,#ff416c,#ff4b2b);

    transition:.35s;

}

.login-btn:hover{

    transform:translateY(-3px);

    box-shadow:0 15px 30px rgba(255,75,43,.4);

}

.footer{

    margin-top:30px;

    text-align:center;

    color:#ddd;

    font-size:14px;

}

.alert{

    border-radius:12px;

}

@media(max-width:576px){

.login-card{

padding:30px 22px;

}

.logo{

width:90px;

height:90px;

}

h2{

font-size:26px;

}

}
</style>
</body>

</html>
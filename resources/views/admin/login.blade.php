<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>Admin</title>
    <link href="{{url('/css/assets/bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/css/assets/mdb.min.css')}}" />
    <link href="{{url('/css/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link href="{{url('/css/admin/login/style.css')}}" rel="stylesheet">

    <link href="{{url('/css/login/style-responsive.css')}}" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <!--script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script-->
    <![endif]-->
</head>

<body>

<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->

<div id="login-page">
    <div class="container">

        <form class="form-login" action="{{route('loginAdmin')}}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @isset($next)
                <input type="hidden" name="next" value="{{$next}}">
            @endisset
            <h2 class="form-login-heading">Admin</h2>
            <div class="login-wrap" >
                <input type="text" class="form-control" name="login" placeholder="login ou email" autofocus @isset($login) value="{{$login}}"  @endisset >
                <br>
                <input type="password" name="password" class="form-control" placeholder="Password" style="margin-bottom: 15px">
                @isset($error)
                    <span class="red-text">{{$error}}</span>
                    @endisset</p>
                <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> Se connecter</button>
                <hr>
            </div>
        </form>

    </div>
</div>

<!-- js placed at the end of the document so the pages load faster -->
<script src="{{url('/js/assets/jquery-1.8.3.min.js')}}"></script>
<script src="{{url('/js/assets/bootstrap.min.js')}}"></script>



<!--BACKSTRETCH-->
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
<script type="text/javascript" src="{{url('/js/assets/jquery.backstretch.min.js')}}"></script>

<script>
    $.backstretch("img/login-bg.jpg", {speed: 500});
</script>


</body>
</html>

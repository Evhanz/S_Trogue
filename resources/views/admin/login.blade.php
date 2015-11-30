<!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title>Trogue | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="{{asset('css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{asset('css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{asset('css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />

    <!-- jQuery 2.0.2 -->
    <script src="{{ asset('js/jquery-2.0.2.min.js')}}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="bg-black">

<div class="form-box" id="login-box">
    <div class="header">Bienvenidos a Trogue System</div>
    <form action="{{ URL::route('loginUser') }}" method="post">

        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <div class="body bg-gray">
            <div class="form-group">
                <input type="number" min="1" name="dni" class="form-control" placeholder="usuario"/>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password"/>
            </div>

        </div>
        <div class="footer">
            <button type="submit" class="btn bg-olive btn-block">Ingresar</button>

            @if(Session::has('Error'))

                <div class="box box-solid bg-red">
                    <div class="box-header">
                        <h3 class="box-title">
                            Error de acceso
                        </h3>

                    </div>
                    <div class="box-body">
                        <p>El susuario ingresado o la contraseña no son los correctos</p>
                    </div>
                </div>


            @endif


        </div>
    </form>

    <div class="margin text-center">
        <span>Siguenos en nuestras redes Sociales</span>
        <br/>
        <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
        <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
        <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

    </div>
</div>


<!-- Bootstrap -->
<script src="{{ asset('js/bootstrap.min.js')}}" type="text/javascript"></script>

</body>
</html>
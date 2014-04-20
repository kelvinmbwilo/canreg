<!DOCTYPE html>
<html class="bootstrap-admin-vertical-centered">
<head>
    <title>Login page | Cancer Registry</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    {{ HTML::style("css/bootstrap.min.css") }}
    {{ HTML::style("css/bootstrap-theme.min.css") }}

    <!-- Bootstrap Admin Theme -->
    {{ HTML::style("css/bootstrap-admin-theme.css") }}

    <!-- Custom styles -->
    <style type="text/css">
        .alert{
            margin: 0 auto 20px;
        }
    </style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    {{ HTML::script("js/html5shiv.js") }}
    {{ HTML::script("js/respond.min.js") }}
    <![endif]-->
</head>
<body class="bootstrap-admin-without-padding">
<div class="container">
    <div class="row">
        @if(isset($error))
        <div class="alert alert-danger alert-dismissable" style="padding: 5px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{ $error }}!</strong>
        </div>
        @endif
        <form method="post" action="{{ url('login') }}" class="bootstrap-admin-login-form">

            <h1><span class="pull-right">Login</span><span class="text-info"> CANREG</span></h1>
            <div class="form-group">
                <input class="form-control" type="text" name="email" placeholder="username" required="required">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" name="keep">
                    Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary" type="submit">Login</button>
        </form>
    </div>
</div>

{{ HTML::script("http://code.jquery.com/jquery-2.0.3.min.js") }}
{{ HTML::script("js/bootstrap.min.js") }}
<script type="text/javascript">
    $(function() {
        // Setting focus
        $('input[name="email"]').focus();

        // Setting width of the alert box
        var alert = $('.alert');
        var formWidth = $('.bootstrap-admin-login-form').innerWidth();
        var alertPadding = parseInt($('.alert').css('padding'));

        if(isNaN(alertPadding)){
            alertPadding = parseInt($(alert).css('padding-left'));
        }

        $('.alert').width(formWidth - 2 * alertPadding);
    });
</script>
</body>
</html>
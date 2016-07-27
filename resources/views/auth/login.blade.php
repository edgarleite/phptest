<!-- resources/views/auth/login.blade.php -->

@section('title', 'Login')

<html>
    <head>
        <title>PHP Test - @yield('title')</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <!-- Login theme -->
        <link rel="stylesheet" href="/css/login.css">
    </head>
    <body>
        <div class="container">
            <form class="form-signin" method="post" action="/login">
                {!! csrf_field() !!}
                <h2 class="form-signin-heading">Login</h2>
                <label for="usuario" class="sr-only">Usuário</label>
                <input name="usuario" id="usuario" value="{{ old('usuario') }}" class="form-control" placeholder="Usuário" autofocus>
                <label for="senha" class="sr-only">Senha</label>
                <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
            </form>
        </div> <!-- /container -->

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>
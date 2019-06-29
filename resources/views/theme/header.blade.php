<div class="navbar-header">

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

        <span class="sr-only">Toggle navigation</span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

    </button>

    <a class="navbar-brand" href="{{ route('myHome') }}">  <i class="fa fa-stethoscope fa-fw"></i> Web Clinica</a>

</div>

<ul class="nav navbar-top-links navbar-right">

    @if(Auth::check())

        <li><i class="fa fa-user fa-fw"></i> {{  Auth::user()->name }}</li>
        <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out fa-fw"></i> sair</a></li>
    @endif

</ul>

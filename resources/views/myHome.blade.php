@extends('theme.default')

@section('content')

    <div class="row">

        <div class="col-lg-12">

            @if(Auth::check())
                @if(Auth::user()->tipo_usuario != 'adm')
                    <h4 class="page-header">Olá {{Auth::user()->pessoa->nome}} !</h4>
                @else
                    <h4 class="page-header">Dashboard</h4>
                @endif
            @endif
        </div>

        <!-- /.col-lg-12 -->

    </div>

    <!-- /.row -->

    @if(Auth::user()->tipo_usuario == 'adm')
        <div class="row">

            <div class="col-lg-3 col-md-6">

                <div class="panel panel-primary">

                    <div class="panel-heading">

                        <div class="row">

                            <div class="col-xs-3">

                                <i class="fa fa-comments fa-5x"></i>

                            </div>

                            <div class="col-xs-9 text-right">

                                <div class="huge">26</div>

                                <div>Pacientes Cadastrados</div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="panel panel-green">

                    <div class="panel-heading">

                        <div class="row">

                            <div class="col-xs-3">

                                <i class="fa fa-tasks fa-5x"></i>

                            </div>

                            <div class="col-xs-9 text-right">

                                <div class="huge">12</div>

                                <div>Médicos Cadastrados</div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="panel panel-yellow">

                    <div class="panel-heading">

                        <div class="row">

                            <div class="col-xs-3">

                                <i class="fa fa-shopping-cart fa-5x"></i>

                            </div>

                            <div class="col-xs-9 text-right">

                                <div class="huge">124</div>

                                <div>Consultas realizadas </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    @endif

@endsection
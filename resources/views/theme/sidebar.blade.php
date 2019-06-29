<div class="navbar-default sidebar" role="navigation">

    <div class="sidebar-nav navbar-collapse">

        <ul class="nav" id="side-menu">
            @if(Auth::check())
                @if(Auth::user()->tipo_usuario !== 'usr')
                    <li>
                        <a href="#"><i class="fa fa-address-book fa-fw"></i> Pacientes</a>
                        <ul class="nav nav-second-level">
                            <li>

                                <a href="{{ route('novo-paciente') }}"><i class="fa fa-plus fa-fw"></i> Novo</a>

                            </li>
                            <li>

                                <a href="{{ route('buscar-pacientes') }}"><i class="fa fa-search fa-fw"></i> Busca</a>

                            </li>

                        </ul>
                    </li>
                @endif
                @if(Auth::user()->tipo_usuario !== 'usr')
                    <li>
                        <a href="#"><i class="fa fa-user-md fa-fw"></i>Medicos</a>
                        <ul class="nav nav-second-level">
                            <li>

                                <a href="{{ route('novo-medico') }}"><i class="fa fa-plus fa-fw"></i> Novo</a>

                            </li>
                            <li>

                                <a href="{{ route('buscar-medicos') }}"><i class="fa fa-search fa-fw"></i> Busca</a>

                            </li>
                        </ul>
                    </li>
                @endif

                <li>
                    <a href="#"><i class="fa fa-calendar fa-fw"></i>Consultas</a>
                    <ul class="nav nav-second-level">
                        @if(Auth::user()->tipo_usuario == 'med' || Auth::user()->tipo_usuario =='adm')
                            <li>

                                <a href="{{ route('nova-consulta') }}"><i class="fa fa-plus fa-fw"></i> Nova Consulta</a>

                            </li>
                        @endif
                        <li>

                            <a href="{{ route('novo-agendamento') }}"><i class="fa fa-plus fa-fw"></i> Novo Agendamento</a>

                        </li>
                        <li>

                            <a href="{{ route('buscar-agendamentos') }}"><i class="fa fa-search fa-fw"></i> Busca</a>

                        </li>
                    </ul>
                </li>
            @endif
        </ul>

    </div>

    <!-- /.sidebar-collapse -->

</div>

<!-- /.navbar-static-side -->
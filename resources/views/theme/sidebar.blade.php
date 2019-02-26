<div class="navbar-default sidebar" role="navigation">

    <div class="sidebar-nav navbar-collapse">

        <ul class="nav" id="side-menu">
            <li>
                <a href="#"><i class="fa fa-address-book fa-fw"></i> Pacientes</a>
                <ul class="nav nav-second-level">
                    <li>

                        <a href="{{ route('novo-paciente') }}"><i class="fa fa-plus fa-fw"></i> Novo</a>

                    </li>
                    <li>

                        <a href="{{ route('buscar-pacientes') }}"><i class="fa fa-search fa-fw"></i> Busca</a>

                    </li>
                    <li>

                        <a href="#"><i class="fa fa-upload fa-fw"></i> Importar Dados</a>

                    </li>
                </ul>
            </li>
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
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i>Usuário</a>
                <ul class="nav nav-second-level">
                    <li>

                        <a href="{{ route('novo-usuario') }}"><i class="fa fa-plus fa-fw"></i> Novo</a>

                    </li>
                    <li>

                        <a href="{{ route('buscar-usuarios') }}"><i class="fa fa-user fa-fw"></i> Busca</a>

                    </li>
                </ul>
            </li>



            <li>

                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">

                    <li>

                        <a href="flot.html">Flot Charts</a>

                    </li>

                    <li>

                        <a href="morris.html">Morris.js Charts</a>

                    </li>

                </ul>

                <!-- /.nav-second-level -->

            </li>

            <li>

                <a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>

            </li>

            <li>

                <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>

            </li>

            <li>

                <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">

                    <li>

                        <a href="panels-wells.html">Panels and Wells</a>

                    </li>

                </ul>

                <!-- /.nav-second-level -->

            </li>

            <li>

                <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">

                    <li>

                        <a href="blank.html">Blank Page</a>

                    </li>

                    <li>

                        <a href="login.html">Login Page</a>

                    </li>

                </ul>

                <!-- /.nav-second-level -->

            </li>

        </ul>

    </div>

    <!-- /.sidebar-collapse -->

</div>

<!-- /.navbar-static-side -->
@extends('theme.default')

@section('titulo')
    <div class="row">
        <h4>Buscar Paciente</h4>
        <hr>
    </div>

@endsection
@section('content')

    <div class="row">

         <div class="form-horizontal" id="form_busca">


            <div class="form-group" style="padding-left: 10px">
                <label for="busca_cpf" class="control-label col-sm-2">CPF</label>
                <div class="col-xs-12 col-sm-3">
                    <input type="text" class="form-control col-xs-12 col-sm-4" id="busca_cpf" />
                </div>
            </div>

            <div class="form-group" style="padding-left: 10px">
                <label for="busca_dn" class="control-label col-sm-2">Data de nascimento</label>
                <div class="col-xs-12 col-sm-2">
                    <input type="text" class="form-control col-xs-12 col-sm-6" id="busca_dn" />
                </div>
            </div>

            <div class="form-group" style="padding-left: 10px">
                <label for="busca_nome" class="control-label col-sm-2">Nome</label>
                <div class="col-xs-12 col-sm-6">
                    <input type="text" class="form-control col-xs-12 col-sm-6" id="busca_nome" />
                </div>
            </div>

            <div class="form-group" style="padding-left: 10px">
                <label  class="control-label col-sm-2"></label>
                <div class="col-xs-12 col-sm-8">
                    <button class="btn btn-primary col-xs-12 col-sm-3" id="btnBuscarPaciente" >
                        <span id="buscar"><i class="fa fa-search"></i> Buscar</span>
                        <span id="buscando" style="display: none;">Buscando...</span>
                    </button>
                </div>
            </div>

       </diform>
        <!-- /.col-lg-12 -->

    </div>

    <!-- /.row -->

    <div id="sem_resultado" style="display: none">
        <span> Nenhum resultado encontrado. </span>
    </div>

    <div id="lista" style="display: none">
        <table id="resultado_busca" class="table table-striped table-bordered table-hover table-responsive">

            <thead>

            <tr>

                <th>CPF</th>

                <th>Nome</th>

                <th>Email</th>

                <th>Data de nascimento</th>

                <th>#</th>

            </tr>

            </thead>

            <tbody>


            </tbody>

        </table>
    </div>




        <script type="text/javascript" src="/js/jquery.mask.min.js"></script>
        <script type="text/javascript" src="/js/paciente.js"></script>

@endsection
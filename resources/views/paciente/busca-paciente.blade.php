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
                    <input type="text" class="form-control col-xs-12 col-sm-4" id="busca_cpf"/>
                </div>
            </div>

            <div class="form-group" style="padding-left: 10px">
                <label for="busca_dn" class="control-label col-sm-2">Data de nascimento</label>

                <div class="col-xs-12 col-sm-2">
                    <input type="text" class="form-control col-xs-12 col-sm-6" id="busca_dn"/>
                </div>
            </div>

            <div class="form-group" style="padding-left: 10px">
                <label for="busca_nome" class="control-label col-sm-2">Nome</label>

                <div class="col-xs-12 col-sm-6">
                    <input type="text" class="form-control col-xs-12 col-sm-6" id="busca_nome"/>
                </div>
            </div>

            <div class="form-group" style="padding-left: 10px">
                <label class="control-label col-sm-2"></label>

                <div class="col-xs-12 col-sm-8">
                    <button class="btn btn-primary col-xs-12 col-sm-3" id="btnBuscarPaciente">
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
            <div class="table-responsive" style="margin-left: 5px;margin-right: 5px;">
                <table id="resultado_busca"
                       class="table table-striped table-bordered table-hover "
                       data-pagination="true"
                       data-mobile-responsive="true">

                    <thead>

                    <tr>

                        <th data-field="cpf" data-formatter="cpfFormatter">CPF</th>

                        <th data-field="nome">Nome</th>

                        <th data-field="email" >Email</th>

                        <th data-field="data_nasc" data-formatter="dateFormatter">Data de nascimento</th>

                        <th data-field="#" data-formatter="actionFormatter" data-events="commonEvents">#</th>

                    </tr>

                    </thead>
                </table>
            </div>

        </div>


        <script type="text/javascript" src="/js/jquery.mask.min.js"></script>
        <script type="text/javascript" src="/js/paciente.js"></script>
        <script>
            function cpfFormatter(value){
                if(value){
                    return value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g,"\$1.\$2.\$3\-\$4");
                }else{
                    return;
                }
            }
            function actionFormatter(value) {
                return [
                    '<a class="update btn btn-primary" style="margin-right:10px;" href="javascript:" ><i class="fa fa-pencil"></i><span class="hidden-xs"> Editar</span></a>',
                    '<a class="remove btn btn-danger" href="javascript:" ><i class="fa fa-trash"></i><span class="hidden-xs"> Remover</span></a>'
                ].join('')
            }
            function dateFormatter(value){
                if(value){
                    return new Date(value).toString('dd/MM/yyyy');
                }else{
                    return;
                }
            }
            window.commonEvents = {
                'click .update': function (e, value, row) {
                    console.log(row);
                },
                'click .remove': function (e, value, row) {
                    console.log(row);
                }
            }
        </script>

@endsection
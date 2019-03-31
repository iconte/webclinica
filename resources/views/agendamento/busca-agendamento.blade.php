@extends('theme.default')

@section('titulo')

    <div class="row">
        <div class="col-lg-8">
            <h4>Buscar Agendamento</h4>
            <hr>
        </div>
    </div>

@endsection
@section('content')


        <div class="busca">
        <form action="POST">
            <input type="hidden" name="_method" value="PUT">


            <div class="row">

                <div class="form-horizontal" id="form_busca">


                    <div class="col-lg-8">
                        <div class="form-group" style="padding-left: 10px">
                            <label for="busca_data" class="control-label col-sm-2">Data</label>
                            <div class="col-xs-12 col-sm-3">
                                <input id="data_agendamento_busca" type='datetime' class="form-control date" maxlength="16">
                            </div>

                        </div>
                    </div>


                    <div class="col-lg-8">
                        <div class="form-group" style="padding-left: 10px">
                            <label for="busca_medico" class="control-label col-sm-2">Médico</label>

                            <div class="col-xs-12 col-sm-6">
                                <select class="form-control" id="lista_medicos"></select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="form-group" style="padding-left: 10px">
                            <label for="busca_paciente" class="control-label col-sm-2">Paciente</label>

                            <div class="col-xs-12 col-sm-8">
                                <input id="busca_nome" type='text' class="form-control" maxlength="20">
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-8">
                        <div class="form-group" style="padding-left: 10px">
                            <label class="control-label col-sm-2"></label>

                            <div class="col-xs-12 col-sm-8">
                                <button class="btn btn-primary col-xs-12 col-sm-3" id="btnBuscarAgendamento">
                                    <span id="buscar"><i class="fa fa-search"></i> Buscar</span>
                                    <span id="buscando" style="display: none;">Buscando...</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
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
                           data-pagination="true" ,
                           data-mobile-responsive="true">


                        <thead>

                        <tr>
                            <th data-field="data_agendamento" data-formatter="dateFormatter">Data</th>

                            <th data-field="cpf" data-formatter="cpfFormatter">CPF</th>

                            <th data-field="nome">Nome</th>

                            <th data-field="medico" data-formatter="medicoFormatter">Medico</th>

                            <th data-field="#" data-formatter="actionFormatter" data-events="commonEvents">#</th>

                        </tr>
                        <tbody></tbody>

                        </thead>
                    </table>
                </div>


            </div>
        </form>
    </div>

    <!-- TELA DE EDIÇÃO  -->


    <div class="edicao" style="display: none;">
        <div class="alert alert-danger erro-msg" style="display:none">
            <ul></ul>
        </div>
        <form id="frmEditarAgendamento">
            <input type="hidden" id="editar_id_agendamento">

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label>Data<span style="color:red">*</span></label>
                        <div class="input-group ">
                            <input id="data_agendamento" type='datetime' class="form-control" maxlength="16">
                         <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>CPF <span style="color:red">*</span></label>
                        <input id="editar_cpf" name="editar_cpf" class="form-control cpf" maxlength="11">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label>Nome<span style="color:red">*</span></label>
                        <input id="editar_nome" name="editar_nome" class="form-control">
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group" style="padding-left: 10px">
                        <label for="busca_medico" class="control-label col-sm-2">Médico</label>

                        <div class="col-xs-12 col-sm-8">
                            <select class="form-control" id="editar_lista_medicos"></select>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <button id="btnAtualizarAgendamento" class="btn btn-primary col-xs-12 col-sm-3"
                                style="margin-bottom:5px;">
                            <span id="atualizar"><i class="fa fa-save"></i> Salvar</span>
                            <span id="atualizando" style="display: none;">Salvando...</span>
                        </button>
                        <a href="#" id="btnVoltarParaLista" class="btn btn-danger  col-xs-12 col-sm-3 pull-right"
                           onclick="voltarParaLista()">Cancelar</a>
                    </div>
                </div>
            </div>


        </form>
    </div>
    <script type="text/javascript" src="/js/util.js"></script>
    <script type="text/javascript" src="/js/agendamento.js"></script>
    <script>

        function cpfFormatter(value) {
            if (value) {
                return $('.cpf').masked(value);
            } else {
                return;
            }
        }
        function dateFormatter(value){
            if(value){
                return moment(value).locale('pt-BR').format('L');
            }else{
                return;
            }
        }
        function medicoFormatter(value) {
            if (value) {
                return value.pessoa.nome;
            } else {
                return;
            }
        }

        function actionFormatter(value) {
            return [
                '<a class="update btn btn-primary" style="margin-right:10px;" href="javascript:" ><i class="fa fa-pencil"></i><span class="hidden-xs"> Editar</span></a>',
                '<a class="remove btn btn-danger" href="javascript:" ><i class="fa fa-trash"></i><span class="hidden-xs"> Remover</span></a>'
            ].join('')
        }

        window.commonEvents = {
            'click .update': function (e, value, row) {
                exibirEditar();
                preencherDadosEditar(row);
            },
            'click .remove': function (e, value, row) {
                $.confirm({
                    title: 'Confirmação',
                    content: 'Tem certeza que deseja apagar?',
                    buttons: {
                        confirm: {
                            text: 'Sim',
                            action: function () {
                                apagarRegistro(row.medico_id);
                            }
                        },
                        cancel: {
                            text: 'Não',
                            action: function () {

                            }
                        }
                    }
                });
            }
        }


        //buscar do banco
        function preencherDadosEditar(dados) {
            $("#editar_id_agendamento").val(dados.id);
            $("#editar_nome").val(dados.nome);
            if (dados.cpf) {
                $("#editar_cpf").val(dados.cpf).mask('000.000.000-00');
                $("#editar_cpf").trigger({type: 'keypress', which: 32, keyCode: 32});
            }

            if (dados.data_agendamento) {
                var dtnasc = moment(dados.data_agendamento).locale('pt-BR').format('L');
                $("#editar_data_agendamento").val(dtnasc);
            }

            if(dados.medico_id){
                $("#editar_lista_medicos").val(dados.medico_id);
            }

        }
        function voltarParaLista() {
            $("#frmEditarAgendamento")[0].reset();
            limparMsgValidacao();
            $('.busca').fadeIn();
            $('.edicao').fadeOut();

        }
        function exibirEditar() {
            $('.busca').hide();
            $('.edicao').show();
        }
    </script>

@endsection
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
                                <select class="form-control" id="busca_lista_medico"></select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="form-group" style="padding-left: 10px">
                            <label for="busca_paciente" class="control-label col-sm-2">Paciente</label>

                            <div class="col-xs-12 col-sm-8">
                                @if(Auth::user()->tipo_usuario == 'usr')
                                    <input id="busca_nome_ro" type='text' class="form-control busca_nome" maxlength="20" readonly value="{{Auth::user()->pessoa->nome}}">
                                @else
                                    <input id="busca_nome" type='text' class="form-control busca_nome" maxlength="20" >
                                @endif

                            </div>

                        </div>
                    </div>


                    <div class="col-lg-8">
                        <div class="form-group" style="padding-left: 10px">
                            <label class="control-label col-sm-2"></label>

                            <div class="col-xs-12 col-sm-8">
                                <button class="btn btn-primary col-xs-12 col-sm-4" id="btnBuscarAgendamento">
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

                            <th data-field="hora_agendamento" >Hora</th>

                            <th data-field="pessoa" data-formatter="pessoaFormatter"> Paciente</th>

                            <th data-field="nome"> Medico</th>

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
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Data<span style="color:red">*</span></label>
                        <div class="input-group ">
                            <input id="editar_data_agendamento" type='datetime' class="form-control" maxlength="16">
                         <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Hora<span style="color:red">*</span></label>
                        <select class="form-control" id="editar_lista_horarios"></select>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>CPF <span style="color:red">*</span></label>
                        <input id="editar_cpf" name="editar_cpf" class="form-control cpf"
                               @if(Auth::user()->tipo_usuario == 'usr') readonly   @endif
                               maxlength="11">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label>Nome<span style="color:red">*</span></label>
                        <input id="editar_nome" name="editar_nome" class="form-control" @if(Auth::user()->tipo_usuario == 'usr') readonly   @endif>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group" >
                        <label for="busca_medico" class="control-label ">Médico</label>


                        <select class="form-control" id="editar_lista_medicos"></select>

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
//        function medicoFormatter(value) {
//            if (value) {
//                return value.pessoa.nome;
//            } else {
//                return;
//            }
//        }
        function pessoaFormatter(value) {
            if (value) {
                return value.nome;
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
                            text: 'sim',
                            action: function () {
                                apagarRegistro(row.medico_id);
                            }
                        },
                        cancel: {
                            text: 'não',
                            action: function () {

                            }
                        }
                    }
                });
            }
        }


        //buscar do banco
        function preencherDadosEditar(dados) {
            $("#editar_id_agendamento").val(dados.id_agendamento);
            $('#editar_data_agendamento').datetimepicker({
                locale: moment.locale('pt-BR'),
                format: 'L',
                daysOfWeekDisabled: [0,6],
                //disabledHours: [0, 1, 2, 3, 4, 5, 6, 19, 20, 21, 22, 23, 24],
                minDate: moment(),
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
            });
            //prepara o evento de checagem de datas disponiveis para consulta
            $("#editar_data_agendamento").blur(function(event){
                var dt_selecionada = $("#editar_data_agendamento").val();
                var medicoId = $("#editar_lista_medicos").val();
                carregarHorariosDisponiveis(event,dt_selecionada, medicoId);
            });
            $("#editar_id_agendamento").val(dados.id_agendamento);
            $("#editar_nome").val(dados.pessoa.nome);
            if (dados.pessoa && dados.pessoa.cpf) {
                $("#editar_cpf").val(dados.pessoa.cpf).mask('000.000.000-00');
                $("#editar_cpf").trigger({type: 'keypress', which: 32, keyCode: 32});
            }

            if (dados.data_agendamento) {
                var dtagendamento = moment(dados.data_agendamento).locale('pt-BR').format('L');
                $("#editar_data_agendamento").val(dtagendamento);
            }
            if (dados.hora_agendamento) {
                var horarios = ['08:00:00','09:00:00','10:00:00','11:00:00','13:00:00','14:00:00','15:00:00','16:00:00','17:00:00','18:00:00'];
                for(var i = 0;i<horarios.length;i++){
                    $("#editar_lista_horarios").append('<option value="'+horarios[i]+'">'+ horarios[i].substr(0,5)+'</option>');
                }
                $("#editar_lista_horarios").val(dados.hora_agendamento);
            }

            if(dados.medico_id){
                $.get('/api/medico',function(resultado){
                    carregarListaMedico(resultado,'#editar_lista_medicos');
                }).done(function() {
                    $("#editar_lista_medicos").val(dados.medico_id);
                });


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
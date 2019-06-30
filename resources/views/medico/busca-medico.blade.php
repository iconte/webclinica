@extends('theme.default')

@section('titulo')

    <div class="row">
        <div class="col-lg-8">
            <h4>Buscar Médico</h4>
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
                            <label for="busca_crm"  class="control-label col-sm-2">CRM</label>

                            <div class="col-xs-12 col-sm-3">
                                <input type="text" class="form-control col-xs-12 campoBusca"   id="busca_crm" maxlength="20"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="form-group" style="padding-left: 10px">
                            <label for="busca_lista_especialidades"  class="control-label col-sm-2">Especialidade</label>

                            <div class="col-xs-12 col-sm-4">
                                <select class="form-control" id="busca_lista_especialidades"></select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="form-group" style="padding-left: 10px">
                            <label for="busca_cpf"  class="control-label col-sm-2">CPF</label>

                            <div class="col-xs-12 col-sm-3">
                                <input type="text" class="form-control col-xs-12 campoBusca cpf"   id="busca_cpf" />
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-8">
                        <div class="form-group" style="padding-left: 10px">
                            <label for="busca_nome" class="control-label col-sm-2">Nome</label>

                            <div class="col-xs-12 col-sm-8">
                                <input type="text" class="form-control col-xs-12 campoBusca" id="busca_nome" maxlength="200"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="form-group" style="padding-left: 10px">
                            <label class="control-label col-sm-2"></label>

                            <div class="col-xs-12 col-sm-8">
                                <button class="btn btn-primary col-xs-12 col-sm-3" id="btnBuscarMedico">
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
                           data-pagination="true",
                           data-mobile-responsive="true">


                        <thead>

                        <tr>

                            <th data-field="crm1" >CRM</th>

                            <th data-field="cpf" data-formatter="cpfFormatter">CPF</th>

                            <th data-field="nome" data-sortable="true" >Nome</th>

                            <th data-field="email" >Email</th>

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
        <form id="frmEditarMedico">
            <input type="hidden" id="editar_id_medico">
            <input type="hidden" id="editar_pessoa_id">
            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>CRM <span style="color:red">*</span></label>
                        <input id="editar_crm" name="editar_crm" class="form-control "  maxlength="20">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>CRM secundário</label>
                        <input id="editar_crm2" name="editar_crm2" class="form-control "  maxlength="20">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-xs-12 col-lg-4">
                    <div class="form-group">
                        <label>Especialidade</label>
                        <select class="form-control" id="editar_lista_especialidades"></select>
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

                <div class="col-lg-2">
                    <div class="form-group">
                        <label>CPF<span style="color:red">*</span></label>
                        <input id="editar_cpf" name="editar_cpf" class="form-control cpf"  maxlength="11">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>Data de Nascimento<span style="color:red">*</span></label>
                        <input id="editar_data_nasc" name="editar_data_nasc" class="form-control date" maxlength="10" >
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Sexo</label>

                        <div class="radio">
                            <label class="radio-inline">
                                <input type="radio" name="editar_rdsexo" id="optionsRadiosInline1" value="M"
                                       checked="checked">Masculino
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="editar_rdsexo" id="optionsRadiosInline2" value="F">Feminino
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>Tel. Residencial</label>
                        <input id="editar_tel_res" name="editar_telres" class="form-control phone_with_ddd"  maxlength="11">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>Tel. Celular<span style="color:red">*</span></label>
                        <input id="editar_tel_cel" name="editar_telcel" class="form-control phone_with_ddd"  maxlength="11">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Email<span style="color:red">*</span></label>
                        <input id="editar_email" name="editar_email" class="form-control" maxlength="20">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>CEP <img id="loading_cep" src="/gif/loading.gif" style="width: 25%;display: none"/> </label>
                        <input class="form-control cep" name="editar_cep" id="editar_cep"  maxlength="10">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <label>Endereço<span style="color:red">*</span></label>
                        <input class="form-control" name="editar_end" id="editar_end" maxlength="200">
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="form-group">
                        <label>Número<span style="color:red">*</span></label>
                        <input class="form-control numero" name="editar_numero" id="editar_numero" maxlength="5" >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>Complemento</label>
                        <input class="form-control" name="editar_complemento" id="editar_complemento" maxlength="100">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>Bairro<span style="color:red">*</span></label>
                        <input class="form-control" name="editar_bairro" id="editar_bairro">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Cidade<span style="color:red">*</span></label>
                        <input class="form-control" name="editar_cidade" id="editar_cidade">
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="form-group">
                        <label>UF</label>
                        <input class="form-control uf" name="editar_uf" id="editar_uf" maxlength="2">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <button id="btnAtualizarMedico" class="btn btn-primary col-xs-12 col-sm-3" style="margin-bottom:5px;" >
                            <span id="atualizar"><i class="fa fa-save"></i> Salvar</span>
                            <span id="atualizando" style="display: none;">Salvando...</span>
                        </button>
                        <a href="#" id="btnVoltarParaLista" class="btn btn-danger  col-xs-12 col-sm-3 pull-right" onclick="voltarParaLista()">Cancelar</a>
                    </div>
                </div>
            </div>



        </form>
    </div>
    <script type="text/javascript" src="/js/util.js"></script>
    <script type="text/javascript" src="/js/medico.js"></script>
    <script>

        function cpfFormatter(value){
            if(value){
                return $('.cpf').masked(value);
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
                        confirm:{
                            text: 'Sim',
                            action:function () {
                                apagarRegistro(row.medico_id);
                            }
                        },
                        cancel:{
                            text: 'Não',
                            action: function () {

                            }
                        }
                    }
                });
            }
        }


        //buscar do banco
        function preencherDadosEditar(dados){
            $("#editar_id_medico").val(dados.medico_id);
            $("#editar_pessoa_id").val(dados.pid);
            $("#editar_crm").val(dados.crm1);
            $.get('/api/especialidade',function(resultado){
                preencherListaEspecialidade(resultado,"#editar_lista_especialidades");
                $("#editar_lista_especialidades").val(dados.especialidade_id);
            });
            $("#editar_crm2").val(dados.crm2);
                $("#editar_nome").val(dados.nome);
                if(dados.cpf){
                    $("#editar_cpf").val(dados.cpf).mask('000.000.000-00');
                    $("#editar_cpf" ).trigger({type: 'keypress', which: 32, keyCode: 32});
                }

                if(dados.data_nasc){
                    var dtnasc = moment(dados.data_nasc).locale('pt-BR').format('L');
                    $("#editar_data_nasc").val(dtnasc);
                }
                $("#editar_tel_res").val(dados.tel_res);
                $("#editar_tel_cel").val(dados.tel_cel);
                $("#editar_email").val(dados.email);
                $("#editar_cep").val(dados.cep);
                $("#editar_end").val(dados.endereco);
                $("#editar_complemento").val(dados.complemento);
                $("#editar_numero").val(dados.numero);
                $("#editar_bairro").val(dados.bairro);
                $("#editar_cidade").val(dados.cidade);
                $("#editar_uf").val(dados.uf);
                if(dados.sexo){
                    $("input[name=editar_rdsexo][value=" + dados.sexo + "]").attr('checked', 'checked');
                }

        }
        function voltarParaLista(){
            $("#frmEditarMedico")[0].reset();
            limparMsgValidacao();
            $('.busca').fadeIn();
            $('.edicao').fadeOut();

        }
        function exibirEditar(){
            $('.busca').hide();
            $('.edicao').show();
        }
    </script>

@endsection
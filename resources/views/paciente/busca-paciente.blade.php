@extends('theme.default')

@section('titulo')

    <div class="row">
        <div class="col-lg-8">
            <h4>Buscar Paciente</h4>
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
                        <label for="busca_cpf"  class="control-label col-sm-2">CPF</label>

                        <div class="col-xs-12 col-sm-3">
                            <input type="text" class="form-control col-xs-12 campoBusca cpf"   id="busca_cpf" />
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="form-group" style="padding-left: 10px">
                        <label for="busca_dn" class="control-label col-sm-2">Data de nascimento</label>

                        <div class="col-xs-12 col-sm-4">
                            <input type="text" class="form-control col-xs-12 campoBusca date" id="busca_dn"/>
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
                            <button class="btn btn-primary col-xs-12 col-sm-3" id="btnBuscarPaciente">
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

                        <th data-field="cpf" data-formatter="cpfFormatter">CPF</th>

                        <th data-field="nome">Nome</th>

                        <th data-field="email" >Email</th>

                        <th data-field="data_nasc" data-formatter="dateFormatter">Data de nascimento</th>

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
        <form id="frmEditarPaciente">
            <input type="hidden" id="editar_id_paciente">
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label>Nome</label>
                        <input id="editar_nome" name="editar_nome" class="form-control">
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-lg-2">
                    <div class="form-group">
                        <label>CPF</label>
                        <input id="editar_cpf" name="editar_cpf" class="form-control cpf"  maxlength="11">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>Data de Nascimento</label>
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
                        <label>Tel. Celular</label>
                        <input id="editar_tel_cel" name="editar_telcel" class="form-control phone_with_ddd"  maxlength="11">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Email</label>
                        <input id="editar_email" name="editar_email" class="form-control" maxlength="20">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>CEP <img id="loading" src="/gif/loading.gif" style="width: 25%;display: none"/> </label>
                        <input class="form-control cep" name="editar_cep" id="editar_cep"  maxlength="10">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <label>Endereço</label>
                        <input class="form-control" name="editar_end" id="editar_end" maxlength="200">
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="form-group">
                        <label>Número</label>
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
                        <label>Bairro</label>
                        <input class="form-control" name="editar_bairro" id="editar_bairro">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Cidade</label>
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
                        <button id="btnAtualizarPaciente" class="btn btn-primary col-xs-12 col-sm-3" style="margin-bottom:5px;" >
                            <span id="atualizar"><i class="fa fa-save"></i> Salvar</span>
                            <span id="atualizando" style="display: none;">Salvando...</span>
                            </button>
                        <a href="#" id="btnVoltarParaLista" class="btn-link  col-xs-12 col-sm-3 pull-right" onclick="voltarParaLista()">Ir para Lista</a>
                    </div>
                </div>
            </div>



        </form>
    </div>

        <script type="text/javascript" src="/js/paciente.js"></script>
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
            function dateFormatter(value){
                if(value){
                    return moment(value).locale('pt-BR').format('L');
                }else{
                    return;
                }
            }
            window.commonEvents = {
                'click .update': function (e, value, row) {
                    exibirEditar();
                    preencherDadosEditar(row);
                },
                'click .remove': function (e, value, row) {
                   apagarRegistro(row.id);
                }
            }


            //buscar do banco
            function preencherDadosEditar(dados){
                $("#editar_id_paciente").val(dados.id);
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
               // var camposEditar = ["#editar_nome","#editar_cpf","#editar_data_nasc",
                //    "#editar_tel_res","#editar_tel_cel","#editar_email","#editar_end","#editar_cep",
                 //   "#editar_numero","#editar_bairro","#editar_cidade","editar_cep","#editar_numero",
                  //  "#editar_complemento"];
                //limparCampos(camposEditar);
                $("#frmEditarPaciente")[0].reset();
                $('.busca').fadeIn();
                $('.edicao').fadeOut();

            }
            function exibirEditar(){
                $('.busca').hide();
                $('.edicao').show();
            }


        </script>

@endsection
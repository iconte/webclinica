var ultimaBusca;
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

function msgValidacao(msg) {
    $(".erro-msg").find("ul").html('');
    $(".erro-msg").css('display', 'block');
    $.each(msg, function (key, value) {
        $(".erro-msg").find("ul").append('<li>' + value + '</li>');
    });
}
function msgErro(msg) {
    $(".erro-msg").find("ul").html('');
    $(".erro-msg").css('display', 'block');
    $(".erro-msg").text(msg);
}

function recarregarTabelaBusca(){
    $.get('/api/paciente/filtro',ultimaBusca,function(data){

    });
}

$('.campoBusca').keypress(function (e) {
    if (e.which == 13) {
        $('#btnBuscarPaciente').click();
        return false;
    }
});


$("#btnSalvarPaciente").click(function (event) {
    event.preventDefault();
    var dados_paciente = {
        'nome': $("#nome").val(),
        'cpf': $(".cpf").cleanVal(),
        'cep': $(".cep").cleanVal(),
        'dataNasc': $("#data_nasc").val(),
        'tel_cel': $("#telcel").val(),
        'tel_res': $("#telres").val(),
        'email': $("#email").val(),
        'endereco': $("#end").val(),
        'numero': $("#numero").val(),
        'bairro': $("#bairro").val(),
        'cidade': $("#cidade").val(),
        'uf': $("#uf").val(),
        'sexo': $("input[name='rd_sexo']:checked"). val()
    };
    $.ajax({
        type: "POST",
        url: "/api/paciente",
        data: dados_paciente,
        context: this,
        beforeSend: function () {
            $("#salvar").hide();
            $("#salvando").show();
        },
        complete: function () {
            $("#salvando").hide();
            $("#salvar").show();
        },
        success: function (data) {

            if(data){
                if(data.errors){
                    msgValidacao(data.errors);
                    return;
                }
                $('#frmNovoPaciente')[0].reset();
                toastr.info('Registro salvo com sucesso.');
            }
        },
        error: function (error) {
            var text = JSON.parse(error.responseText);
            $("#salvando").hide();
            $("#salvar").show();
            msgErro(text.message);
        }
    });
});

$("#btnAtualizarPaciente").click(function (event) {
    event.preventDefault();
    var dados_paciente = {
        'id':$('#editar_id_paciente').val(),
        'nome': $("#editar_nome").val(),
        'cpf': $("#editar_cpf").cleanVal(),
        'cep': $("#editar_cep").cleanVal(),
        'dataNasc': $("#editar_data_nasc").val(),
        'tel_cel': $("#editar_tel_cel").val(),
        'tel_res': $("#editar_tel_res").val(),
        'email': $("#editar_email").val(),
        'endereco': $("#editar_end").val(),
        'numero': $("#editar_numero").val(),
        'bairro': $("#editar_bairro").val(),
        'cidade': $("#editar_cidade").val(),
        'uf': $("#editar_uf").val(),
        'sexo': $("input[name='editar_rd_sexo']:checked"). val()
    };
    $.ajax({
        type: "PUT",
        url: "/api/paciente",
        data: dados_paciente,
        context: this,
        beforeSend: function () {
            $("#atualizar").hide();
            $("#atualizando").show();
        },
        complete: function () {
            $("#atualizando").hide();
            $("#atualizar").show();
        },
        success: function (data) {

            if(data && data.errors){
                msgValidacao(data.errors);
                return;
            }
            carregarDadosTabelaUltimaBusca()
                .done(function(){
                    voltarParaLista();
                    toastr.info('Registro atualizado com sucesso.');
                });
        },
        error: function (error) {
            var text = JSON.parse(error.responseText);
            $("#salvando").hide();
            $("#salvar").show();
            msgErro(text.message);
        }
    });
});



$("#btnBuscarPaciente").click(function (event) {
    event.preventDefault();

    var busca_pessoa = {
        nome: $("#busca_nome").val(),
        cpf: $(".cpf").cleanVal(),
        dataNascimento: $("#busca_dn").val()

    };
    ultimaBusca = busca_pessoa;
    $.ajax({
        type: "GET",
        url: "/api/paciente/filtro",
        data: busca_pessoa,
        context: this,
        beforeSend: function () {
            $("#buscar").hide();
            $("#buscando").show();
        },
        complete: function () {
            $("#buscando").hide();
            $("#buscar").show();
        },
        success: function (resultado) {
            console.log(resultado);
            var $table = $('#resultado_busca');
            if (resultado && resultado.data && resultado.data.length > 0) {
                var pacientes = resultado.data;
                $table.bootstrapTable('destroy');
                $table.bootstrapTable({data: pacientes});
                exibirResultadoPesquisa();
            } else {
                $table.bootstrapTable('destroy');
                exibirMsgSemResultado();
            }


        },
        error: function (error) {
            $("#buscando").hide();
            $("#buscar").show();
            console.log(error);
        }
    });
});


function exibirResultadoPesquisa() {
    $('#sem_resultado').hide();
    $('#lista').show();
}
function exibirMsgSemResultado() {
    $('#lista').hide();
    $('#sem_resultado').show();
}

$(function () {
    var camposCepNovo = {
        end: "#end", comp: "#complemento", bairro: "#bairro", cidade: "#cidade", uf: "#uf"
    };
    var camposCepEdicao = {
        end: "#editar_end",
        comp: "#editar_complemento",
        bairro: "#editar_bairro",
        cidade: "#editar_cidade",
        cep: "#editar_cidade",
        end: "#editar_end",
        uf: "#editar_uf"
    };
    var tratarCepNovo = function () {
        return tratarCep(camposCepNovo)
    };
    var tratarCepEdicao = function () {
        return tratarCep(camposCepEdicao)
    };
    $("#loading").hide();
    $("#cep").blur(tratarCepNovo);
    $("#editar_cep").blur(tratarCepEdicao);
    $(".date").mask("00/00/0000");
    $(".cpf").mask("000.000.000-00", {reverse: true});
    $(".phone_with_ddd").mask("(00) 0000-0000");
    $(".cep").mask("00000-000");
    $(".numero").mask("00000");
    $(".uf").mask("SS");
});

function tratarCep(campos) {
    var cep = $(".cep").cleanVal();
    var retorno;
    if (cep.length == 8) {
        var data = recuperarDadosViaCep(cep)
            .done(function (dados) {
                if (dados) {
                    preencherCamposEndereco(campos, JSON.parse(dados));
                }
            });


    }
}

function preencherCamposEndereco(campos, dados) {
    $(campos.end).val(dados.logradouro);
    $(campos.comp).val(dados.complemento);
    $(campos.bairro).val(dados.bairro);
    $(campos.cidade).val(dados.localidade);
    $(campos.uf).val(dados.uf);
}

function recuperarDadosViaCep(cep) {
    return $.ajax({
        type: "GET",
        url: "/api/viacep/" + cep,
        context: this,
        beforeSend: function () {
            $("#loading").show();
        },
        complete: function () {
            $("#loading").hide();
        },
        success: function (data) {
            return data;
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function apagarRegistro(id){
    $.ajax({
        type: "DELETE",
        url: "/api/paciente/" + id,
        context: this,
        beforeSend: function () {
           // $("#loading").show();
        },
        complete: function () {
            //$("#loading").hide();
        },
        success: function (data) {
            if(data.message){
                toastr.warning(data.message);
            }else{
                toastr.info('removido com sucesso.');
            }

        },
        error: function (error) {
                toastr.error(error);
        }
    });

}

function limparCampos(campos){
    for(var i=0; i <= campos.length;i++){
        $(campos[i]).val('');
    }
}


function irParaLista(){
    $("#frmNovoPaciente")[0].reset();
}

function carregarDadosTabelaUltimaBusca() {
  return $.ajax({
        type: "GET",
        url: "/api/paciente/filtro",
        context: this,
        data: ultimaBusca,
        success: function (data) {
            var $table = $('#resultado_busca');
            var pacientes = resultado.data;
            $table.bootstrapTable('destroy');
            $table.bootstrapTable({data: pacientes});

        },
        error: function (error) {
            console.log(error);
        }
    });
}




function recuperarDados() {
    $.ajax({
        type: "GET",
        url: "/api/exame/categoria",
        context: this,
        success: function (data) {
            console.log(data);
        },
        error: function (error) {
            console.log(error);
        }
    });
    return retorno;
}
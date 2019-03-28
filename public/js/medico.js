var ultimaBusca;
var camposNovo = {
    nome: '#nome',
    cpf:'#cpf',
    dataNasc:'#data_nasc',
    telRes:'#telres',
    telCel:'#telcel',
    email:'#email',
    cep:'#cep',
    end:'#end',
    complemento:'#complemento',
    numero: '#numero',
    bairro: '#bairro',
    cidade: '#cidade',
    uf:   '#uf'
};

$('.campoBusca').keypress(function (e) {
    if (e.which == 13) {
        $('#btnBuscarMedico').click();
        return false;
    }
});

$(function () {
    var tratarBuscaCpfNovo = function () {
        return tratarBuscaCpf(camposNovo)
    };
    $('#cpf').blur(tratarBuscaCpfNovo);
});

$("#btnSalvarMedico").click(function (event) {
    event.preventDefault();
    var dados_medico = {
        'crm1': $("#crm").val(),
        'crm2': $("#crm2").val(),
        'nome': $("#nome").val(),
        'cpf': $(".cpf").cleanVal(),
        'cep': $(".cep").cleanVal(),
        'dataNasc': $("#data_nasc").val(),
        'tel_cel': $("#telcel").val(),
        'tel_res': $("#telres").val(),
        'email': $("#email").val(),
        'endereco': $("#end").val(),
        'complemento': $("#complemento").val(),
        'numero': $("#numero").val(),
        'bairro': $("#bairro").val(),
        'cidade': $("#cidade").val(),
        'uf': $("#uf").val(),
        'sexo': $("input[name='rd_sexo']:checked").val()
    };
    $.ajax({
        type: "POST",
        url: "/api/medico",
        data: dados_medico,
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
                $('#frmNovoMedico')[0].reset();
                limparMsgValidacao();
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

$("#btnBuscarMedico").click(function (event) {
    event.preventDefault();

    var busca_medico = {
        nome: $("#busca_nome").val(),
        cpf: $("#busca_cpf").cleanVal(),
        crm:  $("#busca_crm").val()

    };
    var ultimaBusca = busca_medico;
    $.ajax({
        type: "GET",
        url: "/api/medico/filtro",
        data: busca_medico,
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
            var $table = $('#resultado_busca');
            if (resultado) {
                var medicos = resultado;
                $table.bootstrapTable('destroy');
                $table.bootstrapTable({data: medicos});
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

$("#btnAtualizarMedico").click(function (event) {
    event.preventDefault();
    var dados_medico = {
        'id':$('#editar_id_medico').val(),
        'crm1':$('#editar_crm').val(),
        'nome': $("#editar_nome").val(),
        'cpf': $("#editar_cpf").cleanVal(),
        'cep': $("#editar_cep").cleanVal(),
        'dataNasc': $("#editar_data_nasc").val(),
        'tel_cel': $("#editar_tel_cel").val(),
        'tel_res': $("#editar_tel_res").val(),
        'email': $("#editar_email").val(),
        'endereco': $("#editar_end").val(),
        'complemento': $("#editar_complemento").val(),
        'numero': $("#editar_numero").val(),
        'bairro': $("#editar_bairro").val(),
        'cidade': $("#editar_cidade").val(),
        'uf': $("#editar_uf").val(),
        'sexo': $("input[name='editar_rdsexo']:checked").val()
    };
    $.ajax({
        type: "PUT",
        url: "/api/medico",
        data: dados_medico,
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
                    limparMsgValidacao();
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


function apagarRegistro(id){
    $.ajax({
        type: "DELETE",
        url: "/api/medico/" + id,
        context: this,
        success: function (data) {
            if(data.message){
                toastr.warning(data.message);

            }else{
                carregarDadosTabelaUltimaBusca()
                    .done(function(){
                        voltarParaLista();
                        toastr.info('Registro apagado com sucesso.');
                    });

            }

        },
        error: function (error) {
            toastr.error(error);
        }
    });

}

function carregarDadosTabelaUltimaBusca() {
    return $.ajax({
        type: "GET",
        url: "/api/medico/filtro",
        context: this,
        data: ultimaBusca,
        success: function (resultado) {
            var $table = $('#resultado_busca');
            var medicos = resultado.data;
            $table.bootstrapTable('destroy');
            $table.bootstrapTable({data: medicos});

        },
        error: function (error) {
            console.log(error);
        }
    });
}


function exibirResultadoPesquisa() {
    $('#sem_resultado').hide();
    $('#lista').show();
}
function exibirMsgSemResultado() {
    $('#lista').hide();
    $('#sem_resultado').show();
}

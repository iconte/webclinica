$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

function msgErro(msg) {
    $(".erro-msg").find("ul").html('');
    $(".erro-msg").css('display', 'block');
    $.each(msg, function (key, value) {
        $(".erro-msg").find("ul").append('<li>' + value + '</li>');
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
        'cpf': $("#cpf").cleanVal(),
        'dataNasc': $("#dataNasc").val(),
        'tel_cel': $("#tel_cel").val(),
        'email': $("#email").val(),
        'endereco': $("#endereco").val(),
        'numero': $("#numero").val(),
        'bairro': $("#bairro").val(),
        'cidade': $("#cidade").val(),
        'sexo': $(".rdSexo").checked()
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
            if (data.errors) {
                msgErro(data.errors);

            } else {
                $('#frmNovoPaciente')[0].reset();
                toastr.info('Registro salvo com sucesso.');
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
});


$("#btnBuscarPaciente").click(function (event) {
    event.preventDefault();

    var busca_pessoa = {
        nome: $("#busca_nome").val(),
        cpf: $("#busca_cpf").cleanVal(),
        dataNascimento: $("#busca_dn").val()

    };
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
            console.log(resultado.data);
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
            console.log(error.message);
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
    $("#loading").hide();
    $("#cep").blur(tratarCep);
});

function tratarCep() {
    var cep = $("#cep").cleanVal();
    var retorno;
    if (cep.length == 8) {
        recuperarDadosViaCep(cep);
    }
}

function preencherCamposEndereco(dados) {
    $("#end").val(dados.logradouro);
    $("#complemento").val(dados.complemento);
    $("#bairro").val(dados.bairro);
    $("#cidade").val(dados.localidade);
    $("#uf").val(dados.uf);
}

function recuperarDadosViaCep(cep) {
    $.ajax({
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
            if (data) {
                preencherCamposEndereco(JSON.parse(data));
            }
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
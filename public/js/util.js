$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});
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
    var tratarBuscaCpfNovo = function () {
        return tratarBuscaCpf(camposNovo)
    };
    var tratarCepNovo = function () {
        return tratarCep(camposCepNovo)
    };
    var tratarCepEdicao = function () {
        return tratarCep(camposCepEdicao)
    };

    aplicarMascaraCampos();
    $('#cpf').blur(tratarBuscaCpfNovo);
    $('#cep').blur(tratarCepNovo);
    //$('#editar_cpf').blur(tratarBuscaCpfEdicao);

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

function tratarBuscaCpf(campos) {
    var cpf = $(".cpf").cleanVal();
    var retorno;
    if (cpf.length == 11) {

        $.ajax({
            type: "GET",
            url: "/api/paciente/por-cpf/"+cpf,
            context: this,
            beforeSend: function () {
                $("#loading_cpf").show();
            },
            complete: function () {
                $("#loading_cpf").hide();
            },
            success: function (resultado) {
                if (resultado&& resultado.data) {
                    preencherCamposPessoa(campos, resultado.data);
                }
            }
        });
    }
}

function recuperarDadosViaCep(cep) {
    return $.ajax({
        type: "GET",
        url: "/api/viacep/" + cep,
        context: this,
        beforeSend: function () {
            $("#loading_cep").show();
        },
        complete: function () {
            $("#loading_cep").hide();
        },
        success: function (data) {
            return data;
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function preencherCamposEndereco(campos, dados) {
    $(campos.end).val(dados.logradouro);
    $(campos.comp).val(dados.complemento);
    $(campos.bairro).val(dados.bairro);
    $(campos.cidade).val(dados.localidade);
    $(campos.uf).val(dados.uf);
}

function preencherCamposPessoa(campos, dados) {
    $(campos.nome).val(dados.nome);
    if(dados.data_nasc){
        var dtnasc = moment(dados.data_nasc).locale('pt-BR').format('L');
        $(campos.dataNasc).val(dtnasc);
    }
    if(dados.sexo){
        $("input[name=rdsexo][value=" + dados.sexo + "]").attr('checked', 'checked');
    }
    $(campos.telRes).val(dados.tel_res);
    $(campos.telCel).val(dados.tel_cel);
    $(campos.cep).val(dados.cep);
    $(campos.numero).val(dados.numero);
    $(campos.email).val(dados.email);
    $(campos.end).val(dados.endereco);
    $(campos.comp).val(dados.complemento);
    $(campos.bairro).val(dados.bairro);
    $(campos.cidade).val(dados.cidade);
    $(campos.uf).val(dados.uf);
}

function aplicarMascaraCampos() {
    $(".date").mask("00/00/0000");
    $(".cpf").mask("000.000.000-00", {reverse: true});
    $(".phone_with_ddd").mask("(00) 0000-0000");
    $(".cep").mask("00000-000");
    $(".numero").mask("00000");
    $(".uf").mask("SS");
}

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
function limparMsgValidacao(){
    $(".erro-msg").find("ul").html('');
    $(".erro-msg").css('display', 'none');
}
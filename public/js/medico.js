var ultimaBusca;
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

$(function () {
    var camposNovo = {
        nome: "#nome",dataNasc:"#data_nasc",sexo:"#sexo",telRes:"#telres",telCel:"#telcel",email:"#email",
        end: "#end", cep:"#cep",numero:"#numero", comp: "#complemento", bairro: "#bairro", cidade: "#cidade", uf: "#uf"
    };
    var tratarBuscaCpfNovo = function () {
        return tratarBuscaCpf(camposNovo)
    };
    //var tratarBuscaCpfEdicao = function () {
     //   return tratarBuscaCpf(camposEdicao)
    //};
    aplicarMascaraCampos();
   $('#cpf').blur(tratarBuscaCpfNovo);
   //$('#editar_cpf').blur(tratarBuscaCpfEdicao);

});
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


$('.campoBusca').keypress(function (e) {
    if (e.which == 13) {
        $('#btnBuscarMedico').click();
        return false;
    }
});



$("#btnSalvarMedico").click(function (event) {
    event.preventDefault();
    var dados_medico = {
        'crm': $("#crm").val(),
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
var ultimaBusca;

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

$("#btnBuscarMedico").click(function (event) {
    event.preventDefault();

    var busca_medico = {
        nome: $("#busca_nome").val(),
        cpf: $(".cpf").cleanVal(),
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
            if (resultado && resultado.data && resultado.data.length > 0) {
                var medicos = resultado.data;
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


function exibirResultadoPesquisa() {
    $('#sem_resultado').hide();
    $('#lista').show();
}
function exibirMsgSemResultado() {
    $('#lista').hide();
    $('#sem_resultado').show();
}

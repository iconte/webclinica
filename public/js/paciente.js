$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

$("#btnSalvarPaciente").click(function (event) {
    event.preventDefault();

});



$("#btnBuscarPaciente").click(function (event) {
    event.preventDefault();

   var  busca_pessoa = {
        nome: $("#busca_nome").val(),
        cpf: $("#busca_cpf").val(),
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
            console.log(resultado);
            //console.log(resultado.data);

           if(resultado && resultado.data && resultado.data.length>0){
         //   if(resultado && resultado.length>0){
                pacientes = resultado.data;
                $('#resultado_busca').bootstrapTable({data: pacientes});

            /*    for(i=0;i<pacientes.length;i++) {
                    linha = montarLinha(pacientes[i]);
                    $('#resultado_busca>tbody').append(linha);
                }*/
                exibirResultadoPesquisa();
            }else{
                exibirMsgSemResultado();
            }


        },
        error: function (error) {
            console.log(error.message);
        }
    });




});



function exibirResultadoPesquisa(){
    $('#sem_resultado').hide();
    $('#lista').show();
}
function exibirMsgSemResultado(){
    $('#lista').hide();
    $('#sem_resultado').show();
}

$(function () {
    $("#loading").hide();
    $("#cep").blur(tratarCep);


});


function montarLinha(p) {
    var linha = "<tr>" +
        "<td>" + (p.cpf ? p.cpf : "") + "</td>" +
        "<td>" + (p.nome ? p.nome : "") + "</td>" +
        "<td>" + (p.email ? p.email : "") + "</td>" +
        "<td>" + (p.data_nasc ? p.data_nasc : "") + "</td>" +
        "<td>" +
        '<button class="btn btn-sm btn-primary fa fa-pencil" onclick="editar(' + p.id + ')"> Editar </button> ' +
        '<button class="btn btn-sm btn-danger fa fa-trash" onclick="remover(' + p.id + ')"> Apagar </button> ' +
        "</td>" +
        "</tr>";
    return linha;
}

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
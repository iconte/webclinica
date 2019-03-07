
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

$("#btnSalvarPaciente").click(function(event){
    event.preventDefault();

});


$(function(){
    $("#loading").hide();
    $("#cep").blur(tratarCep);

});

function tratarCep(){
    var cep = $("#cep").cleanVal();
    var retorno;
    if(cep.length == 8){
       recuperarDadosViaCep(cep);
    }
}

function preencherCamposEndereco(dados){
    $("#end").val(dados.logradouro);
    $("#complemento").val(dados.complemento);
    $("#bairro").val(dados.bairro);
    $("#cidade").val(dados.localidade);
    $("#uf").val(dados.uf);
}

function recuperarDadosViaCep(cep){
    $.ajax({
        type: "GET",
        url: "/api/viacep/"+cep,
        context: this,
        beforeSend: function() {$("#loading").show();},
        complete: function() {$("#loading").hide();},
        success: function(data) {
            if(data){
                preencherCamposEndereco(JSON.parse(data));
            }
        },
        error: function(error) {
            console.log(error);
        }
    });

}

function recuperarDados(){
    $.ajax({
        type: "GET",
        url: "/api/exame/categoria",
        context: this,
        success: function(data) {
            console.log(data);
        },
        error: function(error) {
            console.log(error);
        }
    });
    return retorno;
}
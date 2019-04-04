$(function () {
    $.get('/api/medico',function(resultado){
        var data= resultado.data;
        if(data){
            data.sort(function(a, b){
                if(a.pessoa.nome < b.pessoa.nome) { return -1; }
                if(a.pessoa.nome > b.pessoa.nome) { return 1; }
                return 0;
            });
            $("#lista_medicos").append('<option value="" selected>Selecione</option>');

            for(var i = 0;i<data.length;i++){
                $("#lista_medicos").append('<option value="'+data[i].id+'">'+ data[i].pessoa.nome+'</option>');

            }
        }
    });

        $('.typeahead').typeahead({
            hint: true,
            highlight: true,
            minLength: 4,
            source: function (query, result) {
                $.ajax({
                    url: "/api/medicamento/nome/"+query,
                    type: "GET",
                    success: function (resultado) {

                        result($.map(resultado.data, function (item) {
                            return item.nome_fabrica+ '<br><small>'+item.apresentacao+'</small>';
                        }));
                    }
                });
            }
        });


});

$("#btnSalvarConsulta").click(function (event) {
    event.preventDefault();
    var dados_consulta = {
        'nome': $("#nome").val(),
        'medicamento': $("#medicamento").val(),
        'exame': $("#exame").val(),
        'medico_id': $("#lista_medicos").val()
    };
    $.ajax({
        type: "POST",
        url: "/api/consulta",
        data: dados_consulta,
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
                $('#frmNovaConsulta')[0].reset();
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



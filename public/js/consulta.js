$(function () {
    var timeout;
    $.get('/api/medico', function (resultado) {
        var data = resultado.data;
        if (data) {
            data.sort(function (a, b) {
                if (a.pessoa.nome < b.pessoa.nome) {
                    return -1;
                }
                if (a.pessoa.nome > b.pessoa.nome) {
                    return 1;
                }
                return 0;
            });
            $("#lista_medicos").append('<option value="" selected>Selecione</option>');

            for (var i = 0; i < data.length; i++) {
                $("#lista_medicos").append('<option value="' + data[i].id + '">' + data[i].pessoa.nome + '</option>');

            }
        }
    });

    $('#med').typeahead({
        hint: true,
        highlight: true,
        source: function (query, result) {

            if (timeout) {
                clearTimeout(timeout);
            }

            timeout = setTimeout(function() {
                $.ajax({
                    url: "/api/medicamento/nome/" + query,
                    type: "GET",
                    success: function (resultado) {
                        result($.map(resultado.data, function (item) {
                            //var itm = ''
                            //+ "<div class='typeahead_wrapper'>"
                            //+ "<div class='typeahead_labels'>"
                            //+ "<div class='typeahead_primary'>" + item.nome_fabrica + "</div>"
                            //+ "<div class='typeahead_secondary'><small>" + item.nome_generico +"</small></div>"
                            //+ "<div class='typeahead_secondary'><small>" + item.apresentacao+ "</small></div>"
                            //+ "</div>"
                            //+ "</div>";
                            //return itm;
                            return item.nome_fabrica + ' ' + item.apresentacao;
                        }));
                    }
                });
            }, 300);


        },

    },400);

    $('#ex').typeahead({
        hint: true,
        highlight: true,
        minLength: 4,
        source: function (query, result) {
            $.ajax({
                url: "/api/exame/nome-codsus/" + query,
                type: "GET",
                success: function (resultado) {

                    result($.map(resultado.data, function (item) {
                        return item.cod_sus + ' - ' + item.descricao;
                    }));
                }
            });
        }
    }, 400);


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

            if (data) {
                if (data.errors) {
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



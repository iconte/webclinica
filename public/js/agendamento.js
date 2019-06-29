$(function () {
    var camposCpf = {nome: "#nome",cpf:"#cpf" };
    var buscarPacientePorCpf = function(){
        return tratarBuscaCpf(camposCpf);
    }
    $('#data_agendamento').datetimepicker({
        locale: moment.locale('pt-BR'),
        format: 'L',
        daysOfWeekDisabled: [0,6],
        minDate: moment(),
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });

    $('#data_agendamento_busca').datetimepicker({
        locale: moment.locale('pt-BR'),
        format: 'L',
        daysOfWeekDisabled: [0,6],
        minDate: moment(),
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });


    $.get('/api/medico',function(resultado){
        carregarListaMedico(resultado,'#lista_medicos');
    });

    $.get('/api/especialidade',function(resultado){

        var data= resultado.data;
        if(data){
            data.sort(function(a, b){
                if(a.descricao < b.descricao) { return -1; }
                if(a.descricao > b.descricao) { return 1; }
                return 0;
            });
            $("#lista_especialidades").append('<option value="" selected>Selecione</option>');

            for(var i = 0;i<data.length;i++){
                $("#lista_especialidades").append('<option value="'+data[i].id+'">'+ data[i].descricao+'</option>');
            }
        }

    });

    $("#cpf").blur(buscarPacientePorCpf);
});


function carregarListaMedico(resultado,idCombo){
    var data= resultado.data;
    if(data){
        data.sort(function(a, b){
            if(a.pessoa.nome < b.pessoa.nome) { return -1; }
            if(a.pessoa.nome > b.pessoa.nome) { return 1; }
            return 0;
        });
        $(idCombo).append('<option value="" selected>Selecione</option>');


        for(var i = 0;i<data.length;i++){
            $(idCombo).append('<option value="'+data[i].id+'">'+ data[i].pessoa.nome+'</option>');

        }

    }
}


function carregarHorariosDisponiveis(event,dt_selecionada,medicoId){
    if(dt_selecionada && medicoId){
        dt_selecionada = moment(dt_selecionada,'DD/MM/YYYY');
        var dataDB = dt_selecionada.format('YYYY-MM-DD');
        var parametros = {'medicoId': medicoId, 'data_agendamento' :dataDB};
        $.ajax({
            type: "GET",
            url: "/api/agendamento/horario",
            data: parametros,
            context: this,
            beforeSend: function () {
                $("#loading_horarios").show();
            },
            complete: function () {
                $("#loading_horarios").hide();
            },
            success: function (data) {
                $("#lista_horarios").empty();
                if(data){
                    for(var i = 0;i<data.length;i++){
                        $("#lista_horarios").append('<option value="'+data[i]+'">'+ data[i].substr(0,5)+'</option>');
                    }
                }
            }
        });
    }else{
        $("#lista_horarios").empty();
    }
}


$("#data_agendamento").blur(function(event){
    var dt_selecionada = $("#data_agendamento").val();
    var medicoId = $("#lista_medicos").val();
    carregarHorariosDisponiveis(event,dt_selecionada,medicoId);
});

$("#btnBuscarAgendamento").click(function (event) {
    event.preventDefault();

    var busca_agendamento = {
        nome: $("#busca_nome").val(),
        data_agendamento: $("#data_agendamento_busca").val(),
        medico_id: $("#lista_medicos").val()
    };
    var ultimaBusca = busca_agendamento;
    $.ajax({
        type: "GET",
        url: "/api/agendamento/filtro",
        data: busca_agendamento,
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
                var agendamentos = resultado.data;
                $table.bootstrapTable('destroy');
                $table.bootstrapTable({data: agendamentos});
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

$("#btnSalvarAgendamento").click(function (event) {
    event.preventDefault();
    var dados_agendamento = {
        'nome': $("#nome").val(),
        'cpf': $(".cpf").cleanVal(),
        'data_agendamento': $("#data_agendamento").val(),
        'hora_agendamento': $("#lista_horarios").val(),
        'medico_id': $("#lista_medicos").val()
    };
    $.ajax({
        type: "POST",
        url: "/api/agendamento",
        data: dados_agendamento,
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
                $('#frmNovoAgendamento')[0].reset();
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


$("#btnAtualizarAgendamento").click(function (event) {
    event.preventDefault();
    var dados_agendamento = {
        'id': $("#editar_id_agendamento").val(),
        'nome': $("#editar_nome").val(),
        'cpf': $(".cpf").cleanVal(),
        'data_agendamento': $("#editar_data_agendamento").val(),
        'hora_agendamento': $("#editar_lista_horarios").val(),
        'medico_id': $("#editar_lista_medicos").val()
    };
    $.ajax({
        type: "PUT",
        url: "/api/agendamento",
        data: dados_agendamento,
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
                $('#frmEditarAgendamento')[0].reset();
                limparMsgValidacao();
                $('.busca').fadeIn();
                $('.edicao').fadeOut();
                toastr.info('Registro atualizado com sucesso.');

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



function exibirResultadoPesquisa() {
    $('#sem_resultado').hide();
    $('#lista').show();
}
function exibirMsgSemResultado() {
    $('#lista').hide();
    $('#sem_resultado').show();
}

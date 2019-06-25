$(function () {
    var camposCpf = {nome: "#nome",cpf:"#cpf" };
    var buscarPacientePorCpf = function(){
        return tratarBuscaCpf(camposCpf);
    }
    $('#data_agendamento').datetimepicker({
        locale: moment.locale('pt-BR'),
        format: 'L',
        daysOfWeekDisabled: [0,6],
        //disabledHours: [0, 1, 2, 3, 4, 5, 6, 19, 20, 21, 22, 23, 24],
        minDate: moment(),
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });

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

$("#data_agendamento").blur(function(event){
    var dt_selecionada = $("#data_agendamento").val();
    var medicoId = $("#lista_medicos").val();
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
                        $("#lista_horarios").append('<option value="'+data[i]+'">'+ data[i]+'</option>');
                    }
                }
            }
        });
    }



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

function exibirResultadoPesquisa() {
    $('#sem_resultado').hide();
    $('#lista').show();
}
function exibirMsgSemResultado() {
    $('#lista').hide();
    $('#sem_resultado').show();
}

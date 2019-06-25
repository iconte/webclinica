@extends('theme.default')

@section('titulo')
    <div class="row">
        <div class="col-lg-12">
            <h4>Novo Agendamento</h4>
            <hr/>
        </div>
    </div>

@endsection
@section('content')
    <div class="alert alert-danger erro-msg" style="display:none">
        <ul></ul>
    </div>
    <form role="form" id="frmNovoAgendamento">

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Médico</label>
                    <select class="form-control" id="lista_medicos"></select>
                </div>
            </div>
        </div>


        <div class="row">
            <div class='col-lg-4'>
                <div class="form-group">
                    <label>Data <span style="color:red">*</span></label>
                    <div class="input-group">
                      <input id="data_agendamento" class="form-control" maxlength="16">
                         <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                     </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class='col-lg-4'>
                <div class="form-group">
                    <label>Horários disponíveis <span style="color:red">*</span> </label>
                    <div class="input-group">
                        <select class="form-control" id="lista_horarios"></select><img id="loading_horarios" src="/gif/loading.gif"
                                                                                       style="width: 10%;display: none">
                    </div>
                </div>
            </div>
        </div>



        {{--<div class="row">--}}
            {{--<div class="col-lg-4">--}}
                {{--<div class="form-group">--}}
                    {{--<label>Especialidade</label>--}}
                    {{--<select class="form-control" id="lista_especialidades"></select>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <label>CPF <span style="color:red">*</span> <img id="loading_cpf" src="/gif/loading.gif"
                                    style="width: 25%;display: none"/></label>
                    <input id="cpf" name="cpf" class="form-control cpf" maxlength="11">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nome <span style="color:red">*</span></label>
                    <input id="nome" name="nome" class="form-control " maxlength="255">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <button id="btnSalvarAgendamento" class="btn btn-primary col-xs-12 col-sm-3"
                            style="margin-bottom:5px;">
                        <span id="salvar"><i class="fa fa-save"></i> Salvar</span>
                        <span id="salvando" style="display: none;">Salvando...</span>
                    </button>

                </div>
            </div>
        </div>
    </form>
    <script type="text/javascript" src="/js/util.js"></script>
    <script type="text/javascript" src="/js/agendamento.js"></script>




@endsection



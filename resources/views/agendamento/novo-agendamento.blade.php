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
            <div class="col-xs-12 col-lg-4">
                <div class="form-group">
                    <label>Especialidade</label>
                    <select class="form-control" id="lista_especialidades"></select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-lg-4">
                <div class="form-group">
                    <label>Médico <span style="color:red">*</span>
                        <img id="loading_medicos" src="/gif/loading.gif" style="width: 10%;display: none"/>
                    </label>
                    <select class="form-control" id="lista_medicos"></select>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-12 col-lg-4">
                <div class="form-group">
                    <label>Data <span style="color:red">*</span></label>
                    <div class="input-group ">
                      <input id="data_agendamento" class="form-control" maxlength="16">
                         <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                     </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-lg-4">
                <div class="form-group">
                    <label>Horários disponíveis <span style="color:red">*</span>
                        <img id="loading_horarios" src="/gif/loading.gif" style="width: 10%;display: none"/>
                    </label>
                    <div class="input-group col-xs-12">
                        <select class="form-control" id="lista_horarios"></select>
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
        @if(Auth::user()->tipo_usuario == 'usr')
            <input id="cpf" type="hidden" class="cpf"  maxlength="11" value="{{Auth::user()->pessoa->cpf}}">
            <input id="nome" type="hidden" class="nome"  maxlength="255" value="{{Auth::user()->pessoa->nome}}">
        @else
            <div class="row">
                <div class="col-xs-12 col-lg-2">
                    <div class="form-group">
                        <label>CPF <span style="color:red">*</span> <img id="loading_cpf" src="/gif/loading.gif"
                                                                         style="width: 25%;display: none"/></label>
                        <input id="cpf" name="cpf" class="form-control cpf" maxlength="11">
                    </div>
                </div>
                <div class="col-xs-12 col-lg-6">
                    <div class="form-group">
                        <label>Nome <span style="color:red">*</span></label>
                        <input id="nome" name="nome" class="form-control nome" maxlength="255">
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-xs-12 col-lg-6">
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



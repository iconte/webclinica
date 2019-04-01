@extends('theme.default')

@section('titulo')
    <div class="row">
        <div class="col-lg-12">
            <h4>Nova Consulta</h4>
            <hr/>
        </div>
    </div>

@endsection
@section('content')
    <div class="alert alert-danger erro-msg" style="display:none">
        <ul></ul>
    </div>
    <form role="form" id="frmNovaConsulta">

        <div class="row">
            <div class="col-lg-8">
                <div class="form-group">
                    <label>Médico</label>
                    <select class="form-control" id="lista_medicos"></select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="form-group">
                    <label>Paciente <span style="color:red">*</span></label>
                    <input id="nome" name="nome" class="form-control " maxlength="255">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="form-group">
                    <label>Anamnese</label>
                    <textarea id="anamnese" name="anamnese" class="form-control " rows="8" cols="8" maxlength="500"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="form-group">
                    <label>Exames </label>
                    <textarea id="exame" name="exame" class="form-control " rows="8" cols="8" maxlength="500"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="form-group">
                    <label>Receituário</label>
                    <textarea id="medicamento" name="medicamento" class="form-control " rows="8" cols="8" maxlength="500"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <button id="btnSalvarConsulta" class="btn btn-primary col-xs-12 col-sm-3"
                            style="margin-bottom:5px;">
                        <span id="salvar"><i class="fa fa-save"></i> Salvar</span>
                        <span id="salvando" style="display: none;">Salvando...</span>
                    </button>

                </div>
            </div>
        </div>
    </form>
    <script type="text/javascript" src="/js/util.js"></script>
    <script type="text/javascript" src="/js/consulta.js"></script>




@endsection



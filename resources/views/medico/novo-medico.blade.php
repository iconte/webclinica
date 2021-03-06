@extends('theme.default')

@section('titulo')
    <div class="row">
        <div class="col-lg-8">
            <h4>Novo Medico</h4>
            <hr/>
        </div>
    </div>

@endsection
@section('content')
    <div class="alert alert-danger erro-msg" style="display:none">
        <ul></ul>
    </div>
    <form role="form" id="frmNovoMedico">
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <label>CRM <span style="color:red">*</span></label>
                    <input id="crm" name="crm" class="form-control "  maxlength="20">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label>CRM secundário</label>
                    <input id="crm2" name="crm2" class="form-control "  maxlength="20">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xs-12 col-lg-4">
                <div class="form-group">
                    <label>Especialidade <span style="color:red">*</span></label>
                    <select class="form-control" id="lista_especialidades"></select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <label>CPF <span style="color:red">*</span><img id="loading_cpf" src="/gif/loading.gif" style="width: 25%;display: none"/></label>
                    <input id="cpf" name="cpf" class="form-control cpf"  maxlength="11">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nome <span style="color:red">*</span></label>
                    <input id="nome" name="nome" class="form-control" maxlength="100">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Data de nascimento <span style="color:red">*</span></label>
                    <input id="data_nasc" name="data_nasc" class="form-control date" maxlength="10" >
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Sexo</label>

                    <div class="radio">
                        <label class="radio-inline">
                            <input type="radio" name="rd_sexo" id="optionsRadiosInline1" value="M"
                                   checked="checked">Masculino
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="rd_sexo" id="optionsRadiosInline2" value="F">Feminino
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Tel. Residencial</label>
                    <input id="telres" name="telres" class="form-control phone_with_ddd"  maxlength="11">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Tel. Celular <span style="color:red">*</span></label>
                    <input id="telcel" name="telcel" class="form-control phone_with_ddd"  maxlength="11">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label>Email <span style="color:red">*</span></label>
                    <input id="email" name="email" class="form-control" maxlength="20">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <label>CEP <img id="loading_cep" src="/gif/loading.gif" style="width: 25%;display: none"/> </label>
                    <input class="form-control cep" name="cep" id="cep"  maxlength="10">
                </div>
            </div>
            <div class="col-lg-5">
                <div class="form-group">
                    <label>Endereço <span style="color:red">*</span></label>
                    <input class="form-control" name="end" id="end" maxlength="200">
                </div>
            </div>
            <div class="col-lg-1">
                <div class="form-group">
                    <label>Numero<span style="color:red">*</span></label>
                    <input class="form-control numero" name="numero" id="numero" maxlength="5" >
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Complemento</label>
                    <input class="form-control" name="complemento" id="complemento" maxlength="100">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Bairro <span style="color:red">*</span></label>
                    <input class="form-control" name="bairro" id="bairro">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Cidade <span style="color:red">*</span></label>
                    <input class="form-control" name="cidade" id="cidade">
                </div>
            </div>
            <div class="col-lg-1">
                <div class="form-group">
                    <label>UF </label>
                    <input class="form-control uf" name="uf" id="uf" maxlength="2">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <button id="btnSalvarMedico" class="btn btn-primary col-xs-12 col-sm-3" style="margin-bottom:5px;" >
                        <span id="salvar"><i class="fa fa-save"></i> Salvar</span>
                        <span id="salvando" style="display: none;">Salvando...</span>
                    </button>

                </div>
            </div>
        </div>
    </form>
    <script type="text/javascript" src="/js/util.js"></script>
    <script type="text/javascript" src="/js/medico.js"></script>

@endsection



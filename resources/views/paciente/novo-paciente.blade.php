@extends('theme.default')

@section('content')

    <div class="row">

        <div class="col-lg-12">

            <h3 class="page-header">Novo Paciente</h3>

        </div>

    </div>
    <form role="form">
        <div class="row">
            <div class="col-lg-8">
                <div class="form-group">
                    <label>Nome</label>
                    <input id="nome" name="nome" class="form-control">
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-lg-2">
                <div class="form-group">
                    <label>CPF</label>
                    <input id="cpf" name="cpf" class="form-control" data-mask="000.000.000-00" maxlength="11">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Data de Nascimento</label>
                    <input id="data_nasc" name="data_nasc" class="form-control" maxlength="10" data-mask="00/00/0000">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Sexo</label>

                    <div class="radio">
                        <label class="radio-inline">
                            <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline1" value="M"
                                   checked="checked">Masculino
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline2" value="F">Feminino
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Tel. Residencial</label>
                    <input id="telres" name="telres" class="form-control" data-mask="(00) 0000-0000" maxlength="11">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Tel. Celular</label>
                    <input id="telcel" name="telcel" class="form-control" data-mask="(00) 0000-0000" maxlength="11">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label>Email</label>
                    <input id="email" name="email" class="form-control" maxlength="20">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <label>CEP <img id="loading" src="/gif/loading.gif" style="width: 25%;display: none"/> </label>
                    <input class="form-control" name="cep" id="cep" data-mask="00.000-000" maxlength="10">
                </div>
            </div>
            <div class="col-lg-5">
                <div class="form-group">
                    <label>Endereço</label>
                    <input class="form-control" name="end" id="end" maxlength="200">
                </div>
            </div>
            <div class="col-lg-1">
                <label>Número</label>
                <input class="form-control" name="numero" id="numero" maxlength="5" data-mask="00000">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2">
                <label>Complemento</label>
                <input class="form-control" name="complemento" id="complemento" maxlength="100">
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Bairro</label>
                    <input class="form-control" name="bairro" id="bairro">
                </div>
            </div>
            <div class="col-lg-3">
                <label>Cidade</label>
                <input class="form-control" name="cidade" id="cidade">
            </div>
            <div class="col-lg-1">
                <label>UF</label>
                <input class="form-control" name="uf" id="uf" maxlength="2">
            </div>
        </div>
        <div class="footer">
            <div class="row">
                <div class="col-lg-6">
                    <button id="btnSalvarPaciente" class="btn btn-primary" >Salvar</button>
                    <button id="btnCancelarPaciente" class="btn btn-default">Cancelar</button>
                </div>
            </div>
        </div>



    </form>
    <script type="text/javascript" src="/js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="/js/paciente.js"></script>

@endsection



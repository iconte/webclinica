@extends('theme.default')

@section('content')

    <div class="row">

        <div class="col-lg-12">

            <h2 class="page-header">Novo Usuário</h2>

        </div>

    </div>
    <form role="form">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nome</label>
                    <input id="nome" name="nome" class="form-control">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label>CPF</label>
                    <input id="cpf" name="cpf" class="form-control">
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">

                <div class="form-group">
                    <label>Login</label>
                    <input id="login" name="login" class="form-control">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>E-mail</label>
                    <input id="email" name="email" class="form-control">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Senha</label>
                    <input id="senha" type="password" name="senha" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">

                <div class="form-group">
                    <label>Confirmação</label>
                    <input id="conf_senha" type="password" name="conf_senha" class="form-control">
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="row">
                <div  class="col-lg-6">
                    <button type="submit" class="btn btn-primary" >Salvar</button>
                    <button  class="btn btn-default">Cancelar</button>
                </div>
            </div>
        </div>
    </form>

@endsection
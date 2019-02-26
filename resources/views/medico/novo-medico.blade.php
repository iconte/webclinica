@extends('theme.default')

@section('content')

    <div class="row">

        <div class="col-lg-12">

            <h2 class="page-header">Novo Médico</h2>

        </div>

    </div>
    <form role="form">
        <div class="row">
             <div class="col-xs-8">

                        <div class="form-group">
                            <label>Nome</label>
                            <input id="nome" name="nome" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Text Input with Placeholder</label>
                            <input class="form-control" placeholder="Enter text">
                        </div>
                </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <label>Data Nascimento</label>
                    <input id="data_nasc" name="data_nasc" class="form-control" >
                </div>
            </div>
            <div class="col-xs-2">
                <img src={{asset('images/avatar-m.png')}}>
            </div>

        </div>
    </form>

@endsection
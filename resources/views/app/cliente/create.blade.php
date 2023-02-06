@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')
    
    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            @if(isset($cliente->id))
                <p>Editar Cliente</p>
            @else
                <p>Adicionar Cliente</p>
            @endif
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('cliente.index') }}">Voltar</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>
 
        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">

                @if(isset($cliente->id))
                    <form method="post" action="{{ route('cliente.update', ['produto' => $cliente->id]) }}">
                        @csrf
                        @method('PUT')
                @else
                    <form method="post" action="{{ route('cliente.store') }}">
                        @csrf
                @endif
                    <input type="text" name="nome" value="{{ $cliente->nome ?? old('nome') }}" placeholder="Nome" class="borda-preta">
                    {{ $errors->has('nome') ? $errors->first('nome') : '' }}


                    {{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}
                    
                    <button type="submit" class="borda-preta">Cadastrar</button>
                <form>
            </div>
        </div>

    </div>

@endsection


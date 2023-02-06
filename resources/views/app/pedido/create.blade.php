@extends('app.layouts.basico')

@section('titulo', 'Pedido')

@section('conteudo')
    
    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            @if(isset($pedido->id))
                <p>Editar Pedido</p>
            @else
                <p>Adicionar Pedido</p>
            @endif
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('pedido.index') }}">Voltar</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>
 
        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">

                @if(isset($pedido->id))
                    <form method="post" action="{{ route('pedido.update', ['pedido' => $pedido->id]) }}">
                        @csrf
                        @method('PUT')
                @else
                    <form method="post" action="{{ route('pedido.store') }}">
                        @csrf
                @endif

                    <input type="text" name="nome" value="{{ $pedido->nome ?? old('nome') }}" placeholder="Nome" class="borda-preta">
                    {{ $errors->has('nome') ? $errors->first('nome') : '' }}

                    <select name="cliente_id">
                        <option>-- Selecione um Cliente --</option>

                        @foreach ($clientes as $cli)
                            <option value="{{ $cli->id }}" {{ ( $pedido->cliente_id ?? old('cliente_id') ) == $cli->id ? 'selected' : '' }} >{{ $cli->nome }}</option>
                        @endforeach
                    </select> 

                    {{ $errors->has('cliente_id') ? $errors->first('cliente_id') : '' }}
                    
                    <button type="submit" class="borda-preta">Cadastrar</button>
                <form>
            </div>
        </div>

    </div>

@endsection


@extends('app.layouts.basico')

@section('titulo', 'Detalhes do Produto')

@section('conteudo')
    
    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            @if(isset($_detalheproduto->id))
                <p>Editar Produto</p>
            @else
                <p>Adicionar Detalhe do Produto</p>
            @endif
        </div>

        <div class="menu">
            <ul>
                <li><a href="">Voltar</a></li>
                
            </ul>
        </div>
 
        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">

                @if(isset($_detalheproduto->id))
                    <form method="post" action="{{ route('produto-detalhe.update', ['produto' => $produto_detalhe->id]) }}">
                        @csrf
                        @method('PUT')
                @else
                    <form method="post" action="{{ route('produto-detalhe.store') }}">
                        @csrf
                @endif
                    <input type="text" name="produto_id" value="{{ $produto_detalhe->produto_id ?? old('produto_id') }}" placeholder="produto_id" class="borda-preta">
                    {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}

                    <input type="text" name="comprimento" value="{{ $produto_detalhe->comprimento ?? old('comprimento') }}" placeholder="comprimento" class="borda-preta">
                    {{ $errors->has('comprimento') ? $errors->first('comprimento') : '' }}

                    <input type="text" name="largura" value="{{ $produto_detalhe->largura ?? old('largura') }}" placeholder="Largura" class="borda-preta">
                    {{ $errors->has('largura') ? $errors->first('largura') : '' }}

                    <input type="text" name="altura" value="{{ $produto_detalhe->altura ?? old('altura') }}"  placeholder="Altura" class="borda-preta">
                    {{ $errors->has('altura') ? $errors->first('altura') : '' }}

                    <select name="unidade_id">
                        <option>-- Selecione a Unidade de Medida --</option>

                        @foreach($unidades as $unidade)
                            <option value="{{ $unidade->id }}" {{ ($_detalheproduto->unidade_id ?? old('unidade_id')) == $unidade->id ? 'selected' : '' }} >{{ $unidade->descricao }}</option>
                        @endforeach
                    </select>
                    {{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}
                    
                    <button type="submit" class="borda-preta">Cadastrar</button>
                <form>
            </div>
        </div>

    </div>

@endsection


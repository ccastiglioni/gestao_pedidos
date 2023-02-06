@extends('app.layouts.basico')

@section('titulo', 'Pedido Produto')

@section('conteudo')
    
    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">   
                <p>Adicionar Produtos ao Pedido</p>  
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('pedido.index') }}">Voltar</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>
 
        <div class="informacao-pagina">
            
            <h4> Detalhes do Pedido</h4>
            <div style="margin-left:17%">
            <table border="1" width='80%'>
                <thead>
                    <tr>
                        <th>ID</th> 
                        <th>Nome produto</th> 
                        <th>Data de Cadastro</th> 
                    </tr>
                </thead>
                    <tbody>
                        @foreach ($pedido->Produto_n_pedidos as $p )
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->nome }}</td>
                            <td>{{ $p->created_at->format('d/m/Y') .' ás ' . $p->created_at->format('H').'h' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
 
                <form method="post" action="{{ route('pedido-produto.store', ['pedido' => $pedido]) }}">                     
                    @csrf

                    <select name="produto_id">
                        <option>-- Selecione um produto --</option>

                        @foreach ($produtos as $p)
                            <option value="{{ $p->id }}" {{ ( old('produto_id') ) == $p->id ? 'selected' : '' }} >{{ $p->descricao }}</option>
                        @endforeach
                    </select>
                    {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}

                    <input type="text" name="quantidade" value="{{ old('quantidade') ? old('quantidade') : '' }}"  placeholder="quantidade" class="borda-preta">
                    {{ $errors->has('quantidade') ? $errors->first('quantidade') : '' }}
                    
                    <button type="submit" class="borda-preta">Cadastrar</button>
                <form>
            </div>
        </div>

    </div>

@endsection


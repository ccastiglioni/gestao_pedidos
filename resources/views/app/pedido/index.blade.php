@extends('app.layouts.basico')

@section('titulo', 'Cliente')

@section('conteudo')

    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Listagem de Pedido</p>
        </div>

        <div class="menu">
            <ul>
                <li><button><a href="{{ route('pedido.create') }}">Novo</a></button></li>
                <li><button><a href="">Consulta</a></button></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Cliente</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
 
                    <tbody>
                        @foreach ($pedidos as $ped)
                            <tr>
                                <td>{{ $ped->id }}</td>
                                <td>{{ $ped->nome }}</td>
                                <td>{{ $ped->cliente_id }}</td>
                                <td> <a href="{{ route('pedido-produto.create',['pedido'=>$ped->id ]) }}"> Adicionar Produtos</a> </td>
                                
                                <td><a href="{{ route('pedido.show', ['pedido'=>$ped->id]) }}">Visualizar</a></td>
                                <td><a href="{{ route('pedido.edit', ['pedido'=>$ped->id]) }}">Editar</a></td>
                                <td>
                                    <form method="POST" action="{{ route('pedido.destroy',["pedido"=>$ped->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                         
                                           <button type="submit" style="background-color:red;width:91%;padding:7px 1px;" type="submit"> Deletar</button> 
                                    </form>
                                     
                                </td>
                          
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pedidos->appends($request)->links() }}
                <!--
                <br>
                {{ $pedidos->count() }} - Total de registros por página
                <br>
                {{ $pedidos->total() }} - Total de registros da consulta
                <br>
                {{ $pedidos->firstItem() }} - Número do primeiro registro da página
                <br>
                {{ $pedidos->lastItem() }} - Número do último registro da página
                -->
                <br>
                Exibindo {{ $pedidos->count() }} Pedidos de {{ $pedidos->total() }} (de {{ $pedidos->firstItem() }} a {{ $pedidos->lastItem() }})
            </div>
        </div>

    </div>

@endsection

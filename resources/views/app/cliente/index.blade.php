@extends('app.layouts.basico')

@section('titulo', 'Cliente')

@section('conteudo')

    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Listagem de Clientes</p>
        </div>

        <div class="menu">
            <ul>
                <li><button><a href="{{ route('cliente.create') }}">Novo</a></button></li>
                <li><button><a href="">Consulta</a></button></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($clientes as $cli)
                            <tr>
                                <td>{{ $cli->nome }}</td>
                                
                                <td><a href="{{ route('cliente.show', ['cliente'=>$cli->id]) }}">Visualizar</a></td>
                                <td><a href="{{ route('cliente.edit', ['cliente'=>$cli->id]) }}">Editar</a></td>
                                <td>
                                    <form method="POST" action="{{ route('cliente.destroy',["cliente"=>$cli->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                         
                                           <button type="submit" style="background-color:red;width:91%;padding:7px 1px;" type="submit"> Deletar</button> 
                                    </form>
                                     
                                </td>
                          
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $clientes->appends($request)->links() }}

                <!--
                <br>
                {{ $clientes->count() }} - Total de registros por p??gina
                <br>
                {{ $clientes->total() }} - Total de registros da consulta
                <br>
                {{ $clientes->firstItem() }} - N??mero do primeiro registro da p??gina
                <br>
                {{ $clientes->lastItem() }} - N??mero do ??ltimo registro da p??gina

                -->
                <br>
                Exibindo {{ $clientes->count() }} Clientes de {{ $clientes->total() }} (de {{ $clientes->firstItem() }} a {{ $clientes->lastItem() }})
            </div>
        </div>

    </div>

@endsection

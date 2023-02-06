@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')
<style>
    label{
    display: flex;
    clear: left;
    width: 250px;
}
</style>
    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Produto - Visualizar</p>
        </div>
         
        <div class="menu">
            <ul>
                <li> <button> <a href="{{ route('produto.index') }}">Voltar</a></button> </li>
                <li><button><a href="{{ route('produto.index') }}">Consulta</a></button></li>
            </ul>
        </div>
           
        <div class="informacao-pagina">
      
      
            <table id="customers">
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Peso</th>
                        <th>Unidade de medida</th>
                    </tr>

                    <tr>
                        <td> #{{ $produto->id }}</td>
                        <td>{{ $produto->descricao }}</td>
                        <td>{{ $produto->peso }}</td>
                        <td>{{ $produto->unidade_id }}</td>
                    </tr>
                 </table>
             
        </div>

    </div>

@endsection

@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')

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
            <p>Fornecedor - Adicionar</p>
        </div>
         
        <div class="menu">
            <ul>
                <li> <button> <a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></button> </li>
                <li><button><a href="{{ route('app.fornecedor') }}">Pesquisar</a></button></li>
                <li><button><a href="{{ route('app.fornecedor.listar') }}">Listar</a></button></li>
            </ul>
        </div>
           
        <div class="informacao-pagina">
            {{ $data['msg'] ?? '' }}
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <form method="post" action="{{ route('app.fornecedor.adicionar') }}">
                    <input type="hidden" name="id" value="{{ $fornecedor->id ?? '' }}" >
                    @csrf
                    <input type="text" name="nome" value="{{ $fornecedor->nome ?? old('nome') }}" placeholder="seu nome" class="borda-preta">
                    {{ $errors->has('nome') ? $errors->first('nome') : '' }}

                    <input type="text" name="site" value="{{ $fornecedor->site ?? old('site') }}" placeholder="seu Site" class="borda-preta">
                    {{ $errors->has('site') ? $errors->first('site') : '' }}

                    <input type="text" name="uf" value="{{ $fornecedor->uf ?? old('uf') }}" placeholder="seu estado" class="borda-preta">
                    {{ $errors->has('uf') ? $errors->first('uf') : '' }}

                    <input type="text" name="email" value="{{ $fornecedor->email ?? old('email') }}" placeholder="E-mail" class="borda-preta">
                    {{ $errors->has('email') ? $errors->first('email') : '' }}

                   <div style="display: flex">
                      <label> Usar : Facades\DB</label>  <input type="checkbox" name="DB" value="1"  style="margin: initial;" >
                  </div> 

                   <div style="display: flex">
                      <label> Usar : save()</label>  <input type="checkbox" name="save" value="1"  style="margin: initial;" >
                  </div> 
                   <div style="display: flex">
                      <label> Usar : create()</label>  <input type="checkbox" name="create" value="1"  style="margin: initial;" >
                  </div> 

                    <button type="submit" class="borda-preta">{{ $data['btnlabel'] }}</button>
                </form>
            </div>
        </div>

    </div>

@endsection

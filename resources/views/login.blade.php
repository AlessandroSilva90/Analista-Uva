@extends('layout')

@section('content')

<form>
    <div class="d-flex flex-column mb-3">
        <label class="">Usuário</label>
        <input type="text" class="border border-secondary p-2 rounded w-50" placeholder="Inserir usuário">
    </div>
    <div class="d-flex flex-column mb-3">
        <label>Senha</label>
        <input type="password" class="border border-secondary p-2 rounded" placeholder="Inserir Senha">
    </div>
</form>

@endsection

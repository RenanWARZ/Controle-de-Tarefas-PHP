@csrf

<div class="col-md-4">
    <label for="name" class="form-label">Nome:</label>
    <input type="text" name="name" id="name" class="form-control" placeholder="Digite o nome completo"
        value="{{ old('name', $usuario->user->name ?? '') }}">
</div>

<div class="col-md-4">
    <label for="email" class="form-label">Email:</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="Digite o email"
        value="{{ old('email', $usuario->user->email ?? '') }}">
</div>

<div class="col-md-3">
    <label for="papel" class="form-label">Papel</label>
    <select name="papel" id="papel" class="form-select">
        @foreach ( $papeis as $papel )
        <option value="{{$papel->id}}">{{$papel->descricao}}</option>
        @endforeach
    </select>
</div>

<div class="col-md-4">
    <label for="password" class="form-label">Senha:</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="Digite a senha"
        {{ isset($usuario) ? '' : 'required' }}>
</div>

<div class="col-md-4">
    <label for="password_confirmation" class="form-label">Confirmar Senha:</label>
    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
        placeholder="Confirme a senha" {{ isset($usuario) ? '' : 'required' }}>
</div>

<div class="col-md-3">
    <label for="setor_id" class="form-label">Setor:</label>
    <select name="setor_id" id="setor_id" class="form-select" required>
        <option value="">Selecione um setor</option>
        @foreach ($setores as $setor)
            <option value="{{ $setor->id }}"
                {{ old('setor_id', $usuario->setor_id ?? '') == $setor->id ? 'selected' : '' }}>
                {{ $setor->nome }}
            </option>
        @endforeach
    </select>
</div>



<div class="col-md-5">
    <label for="imagem" class="form-label">Foto de Perfil:</label>
    <input type="file" name="imagem" id="imagem" class="form-control" accept="image/*" style="background-color:#a4a4a4;">
</div>

<div class="mb-4">
    <label for="name" class="block text-gray-700">Nome</label>
    <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" required class="w-full p-2 border rounded">
</div>

<div class="mb-4">
    <label for="email" class="block text-gray-700">Email</label>
    <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" required class="w-full p-2 border rounded">
</div>

<div class="mb-4">
    <label for="password" class="block text-gray-700">Senha</label>
    <input type="password" name="password" id="password" class="w-full p-2 border rounded">
    @if(isset($user))
        <small class="text-gray-600">Deixe em branco se não quiser alterar a senha</small>
    @endif
</div>

<div class="mb-4">
    <label for="group_id" class="block text-gray-700">Grupo</label>
    <select name="group_id" id="group_id" class="w-full p-2 border rounded" required>
        <option value="">Selecione um grupo</option>
        @foreach($groups as $group)
            <option value="{{ $group->id }}" {{ (old('group_id', $user->group_id ?? '') == $group->id) ? 'selected' : '' }}>
                {{ $group->name }}
            </option>
        @endforeach
    </select>
</div>

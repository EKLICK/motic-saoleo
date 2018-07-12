<div class="row">
    <div class="input-field col s12 m12 l4">
        <select name="tipo" drequired>
            <option value="" disabled selected>Filtrar por...</option>
            <option value="id">ID</option>
            <option value="tipo">Tipo</option>
            <option value="objeto">Objeto</option>
            <option value="user">Usuário responsável</option>
        </select>
        <label>Filtros</label>
    </div>

    <div class="input-field col s10 m11 l7">
        <input id="search" type="search" name="search" required>
        <label for="search">Pesquise no sistema...</label>
    </div>
    {{csrf_field()}}
    <div class="input-field col s1 m1 l1">
        <button type="submit" class="btn-floating"><i class="material-icons">search</i></button>
    </div>
</div>
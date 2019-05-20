<form method="GET" action="{{ route('noticias.index') }}" class="form-group row">
	<div class="col-12 busca">
		<input type="text" class="form-control col-10" placeholder="Digite sua busca" name="pesquisa" value="{{ request('pesquisa') }}" />
		<button class="btn btn-primary col-2">Buscar</button>
	</div>
</form>

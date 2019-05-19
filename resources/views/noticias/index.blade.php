@extends("layouts.noticias")
@section("content")
@if(empty($noticias->noticias))
<div class="container">
	<h1>
		Nenhuma notícia foi encontrada
@if(request()->has("pesquisa"))
		com o termo <em>"{{ request("pesquisa") }}"</em>
@endif
@if(request()->has("pagina"))
		na página {{ request("pagina") }}
@endif
	</h1>
</div>
@else
@foreach($noticias->noticias as $noticia)
<article class="box-noticia"><!--Notícia-->
	<a href="{{ $noticia->url }}" target="_blank">
		<figure>
			<img src="{{ $noticia->imagem }}" alt="{{ $noticia->titulo }} - {{ $noticia->categoria }}">
		</figure>
		<div class="texto-lista-noticias">
			<span class="data-lista-noticia">{{ $noticia->data_formatada }}</span>
			<h1>{{ $noticia->titulo }}</h1>
			<p>{!! $noticia->texto !!} ...</p>
		</div>
	</a>
</article><!--Fim Notícia-->
<hr />
@endforeach
@if($noticias->paginas > 1)
<ul class="pagination">
	<li class="page-item">
@if(request("pagina", 1) == 1)
		<a class="page-link" href="javascript:void(0);" aria-label="Anterior">
@else
		<a class="page-link" href="{{ route('noticias.index', ['pesquisa' => request('pesquisa'), 'pagina' => request('pagina', 1)-1]) }}" aria-label="Anterior">
@endif
			<span aria-hidden="true">&laquo;</span>
			<span class="sr-only">Anterior</span>
		</a>
	</li>
@for($i = 1; $i <= $noticias->paginas; $i++)
@if(request("pagina", 1) == $i)
	<li class="page-item active"><a class="page-link" href="javascript:void(0);">{{ $i }}</a></li>
@else
	<li class="page-item"><a class="page-link" href="{{ route('noticias.index', ['pesquisa' => request('pesquisa'), 'pagina' => $i]) }}">{{ $i }}</a></li>
@endif
@endfor
	<li class="page-item">
@if(request("pagina", 1) == $noticias->paginas)
		<a class="page-link" href="javascript:void(0);" aria-label="Próxima">
@else
		<a class="page-link" href="{{ route('noticias.index', ['pesquisa' => request('pesquisa'), 'pagina' => request('pagina', 1)+1]) }}" aria-label="Próxima">
@endif
			<span aria-hidden="true">&raquo;</span>
			<span class="sr-only">Próxima</span>
		</a>
	</li>
</ul>
<!--Fim Paginação-->
@endif
@endif
@endsection

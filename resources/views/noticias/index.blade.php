@extends("layouts.noticias")
@section("content")
@foreach($noticias as $noticia)
<article class="box-noticia"><!--Notícia-->
	<a href="{{ $noticia->url }}">
		<figure>
			<img src="{{ $noticia->imagem }}" alt="{{ $noticia->titulo }} - {{ $noticia->categoria }}">
		</figure>
		<div class="texto-lista-noticias">
			<span class="data-lista-noticia">{{ $noticia->data_formatada }}</span>
			<h1>{{ $noticia->titulo }}</h1>
			<p>{!! trim(substr(strip_tags(trim($noticia->texto)), 0, 300)) !!} ...</p>
		</div>
	</a>
</article><!--Fim Notícia-->
<hr />
@endforeach
@endsection

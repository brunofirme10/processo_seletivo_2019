<?php

namespace App\Http\Controllers;

use \Curl;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{

	const TEXTO_MAXIMO = 300; // quantidade de caracteres máxima do texto setado no desafio
	const NOTICIAS_POR_PAGINA = 15; // quantidade de notícias por página setado no desafio

	public function index()
	{
		$noticias = $this->get();
		return view("noticias.index", compact("noticias"));
	}

	/**
	 * Responsável por consumir o webservice do marcha.cnm.org.br
	 */
	protected function get()
	{
		$get = Curl::to($this->getUrl())->asJson()->get();
		if(empty($get->noticias)) { // retorna array vazia caso não tenha notícias
			return $this->retorno([], 0);
		}
		$noticias = $get->noticias;
		foreach($noticias as $k => $noticia) {
			$get->noticias[$k]->data_formatada = $this->formatarData($noticia->data_formatada);
			$get->noticias[$k]->imagem = $this->removerEscapados($noticia->imagem); // arrumar erro da imagem da notícia ID 72
			$get->noticias[$k]->texto = $this->limparTexto($noticia->texto);
		}
		return $this->retorno($get->noticias, $get->total_noticias);
	}

	/**
	 * Padroniza o retorno para a view noticias.index
	 */
	protected function retorno(array $array, int $paginas)
	{
		return (object) [
			"paginas" => ceil($paginas / self::NOTICIAS_POR_PAGINA), // arredonda o número de páginas para cima
			"noticias" => $array,
		];
	}

	/**
	 * Formata a data no padrão que veio do repo
	 */
	protected function formatarData($data)
	{
		return Carbon::createFromFormat("d/m/Y", $data)->isoFormat("dddd, LL"); // formata a data para o padrão passado no desafio
	}

	/**
	 * Limpa e padroniza o texto para a quantidade de caracteres máxima
	 */
	protected function limparTexto($texto)
	{
		$texto = $this->removerEscapados($texto);
		$texto = strip_tags($texto, "<b><i><strong><em>"); // remove as tags HTML do texto, tags permitidas: b, i, strong, em
		$texto = trim($texto); // remove espaços vazios no início e no final
		if(strlen($texto) > self::TEXTO_MAXIMO) {
			$texto = wordwrap($texto, self::TEXTO_MAXIMO); // quebra o texto usando a constante TEXTO_MAXIMO sem quebrar nenhuma palavra
			$texto = explode("\n", $texto); // explode para pegar só a primeira linha da quebra de texto
			$texto = $this->closetags($texto[0]); // fecha qualquer tag HTML que não tiver sido fechada
			$texto = trim($texto); // remove espaços vazios no início e no final
			$texto = $texto." ...";
		}
		return $texto;
	}

	/**
	 * Formata os caracteres escapados de uma string
	 */
	protected function removerEscapados($texto)
	{
		return htmlspecialchars_decode(html_entity_decode($texto)); // transforma o texto e HTML escapados em textos e caracteres normais
	}

	/**
	 * Monta a URL com os parâmetros necessários para a consulta
	 */
	protected function getUrl()
	{
		$pesquisa = request("pesquisa");
		$pagina = request("pagina");
		return "http://www.marcha.cnm.org.br/webservice/noticias?".http_build_query(["pesquisa" => $pesquisa, "page" => $pagina]);
	}

	/**
	 * Esta função é cortesia desta resposta: https://stackoverflow.com/a/3810341
	 * Serve para fechar qualquer HTML que foi aberto no texto e truncado por causa da quantidade de caracteres máxima
	 */
	protected function closetags($html) {
		preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
		$openedtags = $result[1];
		preg_match_all('#</([a-z]+)>#iU', $html, $result);
		$closedtags = $result[1];
		$len_opened = count($openedtags);
		if (count($closedtags) == $len_opened) {
			return trim($html);
		}
		$openedtags = array_reverse($openedtags);
		for ($i=0; $i < $len_opened; $i++) {
			if (!in_array($openedtags[$i], $closedtags)) {
				$html .= '</'.$openedtags[$i].'>';
			} else {
				unset($closedtags[array_search($openedtags[$i], $closedtags)]);
			}
		}
		return trim($html);
	}

}

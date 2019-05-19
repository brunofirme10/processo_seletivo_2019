<?php

namespace App\Http\Controllers;

use \Curl;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{

	public function index()
	{
		$noticias = $this->get();
		return view("noticias.index", compact("noticias"));
	}

	protected function get()
	{
		$get = Curl::to($this->getUrl())->asJson()->get();
		$noticias = $get->noticias;
		foreach($noticias as $k => $noticia) {
			$get->noticias[$k]->data_formatada = Carbon::createFromFormat("d/m/Y", $noticia->data_formatada)->isoFormat("dddd, LL");
		}
		return $get->noticias;
	}

	protected function getUrl()
	{
		$pesquisa = request("pesquisa");
		if(empty($pesquisa)) {
			return "http://www.marcha.cnm.org.br/webservice/noticias";
		} else {
			return "http://www.marcha.cnm.org.br/webservice/noticias?".http_build_query(["pesquisa" => $pesquisa]);
		}
	}

}

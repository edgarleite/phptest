<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Sintegra;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SintegraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Lista consultas salvas
        return view('consulta-lista', [
            'consultas' => Sintegra::where('idusuario', Auth::user()->id)->orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $json = $this->callSintegra($request->input('cnpj'));

        $sintegra = new Sintegra;
        $sintegra->idusuario = Auth::user()->id;
        $sintegra->cnpj = $request->input('cnpj');
        $sintegra->resultado_json = $json;
        $sintegra->save();

        echo $json;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Esclui consulta
        $consulta = Sintegra::where('idusuario', Auth::user()->id)->find($id);

        if ($consulta !== null)
            $consulta->delete();

        return redirect('consultas-salvas');
    }


    /**
     * Consulta site do Sintegra
     *
     * @param  string  $cnpj
     * @return JSON
     */
    private function callSintegra($cnpj) {
        $url = 'http://www.sintegra.es.gov.br/resultado.php';
        $html = '';

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'num_cnpj=' . $cnpj . '&num_ie=&botao=Consultar');

        $html = curl_exec($ch);

        curl_close($ch);

        preg_match_all('|<td[^*](.*)</[^>]+>|U', $html, $conteudo);

        return $this->parseJson($conteudo[0]);
    }

    /**
     * Formata para JSON
     *
     * @param  array  $result
     * @return JSON
     */
    private function parseJson($result) {
        $array = [];

        if (is_array($result)) {
            $result = array_map('strip_tags', $result);
            $result = str_replace('&nbsp;', '', $result);

            if (count($result)) {
                $array['cnpj'] = $result[2];
                $array['ie'] = $result[4];
                $array['razao'] = $result[6];
                $array['logradouro'] = $result[8];
                $array['numero'] = $result[10];
                $array['complemento'] = $result[12];
                $array['bairro'] = $result[14];
                $array['municipio'] = $result[16];
                $array['uf'] = $result[18];
                $array['cep'] = $result[20];
                $array['telefone'] = $result[22];
                $array['atividadeEconomica'] = $result[25];
                $array['dataInicio'] = $result[27];
                $array['situacao'] = $result[29];
                $array['dataAtual'] = $result[31];
                $array['regimeApuracao'] = $result[33];
                $array['emitenteNF'] = $result[40];
                $array['obrigadaNF'] = $result[42];
            }

            // Corrige caracteres
            $array = array_map('utf8_encode', $array);
        }

        return json_encode($array);
    }
}

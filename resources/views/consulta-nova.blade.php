<!-- resources/views/consulta-nova.blade.php -->

@extends('layouts.master')
@section('title', 'Nova Consulta')

@section('content')
	<h1>Consultar CNPJ</h1>
	<form type="post" id="form-consulta" onsubmit="return false;">
		{!! csrf_field() !!}
		<div class="input-group">
			<input type="text" name="cnpj" class="form-control" placeholder="Informe o CNPJ">
			<span class="input-group-btn">
				<button class="btn btn-primary btn-consultar" type="button">Consultar</button>
			</span>
		</div><!-- /input-group -->
	</form>

	<div class="alert alert-danger" style="display: none;" role="alert">Nenhum registro!</div>

	<div class="panel panel-default" style="display: none;">
        <div class="panel-body">
            <table class="table table-striped task-table">
                <thead>
                    <th colspan="2">IDENTIFICAÇÃO - PESSOA JURÍDICA</th>
                </thead>
                <tbody>
                        <tr>
                            <th class="table-text" width="50%"><div>CNPJ:</div></th>
                            <td class="table-text valor cnpj"><div></div></td>
                        </tr>
                        <tr>
                            <th class="table-text"><div>Inscrição Estadual:</div></th>
                            <td class="table-text valor ie"><div></div></td>
                        </tr>
                        <tr>
                            <th class="table-text"><div>Razão Social:</div></th>
                            <td class="table-text valor razao"><div></div></td>
                        </tr>
                        <tr>
                            <th class="table-text"><div>Logradouro:</div></th>
                            <td class="table-text valor logradouro"><div></div></td>
                        </tr>
                        <tr>
                            <th class="table-text"><div>Número:</div></th>
                            <td class="table-text valor valor numero"><div></div></td>
                        </tr>
                        <tr>
                            <th class="table-text"><div>Complemento:</div></th>
                            <td class="table-text valor complemento"><div></div></td>
                        </tr>
                        <tr>
                            <th class="table-text"><div>Bairro:</div></th>
                            <td class="table-text valor bairro"><div></div></td>
                        </tr>
                        <tr>
                            <th class="table-text"><div>Município:</div></th>
                            <td class="table-text valor municipio"><div></div></td>
                        </tr>
                        <tr>
                            <th class="table-text"><div>UF:</div></th>
                            <td class="table-text valor uf"><div></div></td>
                        </tr>
                        <tr>
                            <th class="table-text"><div>CEP:</div></th>
                            <td class="table-text valor cep"><div></div></td>
                        </tr>
                        <tr>
                            <th class="table-text"><div>Telefone:</div></th>
                            <td class="table-text valor telefone"><div></div></td>
                        </tr>
                        <tr>
                            <th class="table-text"><div>Atividade Econômica:</div></th>
                            <td class="table-text valor atividadeEconomica"><div></div></td>
                        </tr>
                        <tr>
                            <th class="table-text"><div>Data de Inicio de Atividade:</div></th>
                            <td class="table-text valor dataInicio"><div></div></td>
                        </tr>
                        <tr>
                            <th class="table-text"><div>Situação Cadastral Vigente:</div></th>
                            <td class="table-text valor situacao"><div></div></td>
                        </tr>
                        <tr>
                            <th class="table-text"><div>Data desta Situação Cadastral:</div></th>
                            <td class="table-text dataAtual"><div></div></td>
                        </tr>
                        <tr>
                            <th class="table-text"><div>Regime de Apuração: </div></th>
                            <td class="table-text regimeApuracao"><div></div></td>
                        </tr>
                        <tr>
                            <th class="table-text"><div>Emitente de NFe desde:</div></th>
                            <td class="table-text emitenteNF"><div></div></td>
                        </tr>
                        <tr>
                            <th class="table-text"><div>Obrigada a NF-e em::</div></th>
                            <td class="table-text obrigadaNF"><div></div></td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
    	$(document).ready(function() {
    		var form = $('#form-consulta');
    		var btn = $('.btn-consultar');

    		$('.btn-consultar').on('click', function() {
    			$(btn).html('Aguarde...').prop('disabled', true);
    			$('.valor div').html('');
    			$('.alert-danger').hide();
    			$('.panel-default').hide();

    			$.ajax({
					url: '/api/sintegra',
					type: 'post', 
					data: $(form).serialize(), 
					dataType: 'json', 
					success: function(data) {
						if (data.cnpj !== undefined){
							parseResult(data);
						} else {
							$('.alert-danger').show();
						}
					}, 
					complete: function() {
		    			$(btn).html('Consultar').prop('disabled', false);
					}
    			});

    		});
    	});

    	function parseResult(data) {
            $('.cnpj div').html(data.cnpj);
            $('.ie div').html(data.ie);
            $('.razao div').html(data.razao);
            $('.logradouro div').html(data.logradouro);
            $('.numero div').html(data.numero);
            $('.complemento div').html(data.complemento);
            $('.bairro div').html(data.bairro);
            $('.municipio div').html(data.municipio);
            $('.uf div').html(data.uf);
            $('.cep div').html(data.cep);
            $('.telefone div').html(data.telefone);
            $('.atividadeEconomica div').html(data.atividadeEconomica);
            $('.dataInicio div').html(data.dataInicio);
            $('.situacao div').html(data.situacao);
            $('.dataAtual div').html(data.dataAtual);
            $('.regimeApuracao div').html(data.regimeApuracao);
            $('.emitenteNF div').html(data.emitenteNF);
            $('.obrigadaNF div').html(data.obrigadaNF);

            $('.panel-default').show();
    	}
    </script>
    @parent
@stop
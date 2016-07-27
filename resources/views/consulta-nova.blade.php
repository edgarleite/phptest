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
@stop

@section('javascript')
    <script>
    	$(document).ready(function() {
    		var form = $('#form-consulta');
    		var btn = $('.btn-consultar');

    		$('.btn-consultar').on('click', function() {
    			$(btn).html('Aguarde...').prop('disabled', true);

    			$.ajax({
					url: '/api/sintegra',
					type: 'post', 
					data: $(form).serialize(), 
					dataType: 'json', 
					success: function(data) {

					}, 
					complete: function() {
		    			$(btn).html('Consultar').prop('disabled', false);
					}
    			});

    		});
    	});
    </script>
    @parent
@stop
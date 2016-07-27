<!-- resources/views/consulta-lista.blade.php -->

@extends('layouts.master')
@section('title', 'Consultas Salvas')

@section('content')
	<h1>Consultas Salvas</h1>
	<!-- Consultas atuais -->
    @if (count($consultas) > 0)
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>CNPJ</th>
                        <th>Data/Hora</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($consultas as $consulta)
                            <tr>
                                <td class="table-text"><div>{{ $consulta->cnpj }}</div></td>
                                <td class="table-text"><div>{{ date('d/m/Y H:i', strtotime($consulta->created_at)) }}</div></td>

                                <!-- Task Delete Button -->
                                <td class="text-right">
                                    <form action="{{ url('api/sintegra/'. $consulta->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@stop


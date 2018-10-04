<table class="table {{ $class }}">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Status</th>
			<th colspan="2">Ações</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Tecnologia da Informação</td>
			<td>Ativo</td>
			<td><button type="button" class="btn btn-primary btn-circle" data-toggle="modal" data-toggle="tooltip" title="Alterar" data-target="#myModal"><i class="fa fa-edit"></i></button> </td>
			<td><button type="button" class="btn btn-danger btn-circle" data-toggle="tooltip" title="Excluir"><i class="fa fa-trash-o"></i></button> </td>


		</tr>
	</tbody>
</table>
 
@include('modals.profissao')

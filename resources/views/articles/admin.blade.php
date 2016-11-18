@extends('layouts.app')

@section('content')
	<div class="container-fluid">
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Role</th>
				<th class="pull-right">Change Role</th>
			</tr>
		</thead>
		<tbody>
			@if(Session::has('status'))
				<div class="alert alert-danger"> {{ Session::get('status') }} </div>
			@endif
			@foreach($users as $user)
				@cannot('auth_idSuper', $user)
					<tr>
						<td>{{ $user['name'] }}</td>
						<td><b>{{ $user->roles->pluck('name')->first() }}</b></td>
						<td>
							@can('auth_id', $user)
								<a href="/makeUser/{{ $user->id }}"><button class="btn btn-primary pull-right">Make User</button></a>
							@else
								<a href="/makeAdmin/{{ $user->id }}"><button class="btn btn-primary pull-right">Make Admin</button></a>
							@endcan
						</td>
					</tr>
				@endcan
			@endforeach
		</tbody>
	</table>
	</div>
@stop
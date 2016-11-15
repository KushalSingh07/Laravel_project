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
			@foreach($users as $user)
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
			@endforeach
		</tbody>
	</table>
	</div>
@stop
@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<ul class="list-group">
			@foreach($users as $user)
				<li class="list-group-item">
					{{ $user['name'] }}
					<a href="/makeAdmin/{{ $user->id }}"><button class="btn btn-primary pull-right">Make Admin</button></a>
					<a href="/makeUser/{{ $user->id }}"><button class="btn btn-primary pull-right">Make User</button></a>
				</li>
			@endforeach
		</ul>
	</div>
@stop
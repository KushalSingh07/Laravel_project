@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h1>{{ $article->title }}</h1>

		<article>
			{{ $article->body }}
		</article>
		<hr>

		@can('auth_admin', $article)
			<div class="row">
				<div class="col-md-3">
					<a href="/articles/{{ $article->id }}/edit"><button class="btn btn-primary">Edit</button></a>
				</div>

				<div class="col-md-3">
					<form method="POST" action="/articles/{{ $article->id }}"> 

						<input type="hidden" name="_method" value="DELETE">

						{{ csrf_field() }}
						
						<a href="/articles/{{ $article->id }}/destroy"><button class="btn btn-danger pull-right">Delete</button></a>
						
					</form>
				</div>
			</div>			
		@endcan

		@can('auth_user', $article)
			<div class="row">
				<div class="col-md-3">
					<a href="/articles/{{ $article->id }}/edit"><button class="btn btn-primary">Edit</button></a>
				</div>

				<div class="col-md-3">
					<form method="POST" action="/articles/{{ $article->id }}"> 

						<input type="hidden" name="_method" value="DELETE">

						{{ csrf_field() }}
						
						<a href="/articles/{{ $article->id }}/destroy"><button class="btn btn-danger pull-right">Delete</button></a>
						
					</form>
				</div>
			</div>			
		@endcan

	</div>
</div>
@stop


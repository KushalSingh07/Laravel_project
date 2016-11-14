@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Articles</h1>
			@if(Session::has('status'))
				<div class="alert alert-danger"> {{ Session::get('status') }} </div>
			@endif
			<ul class="list-group"></ul>
				@foreach ($articles as $article)
					<article>
						<li class="list-group-item">
							<h2><a href="/articles/{{ $article->id }}">{{ $article->title }}</a></h2><div>By :{{ $article->user->name }}</div>
						</li>
						<li class="list-group-item">
							{{ $article->body }}
						</li>
					</article>
				@endforeach
			</div>
		</div>
	</div>
@stop
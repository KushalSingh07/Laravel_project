@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Articles</h1>
			<ul class="list-group"></ul>
				@foreach ($myarticles as $myarticle)
					<article>
						<li class="list-group-item">
							<h2><a href="/articles/{{ $myarticle->id }}">{{ $myarticle->title }}</a></h2><div>By :{{ $myarticle->user->name }}</div>
						</li>
						<li class="list-group-item">
							{{ $myarticle->body }}
						</li>
					</article>
				@endforeach
			</div>
		</div>
	</div>
@stop
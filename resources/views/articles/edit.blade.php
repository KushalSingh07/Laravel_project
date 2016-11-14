@extends('layouts.app')

@section('content')
<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Edit article</h1>
			<form method="POST" action="/articles/{{ $article->id }}"> 

				<input type="hidden" name="_method" value="Patch">

				{{ csrf_field() }}
				
				<div class="form-group">
				    <label for="title">Title:</label>
					<input type="text" name="title" class="form-control" value="{{ $article->title }}">
				</div>

				<div class="form-group">
					<label for="body">Body:</label>
					<textarea name="body" class="form-control">{{ $article->body }}</textarea>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Update Article</button>
				</div>
			</form>

			@if($errors->any())
				<ul class="alert alert-danger">
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			@endif
		</div>
	</div>
@stop
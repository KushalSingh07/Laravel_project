@extends('layouts.app')

@section('content')
<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Add new article</h1>
			<form method="POST" action="/articles"> 

				{{ csrf_field() }}

				
				<div class="form-group">
				    <label for="title">Title:</label>
					<input type="text" name="title" class="form-control">
				</div>

				<div class="form-group">
					<label for="body">Body:</label>
					<textarea name="body" class="form-control">{{ old('body') }}</textarea>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Add Article</button>
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
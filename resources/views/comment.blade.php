@extends('layouts.app')
@section('title', 'Details')
@section('content')

	
		<div id='displayForComments'>
		<b>ID</b>: {{ $dataWithComments->id }} <br>
		Issue Type: {{ $dataWithComments->issue }} <br>
		Description: {{ $dataWithComments-> description}} <br>
		Images: @foreach ($dataWithComments->images as $image)
				<a class="clickable" href="{{ Storage::url($image->image_name)}}" target='_blank'>View Image</a>
				@endforeach
		<br>
		Priority: {{ $dataWithComments->priority }} <br>
		Department: {{ $dataWithComments->department }} <br>
		Issued By: {{ $dataWithComments->issuedby }} <br>
		Status: {{ $dataWithComments->status }} <br>
		Created Date: {{ $dataWithComments->created_at }} <br>
		Updated Date: {{ $dataWithComments->updated_at }} <br><br>

		<div>
			<button id="accept_ticket" class="btn btn-primary">Accept Issue</button>
		</div>

		<br>

		<h4 class='commentsHeading'>Comments</h4>

		<div class='comments-list'>
		
		<ul>

			@foreach($dataWithComments->comments as $comment)
				
					{{ $comment->user->name }} comment:: <b>{{ $comment->content }} </b><br><br>
				
			@endforeach
		</ul>
		</div>
		<br><br>

		

		<div class="add-comment-section">

		<form action="{{ route('comment.store') }}" method='POST'>
			@csrf
		<input type='hidden' name='form_data_id' value="{{ $dataWithComments->id }}">
		<input type='hidden' name='user_id' value='{{ auth()->id() }}'>	
		<textarea name='comment' rows='8' cols='50' placeholder="Write your comment..."></textarea>
		<br><br>
		
		@auth
		<input type='submit' value='Add comment'>
		@else
		<button class="btn btn-secondary"><a href="{{ route('login') }}" class="login-button">Log in to Comment</a></button>
		@endauth		
		
		</form>

		

		</div>

		
	</div>

@endsection
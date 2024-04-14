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
		Status:
		@if ( $dataWithComments->status == 'Solved')
		<span style="color:rgb(33, 231, 33)"><b> {{ $dataWithComments->status }}  </b></span> <br>
		@elseif ( $dataWithComments->status == 'Pending')
		<span style="color:red"><b> {{ $dataWithComments->status }}  </b></span> <br>
		@elseif ( $dataWithComments->status == 'Accepted')
		<b> {{ $dataWithComments->status }}  </b>
		@endif
		

		Created Date: {{ $dataWithComments->created_at }} <br>
		Updated Date: {{ $dataWithComments->updated_at }} <br>
		Updated By: {{ $dataWithComments->updated_by }} <br><br>

		<div>
			@if ($dataWithComments->updated_by == '')
			<form action="{{ route('comment.accept', $dataWithComments->id) }}" method="POST">
				@csrf
				@method('PUT')
				<input type='hidden' name='form_data_id' value="{{ $dataWithComments->id }}">
				<input type='hidden' name='user_id' value='{{ auth()->id() }}'>	
				<button id="accept_ticket" class="btn btn-primary">Accept Issue</button>
			</form>

			@elseif ($dataWithComments->status != 'Solved' && $dataWithComments->updated_by == auth()->user()->name)
			<form action="{{ route('comment.solve', $dataWithComments->id) }}" method="POST">
				@csrf
				@method('PUT')
				<input type='hidden' name='form_data_id' value="{{ $dataWithComments->id }}">
				<input type='hidden' name='user_id' value='{{ auth()->id() }}'>
				<button id="close_ticket" class="btn btn-success">Solve Issue</button>
			</form>

			@elseif($dataWithComments->status == 'Solved')
			<p style="color:darkblue"><b>Issue has been closed</b></p>
			
			@endif
			
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
		<button class='btn btn-info'><input type='submit' value='Add comment'></button>
		@else
		<button class="btn btn-secondary"><a href="{{ route('login') }}" class="login-button">Log in to Comment</a></button>
		@endauth		
		
		</form>

		

		</div>

		
	</div>

@endsection
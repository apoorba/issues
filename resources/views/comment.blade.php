<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel='stylesheet' type='text/css' href='{{asset('css/styles.css')}}'>
        <script src="{{asset('js/issue-form.js')}}"></script>
        
    </head>

    <h1>Comment Section</h1>

    <x-header/>

    <div class="logging">
			@auth
				<h3>Welcome {{ auth()->user()->name }}</h3>
				<x-logout/>
				<br><br>
			@else
				<a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

				@if (Route::has('register'))
					<a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
				@endif
			@endauth
		</div>
		<br><br>

	<body>
		<div id='displayForComments'>
		ID: {{ $dataWithComments->id }} <br>
		Issue Type: {{ $dataWithComments->issue }} <br>
		Description: {{ $dataWithComments-> description}} <br>
		Images: @foreach ($dataWithComments->images as $image)
				<a href="{{ Storage::url($image->image_name)}}" target='_blank'>View Image</a>
				@endforeach
		<br>
		Priority: {{ $dataWithComments->priority }} <br>
		Department: {{ $dataWithComments->department }} <br>
		Issued By: {{ $dataWithComments->issuedby }} <br>
		Created Date: {{ $dataWithComments->created_at }} <br>
		Updated Date: {{ $dataWithComments->updated_at }} <br>
		</div>

		<div class='comments-list'>
		<h4>Comments</h4>
		<ul>

			@foreach($dataWithComments->comments as $comment)
				
					{{ $comment->user->name }} comment: <b>{{ $comment->content }} </b><br><br>
				
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
		<input type='submit' value='Add comment'>
		</form>
		</div>

	</body>

</html>
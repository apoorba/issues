<!DOCTYPE html>
<html>
    <h1>Report your issue</h1>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel='stylesheet' type='text/css' href='{{asset('css/styles.css')}}'>
        <script src="{{asset('js/issue-form.js')}}"></script>
        
    </head>
	
	<x-header/>

	
    <body>
		<div class="logging">
			@auth
				<h3>Welcome </h3><h3 class='user-name'>{{ auth()->user()->name }}</h3>
				<x-logout/>
				<br><br>
			@else
				<a href="{{ route('login') }}" class="login-button">Log in</a>

				@if (Route::has('register'))
					<a href="{{ route('register') }}" class="register-button">Register</a>
				@endif
			@endauth
		</div>
		<br><br>

		<div>
		<button id='showForm' onclick='showIssueForm()' class='report-your-problem'>Report your problem</button>
		<br><br>
		</div>

        <form id='report-form' action='/submit-form' method='post' enctype="multipart/form-data" onsubmit="submitFormData()">
            @csrf
            <div id="issue_type_container">
				<label for="issue"> Issue Type: </label>
				<select id="issue" name="issue">
					<option value="bug" selected>Bug</option>
					<option value="report">Report</option>
					<option value="query">Query</option>
				</select><br><br>
			</div>
			<label for="description">Description: </label>
			<textarea id="description" name="description" rows="10" cols="30" placeholder="Please describe your issue" maxlength="300"></textarea><br><br>
            
			<div id="fileInputs">
				<div class="fileRow">
				Upload Image: 
				<button type="button" onclick="addFileInput()">Add File</button><br><br>
				</div>
			</div>
			<!--<button type="button" onclick="uploadFiles()">Upload Files</button>		-->
			<br><br>

			<div id="priority_type_container">
			<label for="priority">Priority: </label>	
					<select id="priority" name="priority">
					<option value="highest">Highest</option>
					<option value="high">High</option>
					<option value="medium" selected>Medium</option>
					<option value="low">Low</option>
					<option value="lowest">Lowest</option>
					<option value="mustHave">Must Have</option>
					<option value="shouldHave">Should Have</option>
					<option value="wantToHave">Want to Have</option>
				</select>
			</div>
			<br><br>
			<label for="department">Department: </label>
			<input id="department" name="department" type="text" required>
			<br><br>
			<label for="issuedby">Issued By: </label>
			@if(auth()->check())
			<input id="issuedby" type="text" placeholder="Your username" name="issuedby" value="{{ auth()->user()->name }}" readonly>
			@else
			<input id="issuedby" type="text" placeholder="Your username" name="issuedby" required>
			@endif
			<br><br>	

            <input type="submit" value="submit">            

        </form>

		@if(session('success'))
    	<script>
        alert("{{ session('success') }}");
    	</script>
		@endif

    </body>
</html>
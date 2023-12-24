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

		<button id='showForm' onclick='showIssueForm()'>Report your problem</button>
		<br><br>

        <form id='report-form' action='/submit-form' method='post' enctype="multipart/form-data">
            @csrf
            <div id="issue_type_container">
				<label for="issue"> Issue Type: </label>
				<select id="issue" name="issueType">
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
				<input type="file" id="images[]" multiple class="fileInput" accept="image/*">
				<input type="text" id="descriptions[]" multiple placeholder="Image Description">
				
			<button type="button" onclick="addFileInput()">Add another File</button><br><br>
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
			<input id="department" name="department" type="text">
			<br><br>
			<label for="issuedby">Issued By: </label>
			<input id="issuedby" type="text" placeholder="Your username" name="issuedby">
			<br><br>	

            <input type="submit" value="Submit">            

        </form>

		<a href="/dashboard"><h1>Reports Dashboard</h1></a>

		@if(session('success'))
    	<script>
        alert("{{ session('success') }}");
    	</script>
		@endif

    </body>
</html>
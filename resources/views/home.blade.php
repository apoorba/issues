@extends('layouts.app')
@section('title', 'Report your issue')
@section('content')

<script src="{{ asset('js/issue-form.js') }}"></script>

    <div class="container">

			<form id='report-form' method='post' enctype='multipart/form-data'>
            @csrf
            <div class="labels">
              <label for='issue'>Issue Type</label></div>
            <div class="input-tab">
                <input type="radio" name="issue" value="bug" required>Bug<br>
                <input type="radio" name="issue" value="report">Report<br>
                <input type="radio" name="issue" value="query">Query<br>
            </div>

            <div class="labels">
              <label for="description">Description</label></div>
            <div class="input-tab">
              <textarea class="input-field" id="description" name="description" rows="10" cols="40" placeholder="Describe your issue..."></textarea>
            </div>

            <div class="labels">
              <label for="images">Upload Image</label>
            </div>
            <div class="btn">
				<button id="fileInputs" onclick="addFileInput()">Add Image</button>
				<div id='fileRow'>
              
				</div>	
            </div>

            <div class="labels">
              <label for="priority">Priority</label></div>
            <div class="input-tab">
              <select id="priority" name="priority">
                <option disabled value selected>Select an option</option>
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
                <option value="mustHave">Must Have</option>
                <option value="shouldHave">Should Have</option>
              </select>
              </div>


             <div class="labels">
              <label for="department">Department</label></div>
            <div class="input-tab">
              <input class="input-field" type="text" id="department" name="department" placeholder="Enter your department" required></div>
    
    
             <div class="labels">
              <label for="issuedby">Issued By</label></div>
            <div class="input-tab">
				@if(auth()->check())
			<input class="input-field" id="issuedby" type="text" placeholder="Your username" name="issuedby" value="{{ auth()->user()->name }}" readonly>
			@else
			<input class="input-field" id="issuedby" type="text" placeholder="Your username" name="issuedby" required>
			@endif
           
            <div class="btn">
              <button id="submit" type="button" onclick="submitFormData()">Submit</button>
            </div>
          </form>
      </div>
      

		@if(session('success'))
    	<script>
        alert("{{ session('success') }}");
    	</script>
		@endif

@endsection
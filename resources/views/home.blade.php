@extends('layouts.app')
@section('title', 'Report your issue')
@section('content')


<script src="{{ asset('js/issue-form.js') }}"></script>

  <h2 class='form'>Report Your Issue</h2>

    <div class="form-container">

			<form id='report-form' method='post' enctype='multipart/form-data'>
            @csrf
            <div class="labels">
              <label for='issue'><b>Issue Type</b></label></div>
            <div class="mb-3 form-check">
                <input type="radio" name="issue" value="bug" required> Bug <br>
                <input type="radio" name="issue" value="report"> Report <br>
                <input type="radio" name="issue" value="query"> Query <br>
            </div>
            <br>

            <div class="mb-3">
              <label for="description"><b>Description</b></label></div>
            <div class="input-tab">
              <textarea class="input-field" id="description" name="description" rows="10" cols="40" placeholder="Describe your issue..."></textarea>
            </div>
            <br>

            <div class="labels">
              <label for="images"><b>Upload Image</b></label>
            </div>
            <div class="btn">
				<button id="fileInputs" class="btn btn-outline-primary" type='button' onclick="addFileInput()">Add Image</button>

				<div id='fileRow'>
              
				</div>	
            </div>

            <br><br>

            <div class="labels">
              <label for="priority"><b>Priority</b></label></div>
            <div class="input-tab">
              <select id="priority" name="priority" required>
                <option disabled value selected>Select an option</option>
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
                <option value="mustHave">Must Have</option>
                <option value="shouldHave">Should Have</option>
              </select>
              </div>
              <br>

             <div class="labels">
              <label for="department"><b>Department</b></label></div>
            <div class="input-tab">
              <input class="input-field" type="text" id="department" name="department" placeholder="Enter your department" required></div>
    
              <br>

             <div class="labels">
              <label for="issuedby"><b>Issued By</b></label></div>
            <div class="input-tab">
				@if(auth()->check())
			<input class="input-field" id="issuedby" type="text" placeholder="Your username" name="issuedby" value="{{ auth()->user()->name }}" readonly>
			@else
			<input class="input-field" id="issuedby" type="text" placeholder="Your username" name="issuedby" required>
			@endif
           
      <br><br>
            <div class="btn">
              <button class="btn btn-outline-success" id="submit" type="button" onclick="submitFormData()">Submit</button>
            </div>
          </form>

      </div>
      

		@if(session('success'))
    	<script>
        alert("{{ session('success') }}");
    	</script>
		@endif

@endsection
<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel='stylesheet' type='text/css' href='{{asset('css/styles.css')}}'>
        <script src="{{asset('js/issue-form.js')}}"></script>
        
    </head>
    <title>Reports</title>
    <h1>Reports Dashboard</h1>

    <x-header/>
    <br><br>
    
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
    <div id="searchContainer">
        <form id="search-table" method="POST">
            @csrf
            <input type="text" id='table-search' placeholder="Search..." name="searchTable">
            <button type="submit">Search</button>
        </form>
    </div>

    <div id="searchResult"></div>
    <br><br>
    
    <div id="table-container">
        <table id="reports" border=1>
            <thead>
                <tr>
                    <th onclick="sortTable(0)">SN</th>
                    <th onclick='sortTable(1)'>Issue</th>
                    <th onclick='sortTable(2)'>Description</th>
                    <th>Images</th>
                    <th onclick='sortTable(3)'>Priority</th>
                    <th onclick='sortTable(4)'>Department</th>
                    <th onclick='sortTable(5)'>Issued by</th>
                    <th onclick='sortTable(6)'>Created at</th>
                    <th onclick='sortTable(7)'>Updated at</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->issue }}</td>
                    <td>{{ $item->description }}</td>
                    <td> 
                        @foreach ($item->images as $image)
                        <img src="{{ Storage::url($image->image_name)}}" alt="Image">
                        @endforeach
                    </td>
                    <td>{{ $item->priority }}</td>
                    <td>{{ $item->department }}</td>
                    <td>{{ $item->issuedby }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td><a href='{{ route('comment', $item->id) }}'>View Comments</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $data->links() }}

    <script>
        var sortOrder ={};
    </script>
    </body>
</html>
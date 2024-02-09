@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<script src="{{ asset('js/issue-form.js') }}"></script>

    <div id="searchContainer">
        <form id="search-table" method="POST">
            @csrf
            <label for='table-search'>Search</label>
            <input type="text" id='table-search' placeholder="Search..." name="searchTable" oninput="searchTableFunction()">
        </form>
    </div>

    <br><br>
    <div id="searchResultTable" style='display:none'></div>

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
                    <th>Status</th>
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
                        <a href="{{ Storage::url($image->image_name)}}" target='_blank'>{{ $image->description }}</a>
                        @endforeach
                    </td>
                    <td>{{ $item->priority }}</td>
                    <td>{{ $item->department }}</td>
                    <td>{{ $item->issuedby }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td><a href='{{ route('comment', $item->id) }}'>View Details</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br><br>

    <div class="pagination">
    {{ $data->links() }}
    </div>

    <script>
        var sortOrder ={};
    </script>

@endsection



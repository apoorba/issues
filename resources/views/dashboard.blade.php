@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" crossorigin="anonymous">

    <div class="container mt-5">
        <table id="reports" border=1>
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Issue</th>
                    <th>Description</th>
                    <th>Images</th>
                    <th>Priority</th>
                    <th>Department</th>
                    <th>Issued by</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Details</th>
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
                        <a class="clickable" href="{{ Storage::url($image->image_name)}}" target='_blank'>{{ $image->description }}</a>
                        @endforeach
                    </td>
                    <td>{{ $item->priority }}</td>
                    <td>{{ $item->department }}</td>
                    <td>{{ $item->issuedby }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td><a  class="clickable" href='{{ route('comment', $item->id) }}'>View Details</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br><br>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    
    <script>
        $(document).ready( function () {
        $('#reports').DataTable();
    } );
    </script>

@endsection



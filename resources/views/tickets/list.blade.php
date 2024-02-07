{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}

<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

{{-- https://unpkg.com/browse/tailwindcss@2.0.1/dist/tailwind.min.css --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Tickets
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    List of tickets
                    
                    <a href="{{ route('tickets.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 float-right">Create Ticket</a>
                    
                </div>
                <div class="p-6 text-gray-900">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Ticket Title</th>
                                <th>Ticket Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $value)
                            <tr>
                                <td>{{$value->id}}</td>
                                <td>{{$value->ticket_title}}</td>
                                <td>{{$value->ticket_number}}</td>
                                <td class="flex flex-grid">
                                    <a href="{{route('tickets.edit', ['ticket' => $value->id])}}" class="edit_ticket btn btn-primary mx-2" data-id="{{$value->id}}">Edit Ticket</a>
                                    {{-- <a href="{{ route('tickets.destroy', ['ticket' => $value->id]) }}" class="delete_ticket" data-id="{{$value->id}}">Delete Ticket</a> --}}
                                    
                                    <form action="{{ route('tickets.destroy', $value->id) }}" method="post" class="">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete Ticket</button>
                                    </form>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('.data-table').DataTable();                
        });
    </script>
    
</x-app-layout>



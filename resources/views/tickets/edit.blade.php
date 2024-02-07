<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Update Ticket
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session()->has('message'))
                    <p class="text-red">
                        {{ session()->get('message') }}
                    </p>
                    @endif
                    {{-- @dd($ticket) --}}
                    <form action="{{ route('tickets.update',  $ticket) }}" method="post" class="max-w-sm mx-auto" enctype="multipart/form-data">
                        @csrf
                        @method('PUT');
                        <div class="mb-5">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ticket Title</label>
                            <input type="text" name="ticket_title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ticket title" value="{{$ticket->ticket_title}}" disabled>
                            @if($errors->has('ticket_title'))
                            <div class="text-red-400">{{ $errors->first('ticket_title') }}</div>
                            @endif
                        </div>
                        
                        <div class="mb-5">
                            <label for="ticket_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ticket Status</label>
                            
                            <div class="flex items-center mb-4">
                                <input id="pending" type="radio" name="ticket_status" value="pending" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" {{ $ticket->status == 'pending' ? 'checked' : '' }}>
                                <label for="pending" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Pending
                                </label>
                            </div>
                            
                            <div class="flex items-center mb-4">
                                <input id="in-progress" type="radio" name="ticket_status" value="in-progress" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" {{ $ticket->status == 'in-progress' ? 'checked' : '' }}>
                                <label for="in-progress" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    In Progress
                                </label>
                            </div>
                            
                            <div class="flex items-center mb-4">
                                <input id="close" type="radio" name="ticket_status" value="close" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" {{ $ticket->status == 'close' ? 'checked' : '' }}>
                                <label for="close" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Close
                                </label>
                            </div>
                            @if($errors->has('ticket_status'))
                            <div class="text-red-400	">{{ $errors->first('ticket_status') }}</div>
                            @endif
                        </div>
                        
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="ticket_image">Upload file</label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="ticket_image" type="file" name="ticket_image">
                            @if($errors->has('ticket_image'))
                            <div class="text-red-400	">{{ $errors->first('ticket_image') }}</div>
                            @endif
                        </div>
                        
                        
                        <div class="mb-5">
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your message</label>
                            <textarea id="message" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here...">{{$ticket->description}}</textarea>
                        </div>
                        
                        
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

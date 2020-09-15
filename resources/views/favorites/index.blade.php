<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Favorites') }}
        </h2>
    </x-slot> 

	<div class="py-12">
	    <div id="messages"></div>
	    <table class="table table-bordered table-hover">
	        
	        @if(empty($repositories))
	            </table>
	            <div>No favorite repositories.</div>
	            
	        @else
	        	<thead>
		            <th>Name</th>
		            <th>Author</th>
		            <th>Description</th>
		            <th>Stars</th>
		            <th>Actions</th>
		        </thead>
		        <tbody>
	            @foreach ($repositories as $repository)
		            <tr>
		                <td><a href="{{ $repository->html_url }}">{{ $repository->name }}</a></td>
		                <td>{{ $repository->owner }}</td>
		                <td>{{ $repository->description }} </td>
		                <td>{{ $repository->stars }}</td>
		                <td>
		                     <form id="favs" style="display:inline-block" action="{{ url('favorites/destroy') }}" method="POST"  >
		                    
			                    @csrf
			                    <input hidden type="text" name="name" value="{{ $repository->name }}"  />
			                    <input hidden type="text" name="user_id" value="{{  auth()->user()->id }}"  />

			                    <button class="btn btn-sm btn-danger" type="button" id="submitForm">Delete from favorites</button> 

		                    </form>
		                </td>
		            </tr>
	            @endforeach
	        	</tbody>

	        @endif
	    </table>
	    {{ $repositories->links() }}
	</div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="input-group mb-3">
            <form class="form-inline" method="GET">
                <input type="text" class="form-control"  id="filter" name="filter" placeholder="Repositories data" aria-label="Repositories data" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-secondary" type="button">Search</button>
                </div>
            </form>
        </div> 
        <div id="messages"></div>

        <table class="table table-bordered table-hover">
            
            @if(empty($repos))
                <tr>
                    <td colspan="5">No search query.</td>
                </tr>
            @elseif($repos["total_count"] == 0)
                <tr>
                    <td colspan="5">No repositories to display.</td>
                </tr>
            @else

                <thead>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Description</th>
                    <th>Stars</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                @foreach ($repos["items"] as $repo)
                <tr>
                    <td><a href="{{ $repo['html_url'] }}">{{ $repo["full_name"] }}</a></td>
                    <td>{{ $repo["owner"]["login"] }}</td>
                    <td>{{ $repo["description"] }} </td>
                    <td>{{ $repo["stargazers_count"] }}</td>
                    <td>
                         <form id="favs" style="display:inline-block" action="{{ url('favorites/store') }}" method="POST"  >
                        
                        @csrf
                        <input hidden type="text" name="name" value="{{ $repo['full_name'] }}"  />
                        <input hidden type="text" name="html_url" value="{{ $repo['html_url'] }}"  />
                        <input hidden type="text" name="owner" value="{{  $repo['owner']['login'] }}"  />
                        <input hidden type="text" name="description" value="{{ $repo['description'] }}"  />
                        <input hidden type="text" name="stars" value="{{ $repo['stargazers_count'] }}"  />
                        <input hidden type="text" name="user_id" value="{{  auth()->user()->id }}"  />
                        <!-- <input type="submit" class="btn btn-elegant" value="Add to favs" > -->
                        <button class="btn btn-sm btn-danger" type="button" id="submitForm">Add to favorites</button> 


                        </form>
                    </td>
                </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</x-app-layout>

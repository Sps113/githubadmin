<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <form class="form-inline" method="GET">
            <div class="form-group mb-2">
                <label for="filter" class="col-sm-2 col-form-label">Filter</label>
                <input type="text" class="form-control" id="filter" name="filter" placeholder="Product name..." value="">
                <button type="submit" class="btn btn-default mb-2">Filter</button>
            </div>
          
        </form>
        <table class="table table-bordered table-hover">
            <thead>
                <th>Name</th>
                <th>Author</th>
                <th>Description</th>
                <th>Stars</th>
                <th>Actions</th>
            </thead>
            <tbody>
            @if(empty($repos))
                <tr>
                    <td colspan="5">No search query.</td>
                </tr>
            @elseif($repos["total_count"] == 0)
                <tr>
                    <td colspan="5">No repositories to display.</td>
                </tr>
            @else
            <!-- {{ var_dump($repos) }} -->
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
                        <input hidden type="text" name="stargazers_count" value="{{ $repo['stargazers_count'] }}"  />
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
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function(){
                $('button#submitForm').on('click', function(e){
                    e.preventDefault();
                    var $this = $(this);
                    console.log( $($this[0].parentElement).attr('action'));
                    $.ajax({
                        url: $($this[0].parentElement).attr('action'),
                        method: 'POST',
                        data: $($this[0].parentElement).serialize(),
                    }).done(function(response){
                        console.log(response)
                    }).fail(function(err){

                    });
                });
            });
        </script>
    </div>
</x-app-layout>

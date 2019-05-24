@extends('layouts.admin')

@section('content')

<div class="container">
  <h2>All Users</h2>
  <p><form action="">
		<input type="text" name="search" value="{{$search ? $search : ''}}" placehold="Search">
		<button type="submit">
		 Search	
		</button>
	</form></p>            
  <table class="table table-striped">
    <thead>
      <tr>
        <th>@sortablelink('name', 'Name')</th>
        <th>@sortablelink('email')</th>
        <th>@sortablelink('active')</th>
        <th>@sortablelink('verified')</th>
        <th>@sortablelink('created_at')</th>
      </tr>
    </thead>
    <tbody>
	  @foreach($users as $user)	
		  <tr>
			<td>{{$user->name}}</td>
			<td>{{$user->email}}</td>
			<td>{{$user->active? 'Yes' : 'NO'}}</td>
			<td>{{$user->verified? 'Yes' : 'NO'}}</td>
			<td>{{$user->created_at}}</td>
		  </tr>
		@endforeach
    </tbody>
  </table>
	  {!! $users->appends(request()->except('page'))->render() !!}
		<!-- {{ $users->links() }} -->
</div>
@endsection
@extends('layouts.admin') 
@section('content')
	<div class="container">
		

	<h1>
		User Detail
	</h1>
	<a href="{{route('admin.users')}}" ><span class="d-block p-2 bg-primary text-white">back</span></a>

	<div class="row">
		<div class="col-sm-12">
			Name: {{$user->name}}
		</div>
		<div class="col-sm-12">
			Email: {{$user->email}}
		</div>
		<div class="col-sm-12">
			Address: {{$user->created_at}}
		</div>
		@if(!$user->verified)
			<div class="col-sm-12">
				<a href="{{route('admin.user_approve', $user->id)}}" class="btn primary">Approve</a>
			</div>
		@endif
		
	</div>
</div>
@endsection
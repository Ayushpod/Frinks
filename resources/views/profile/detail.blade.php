@extends('layouts.app') @section('content')
<main role="main">
<div class="album py-5 bg-light">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-12">
					<div class="card mb-4 shadow-sm">
						<img src="<?= asset("storage/profile/$user->profile_picture") ?>" width="100%" height="400" class="card-img-top"/>
						<div class="card-body">
							<p class="card-text">{{$user->name}}</p>
							<p class="card-text">{{$user->email}}</p>
							<p class="card-text">{{$user->address_1}}</p>
							<p class="card-text">{{$user->skills}}</p>
							<p class="card-text">{{$user->job_looking_for}}</p>
							<a href="<?= asset("storage/resume/$user->resume") ?>" download="{{$user->resume}}">Download CV</a>
							<p class="card-text">{{$user->summary}}</p>
							<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
							<div class="d-flex justify-content-between align-items-center">
							
								<small class="text-muted">{{$user->city }}</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection
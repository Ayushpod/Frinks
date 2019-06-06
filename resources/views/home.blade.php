@extends('layouts.app') @section('content')
<main role="main">
	
	<!-- <section class="jumbotron text-center">
		<div class="container">
			<h1 class="jumbotron-heading">Album example</h1>
			<p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
			<p>
				<a href="#" class="btn btn-primary my-2">Main call to action</a>
				<a href="#" class="btn btn-secondary my-2">Secondary action</a>
			</p>
		</div>
	</section> -->

	<div class="album py-5 bg-light">
		<div class="container">
			<div class="row">
				@foreach ($users as $user)
				<div class="col-md-4 col-sm-12">
					<div class="card mb-4 shadow-sm">
						<img src="<?= asset("storage/profile/$user->profile_picture") ?>" width="100%" height="225" class="card-img-top"/>
						<div class="card-body">
							<p>
							<a class="float-left" href="#"><strong>{{$user->name}}</strong></a>
								<span class="float-right"><i class="text-warning fa fa-star"></i></span>
								<span class="float-right"><i class="text-warning fa fa-star"></i></span>
								<span class="float-right"><i class="text-warning fa fa-star"></i></span>
								<span class="float-right"><i class="text-warning fa fa-star"></i></span>

        	      			 </p>
							<p class="card-text"></p>
							<p class="card-text">{{$user->skills}}</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<a href="{{route('user.detail', $user->id)}}" class="btn btn-sm btn-outline-secondary">View</a>
								</div>
								<small class="text-muted">{{$user->city }}</small>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>

</main>

@endsection
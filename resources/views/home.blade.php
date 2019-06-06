@extends('layouts.app') @section('content')
<main role="main">
	
	<section class="jumbotron text-center">
		<div class="container">
			<h1 class="jumbotron-heading">Album example</h1>
			<p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
			<p>
				<a href="#" class="btn btn-primary my-2">Main call to action</a>
				<a href="#" class="btn btn-secondary my-2">Secondary action</a>
			</p>
		</div>
	</section>

	<div class="album py-5 bg-light">
		<div class="container">
			<div class="row">
				@foreach ($users as $user)
				<div class="col-md-4 col-sm-12">
					<div class="card mb-4 shadow-sm">
						<img src="<?= asset("storage/profile/$user->profile_picture") ?>" width="100%" height="225" class="card-img-top"/>
						<div class="card-body">
							<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<button type="button" class="btn btn-sm btn-outline-secondary">View</button>
									<button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
								</div>
								<small class="text-muted">9 mins</small>
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
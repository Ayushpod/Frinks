@extends('layouts.app') @section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">List</div>

				<div class="card-body">
					@if (session('status'))
					<div class="alert alert-success" role="alert">
						{{ session('status') }}
					</div>
					@endif
					<div id="accordion">
						@foreach($users as $user)
						<div class="card custom-card">
							<div class="card-header" id="headingOne-{{$user->id}}">
								<div class="row p-3">
									<div class="col-4 img-center">
										<img src="<?= asset("storage/profile/thumbnail/$user->profile_pic_thumbnail") ?>" class="rounded-circle"/>
									</div>
									<div class="col-4">
										<ul>
											<li>{{$user->name}}</li>
											<li>{{$user->address_1}}, {{$user->city}}</li>
										</ul>
									</div>
									<div class="col-4">
										<h5 class="mb-0">
									<button class="btn btn-link float-right" data-toggle="collapse" data-target="#collapseOne-{{$user->id}}" aria-expanded="true" aria-controls="collapseOne"> show more..
									</button>
								</h5>
									</div>
								</div>
								
								
								
							</div>

							<div id="collapseOne-{{$user->id}}" class="collapse " aria-labelledby="headingOne-{{$user->id}}" data-parent="#accordion">
								<div class="card-body">
									Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
									on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
									raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
								</div>
							</div>
						</div>
						@endforeach
						<!-- <div class="card">
							<div class="card-header" id="headingTwo">
								<h5 class="mb-0">
									<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
										Collapsible Group Item #2
									</button>
								</h5>
							</div>
							<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="card-body">
									Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
									on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
									raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingThree">
								<h5 class="mb-0">
									<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
										Collapsible Group Item #3
									</button>
								</h5>
							</div>
							<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
								<div class="card-body">
									Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
									on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
									raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
								</div>
							</div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
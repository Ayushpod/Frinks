@extends('layouts.app') @section('content')
<div class="album py-5 bg-light">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-12">
					
					<div class="card mb-4 shadow-sm">
						<img src="<?= asset("storage/profile/$user->profile_picture") ?>" width="100%" height="400" class="card-img-top"/>
						<div class="card-body">
							<p class="text-right"><a href='#' class="link" data-toggle="modal" data-target="#sendEmailModal" >Send Email</a></p>
							<p class="card-text">{{$user->name}}</p>
							<p class="card-text">{{$user->email}}</p>
							<p class="card-text">{{$user->address_1}}</p>
							<p class="card-text">{{$user->skills}}</p>
							<p class="card-text">{{$user->job_looking_for}}</p>
							@if ($user->resume)
							<a href="<?= asset("storage/resume/$user->resume") ?>" download="{{$user->resume}}">Download CV</a>
							@else 
							<p>
								No CV uploaded
							</p>
							@endif
							<p class="card-text">{{$user->summary}}</p>
							<div class="d-flex justify-content-between align-items-center">
							
								<small class="text-muted">{{$user->city }}</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
				<div class="modal fade" id="sendEmailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Send Email</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="{{route('user.send.email')}}" method="post" enctype="multipart/form-data">
									@csrf
									<input type="hidden" name="id" value={{$user->id}} />
								 	<div class="form-group">
										<label for="from_email">Email address</label>
    <input type="email" class="form-control" name="email" id="from_email" aria-describedby="emailHelp" placeholder="Enter your email">
								  	</div>
									<div class="form-group">
										<label for="from_emails">Message</label>
										<div class="col-md-8">
										<textarea rows="3" name="message"></textarea>
										</div>
								  	</div>
									<button type="submit" class="btn btn-primary">Send</button>
								</form>
							</div>
						</div>
					</div>
				</div>
	@endsection
@extends('layouts.app') @section('content')

<div class="container">
	<h1>Edit Profile</h1>
	<hr>
	<div class="row">
		<!-- left column -->
		<div class="col-md-3">
			<div class="text-center">
				{{$user->profile_picture}}
				<img src="{{asset('storage/profile/thumbnail/10_Screenshot from 2019-05-29 17-17-39.png')}}" class="rounded-circle" alt="avatar">

				<!-- <a href="">
					<h6>Upload a different photo...</h6>
				</a> -->
				<!-- Button trigger modal -->
				<a  href="#" class="link" data-toggle="modal" data-target="#profilePicModal">
					<h6>Upload a different photo...</h6>
				</a>
				@error('profile_pic')
    				<div class="alert alert-danger">{{ $message }}</div>
				@enderror

				<!-- Modal -->
				<div class="modal fade" id="profilePicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Profile</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="{{route('user.profile.pic')}}" method="post" enctype="multipart/form-data">
									@csrf
								 	<div class="form-group">
										<input type="file" class="form-control-file" id="profile_pic" name="profile_pic" >
								  	</div>
									<button type="submit" class="btn btn-primary">Submit</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- edit form column -->
		<div class="col-md-9 personal-info">
			<div class="alert alert-info alert-dismissable">
				<a class="panel-close close" data-dismiss="alert">×</a>
				<i class="fa fa-coffee"></i>
				This is an
				<strong>.alert</strong>. Use this to show important messages to the user.
			</div>
			<form class="form-horizontal" role="form" action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label class="col-lg-3 control-label">Name:</label>
					<div class="col-lg-8">
						<input class="form-control" type="text" name="name" value="{{$user->name}}">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">Email:</label>
					<div class="col-lg-8">
						<input class="form-control" type="text" name="email" value="{{$user->email}}">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">Contact Number:</label>
					<div class="col-lg-8">
						<input class="form-control" type="text" name="contact_number" value="{{$user->contact_number}}">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Address 1:</label>
					<div class="col-md-8">
						<input class="form-control" type="text" name="address_1" value="{{$user->address_1}}">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Address 2:</label>
					<div class="col-md-8">
						<input class="form-control" type="text" name="address_2" value="{{$user->address_2}}">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">City</label>
					<div class="col-md-8">
						<input class="form-control" type="text" name="city" value="{{$user->city}}">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Zip Code</label>
					<div class="col-md-8">
						<input class="form-control" type="text" name="zip_code" value="{{$user->zip_code}}">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Country</label>
					<div class="col-md-8">
						<input class="form-control" type="text" name="country" value="{{$user->country}}">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Skills</label>
					<div class="col-md-8">
						<textarea class="form-control" id="skills" rows="3" name="skills">{{$user->skills}}</textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Job Looking For</label>
					<div class="col-md-8">
						<input class="form-control" type="text" name="job_looking_for" value="{{$user->job_looking_for}}">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Summary</label>
					<div class="col-md-8">
						<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="summary">{{$user->summary}}</textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="resume">Upload CV</label>
					<input type="file" class="form-control-file" id="upload_cv" name="resume">
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label"></label>
					<div class="col-md-8">
						<input type="submit" class="btn btn-primary" value="Save Changes">
						<span></span>
						<input type="reset" class="btn btn-default" value="Cancel">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
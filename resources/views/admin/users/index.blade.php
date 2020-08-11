@extends('layouts.admin')
@section('title', __('lang.users'))

@section('content')

	<br>
	@if($errors->all())
		<div class="container-fluid">
			<div class="alert alert-danger" role="alert">
				@foreach ($errors->all() as $error)
					{{ $error }} <br>
				@endforeach
			</div>
		</div>
		<br>
	@endif

	<div class="container-fluid delete-alert">
		<div class="alert alert-danger" role="alert">
			<strong>@lang('lang.success')! </strong>@lang('lang.User_successfully_deleted').
		</div>
		<br>

	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header align-items-center d-flex">
						<h1 class="header-title">@lang('lang.users')</h1>
						<div class="ml-auto text-right">
							<a href="#!" class="btn btn-danger delete_btn user">
								@lang('lang.delete')
							</a>
							<a href="#!" data-toggle="modal" data-target="#add-modal" class="btn btn-primary ">
								@lang('lang.add_user')
							</a>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table card-table">
								<thead>
								<tr>
									<th class="sl_box">
										<button id="select_all">
											<i class="fe fe-square"></i>
										</button>
									</th>
									<th>@lang('lang.name')</th>
									<th>@lang('lang.email')</th>
									<th>@lang('lang.role')</th>
									<th>@lang('lang.avatar')</th>
									<th>@lang('lang.action')</th>
								</tr>
								</thead>
								<tbody class="list">
								@foreach($users as $item)
									<tr id="{{$item->id}}">
										<td class="sl_box"></td>
										<td>{{$item->name}}</td>
										<td>{{$item->email}}</td>
										<td>
											@if($item->role == 1)
												<div class="badge badge-success">Admin</div>
												@else
												<div class="badge badge-primary">User</div>
											@endif
										</td>
										<td>
											@if (file_exists('assets/img/'.$item->avatar) && !empty($item->avatar))
												<img src="{{asset('assets/img')}}/{{$item->avatar}}" alt="{{$item->name}}">
											@else
												<img height="25" src="{{asset('assets/img')}}/default-avatar.png" alt="{{$item->name}}">
											@endif
										</td>

										<td>
											<button data-id="{{$item->id}}" id="edit_user" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit"><i class="fe fe-edit"></i></button>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" tabindex="-1" role="dialog" id="add-modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="{{url('admin/users')}}" method="post">
					{{csrf_field()}}
					<div class="modal-header">
						<h3 class="modal-title">@lang('lang.add_user')</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body exchanges_data">
						<div class="form-group">
							<label for="name">@lang('lang.name')*</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ old('name') }}" autocomplete="name" required>
						</div>
						<div class="form-group">
							<label for="email">@lang('lang.email_address')*</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}" required>
						</div>
						<div class="form-group">
							<label for="password">@lang('lang.password')*</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password" required>
						</div>
						<div class="form-group">
							<label for="password-confirm">@lang('lang.confirm_password')*</label>
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Re-Type Password" required>
						</div>
						<div class="form-group">
							<div class="custom-control custom-switch">
								<input type="checkbox" name="role" class="custom-control-input" id="customSwitch1">
								<label class="custom-control-label" for="customSwitch1">@lang('lang.turn_on_to_make_this_admin')</label>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('lang.close')</button>
						<button type="submit" class="btn btn-primary">@lang('lang.submit')</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal"></div>
	<div class="modal fade" id="delete-modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">@lang('lang.delete')</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>
						@lang('lang.delete_confirmation')?
					</p>
				</div>
				<div class="modal-footer ">
					<button class="btn btn-secondary" data-dismiss="modal">@lang('lang.cancel')</button>
					<button class="btn btn-primary btn-yes-user">@lang('lang.delete')</button>
				</div>
			</div>
		</div>
	</div>
@endsection


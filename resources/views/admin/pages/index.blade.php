@extends('layouts.admin')
@section('title', __('lang.pages'))

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

	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header align-items-center d-flex">
						<h1 class="header-title">@lang('lang.pages')</h1>
						<div class="ml-auto text-right">
							<a href="#!" class="btn btn-danger delete_btn page d_none">
								@lang('lang.delete')
							</a>
							<a href="{{url('admin/pages/create')}}" class="btn btn-primary ">
								@lang('lang.add_new')
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
									<th>@lang('lang.title')</th>
									<th>@lang('lang.slug')</th>
									<th>@lang('lang.image')</th>
									<th>@lang('lang.placement')</th>
									<th>@lang('lang.action')</th>
								</tr>
								</thead>
								<tbody class="list">
								@foreach($pages as $item)
									<tr id="{{$item->id}}">
										<td class="sl_box"></td>
										<td>{{$item->title}}</td>
										<td>{{$item->slug}}</td>
										<td>
											@if (file_exists('uploads/'.$item->image) && !empty($item->image))
												<img height="25px" src="{{asset('uploads')}}/{{$item->image}}" alt="{{$item->title}}">
											@endif
										</td>
										<td>
											@if($item->placement == 'footer')
												<span class="badge badge-success">footer</span>
											@else
												<span class="badge badge-primary">header</span>
											@endif
										</td>
										<td>
											<a href="{{url('admin/pages', $item->id)}}/edit" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit"><i class="fe fe-edit-2"></i></a>
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
					<button class="btn btn-primary btn-yes-page">@lang('lang.delete')</button>
				</div>
			</div>
		</div>
	</div>
@endsection



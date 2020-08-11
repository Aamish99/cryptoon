@extends('layouts.admin')
@section('title', __('lang.subscribers'))

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
						<h1 class="header-title">@lang('lang.subscribers')</h1>
						<div class="ml-auto text-right">
							<a href="#!" class="btn btn-danger delete_btn subscriber">
								@lang('text.delete')
							</a>
							<a href="{{url('admin/subscribers/export_csv')}}" class="btn btn-primary">
								@lang('lang.export_csv')
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
									<th> @lang('lang.subscribers_email')</th>
									<th>@lang('lang.date')</th>
								</tr>
								</thead>
								<tbody class="list">
								@foreach($subscribers as $key => $item)
									<tr id="{{$item->id}}">
										<td class="sl_box"></td>
										<td>{{$item->email}}</td>
										<td>
											@if(isset($item->created_at))
												{{date_format($item->created_at,"Y/m/d")}}
											@endif
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
					<button class="btn btn-primary btn-yes-subscriber">@lang('lang.delete')</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('title')
صفحة الاقسام
@stop
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الاقسام</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">14 Aug 2019</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">2015</a>
									<a class="dropdown-item" href="#">2016</a>
									<a class="dropdown-item" href="#">2017</a>
									<a class="dropdown-item" href="#">2018</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')


<div class="row row-sm">
	<div class="col-xl-12">
		<div class="card">
			@if ($errors->any())
				@foreach ($errors->all() as $error)
					<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
						<strong>{{ $error }}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endforeach
			@endif
			{{-- @@@@@@@@@@@@@@@ --}}
		@if(session()->has('successfuly'))
			<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
				<strong>{{session()->get('successfuly')}}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
		@endif
		{{-- Update Statue --}}
		@if (session('update_msg'))
			<h6 class="alert alert-success">{{ session('update_msg') }}</h6>
		@endif
		{{-- Delete Statue --}}
		@if (session('delete_msg'))
			<h6 class="alert alert-success">{{ session('delete_msg') }}</h6>
		@endif
		<div class="card-header pb-15">
			<div class="d-flex justify-content-between">
				<h4 class="card-title mg-b-0">اضافة قسم</h4>
				<i class="mdi mdi-dots-horizontal text-gray"></i>
			</div>
			<p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table. <a href="">Learn more</a></p>
			<div class="col-sm-12 col-md-12 col-xl-12">
				<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8"><strong>اضافة قسم</strong></a>
			</div>
		</div>
		<!-- Add section Modal  -->
			<div class="modal" id="modaldemo8">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<form action="{{url('section_store')}}" method="post">
							{{csrf_field()}}
							<div class="modal-body">
								<div class="input-group " style="margin-bottom: 15px">
									<div class="input-group-append">
									<span class="input-group-text">اسم القسم</span>
									</div>
									<input type="text" class="form-control" name="section_name" aria-label="Amount (to the nearest dollar)">
								</div>
								<div class="input-group">
									<div class="input-group-prepend">
									<span class="input-group-text">ملاحظات</span>
									</div>
									<textarea class="form-control" name="description" aria-label="With textarea"></textarea>
								</div>
							</div>
							<div class="modal-footer">
								<button class="btn ripple btn-primary" type="submit">Save changes</button>
								<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		<!-- End Add section Modal -->
		</div>
	</div>
</div>
<!-- row opened -->
<div class="row row-sm">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header pb-0">
				<div class="d-flex justify-content-between">
					<h4 class="card-title mg-b-0">SIMPLE TABLE</h4>
					<i class="mdi mdi-dots-horizontal text-gray"></i>
				</div>
				<p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table. <a href="">Learn more</a></p>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table text-md-nowrap" id="example1">
						<thead>
							<tr>
								<th class="wd-15p border-bottom-0">#</th>
								<th class="wd-15p border-bottom-0">اسم القسم</th>
								<th class="wd-20p border-bottom-0">الوصف</th>
								<th class="wd-15p border-bottom-0">انشأ بواسطة</th>
								<th class="wd-15p border-bottom-0">العمليات</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($table_data as $item)
							<tr>
								<td>{{ $item->id}}</td>
								<td>{{ $item->section_name}}</td>
								<td>{{ $item->description}}</td>
								<td>{{ $item->created_by}}</td>
								<td>
									<a class="modal-effect btn btn-outline-primary " data-effect="effect-scale" data-toggle="modal" href="#edit_Section"><strong>تعديل</strong></a>
									<a class="modal-effect btn btn-outline-danger " data-effect="effect-scale" data-toggle="modal" href="#delete_section"><strong>خذف</strong></a>
								</td>
							</tr>
							<!-- Edit section Modal  -->
							<div class="modal" id="edit_Section">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content modal-content-demo">
										<div class="modal-header">
											<h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
										</div>
										<form action="{{url('section_update/'.$item->id)}}" method="post">
											{{csrf_field()}}
											<div class="modal-body">
												<div class="input-group " style="margin-bottom: 15px">
													<div class="input-group-append">
													<span class="input-group-text">اسم القسم</span>
													</div>
													<input type="text" class="form-control" name="section_name" value="{{ $item->section_name }}" aria-label="Amount (to the nearest dollar)">
												</div>
												<div class="input-group">
													<div class="input-group-prepend">
													<span class="input-group-text">ملاحظات</span>
													</div>
													<textarea class="form-control" name="description" aria-label="With textarea">{{ $item->description}}</textarea>
												</div>
											</div>
											<div class="modal-footer">
												<button class="btn ripple btn-primary" type="submit">Save changes</button>
												<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- End Edit section Modal -->
							{{-- Start Delete Alert --}}
							<div class="modal" id="delete_section">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content tx-size-sm">
										<div class="modal-body tx-center pd-y-20 pd-x-20">
											<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button> <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
											<h4 class="tx-danger mg-b-20">هل انت متأكد من رغبتك في حذف قسم {{ $item->section_name }}</h4>
											<p class="mg-b-20 mg-x-20">بمجرد حذف القسم سيتم حذف محتوياته ولن تتمكن من استردادها</p>
											<button aria-label="Close" class="btn ripple btn-success pd-x-25" data-dismiss="modal" type="button">الغاء</button>
											<a href="{{ url('section_delete/'.$item->id ) }}" class="btn ripple btn-danger pd-x-25">حذف</a>
										</div>
									</div>
								</div>
							</div>
							{{-- End delete alert --}}
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!--/div-->
</div>
<!-- /row -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>

<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
@endsection

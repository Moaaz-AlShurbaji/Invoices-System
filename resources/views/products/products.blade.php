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
قائمة الفواتير
@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الإعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المنتجات</span>
						</div>
					</div>
				</div>

				@if(session()->has('message'))
					<div class="alert alert-success" role="alert">
						{{ session()->get('message') }}
					</div>	
				@endif
				<!-- breadcrumb -->
@endsection
@section('content')

				<!-- row -->
				@if ($errors->any())
					<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
					</div>
				@endif
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									
									<div class="col-sm-6 col-md-4 col-xl-3 mg-t-20 mg-sm-t-0">
										<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-slide-in-right" data-toggle="modal" href="#modaldemo8">إضافة منتج</a>
									</div>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">#</th>
												<th class="wd-15p border-bottom-0">اسم المنتج</th>
												<th class="wd-20p border-bottom-0">القسم</th>
												<th class="wd-20p border-bottom-0">الوصف</th>
												<th class="wd-15p border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
											
											@foreach($products as $product)
												<tr>
													<td>{{ $product -> id }}</td>
													<td>{{ $product -> product_name }}</td>
													<td>{{ $product -> section -> section_name }}</td>
													<td>{{ $product -> description }}</td>
													<td><a class="modal-effect btn btn-outline-success"
														data-effect="effect-slide-in-right" data-id = "{{ $product -> id }}"
														data-product_name = "{{ $product -> product_name }}"
														data-section_name = "{{ $product -> section -> section_name }}" data-description = "{{ $product -> description }}" data-toggle="modal" 
														href="#editmodal"><i class="las la-pen"></i></a>

														<a class="modal-effect btn btn-outline-danger" data-effect="effect-slide-in-right"
														data-id = "{{ $product -> id }}" data-product_name="{{ $product -> product_name }}" data-toggle="modal"
														href="#deletemodal"><i class="las la-trash"></i></a></td>
													
												</tr>
											@endforeach
												
											
											
							
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="modal" id="modaldemo8">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content modal-content-demo">
									<div class="modal-header">
										<h6 class="modal-title">إضافة منتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
										<form method="post" action="{{ route('products.store')}}">
											@csrf
											<div class="">
												<div class="form-group">
													<label for="section_name">اسم المنتج</label>
													<input type="text" class="form-control" name="product_name" id="section_name" placeholder="ادخل اسم المنتج">	
												</div>
												<div class="form-group">
													<label for="section_id">اسم القسم</label>
													<select name="section_id" id="section_id" class="form-control">
														<option value="" selected disabled>--اختر القسم--</option>
														@foreach($sections as $section)
															<option value="{{ $section -> id }}">{{ $section -> section_name }}</option>
														@endforeach
													</select>

												</div>
												<div class="form-group">
													<label for="description">الوصف</label>
													<textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
												</div>
											</div>
											<!--<input type="hidden" name="created_by" id="created_by" value="{{ Auth::user()->email }}"> -->
											<button type="submit" class="btn btn-success mt-3 mb-0">تأكيد</button>
										</form>
									</div>
								</div>
							</div>
						</div>



					</div>


					<!--edit-->
					<div class="modal" id="editmodal">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content modal-content-demo">
								<div class="modal-header">
									<h6 class="modal-title">تعديل المنتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
									<form method="post" action="products/update">
										@csrf
										@method('PATCH')
										<div class="">
											<div class="form-group">
												<input type="hidden" name="id" id="id" value="">
												<label for="product_name">اسم المنتج</label>
												<input type="text" class="form-control" name="product_name" id="product_name">
											</div>

											<div class="form-group">
												<label for="section_name">القسم</label>
												<input type="text" class="form-control" name="section_name" id="section_name">
											</div>

											<div class="form-group">
												<label for="description">الوصف</label>
												<textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
											</div>
										</div>
										<!--<input type="hidden" name="created_by" id="created_by" value="{{ Auth::user()->email }}"> -->
										<button type="submit" class="btn btn-success mt-3 mb-0">تأكيد</button>
									</form>
								</div>
							</div>
						</div>
					</div>


						<!-- delete -->
						<div class="modal" id="deletemodal">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content modal-content-demo">
									<div class="modal-header">
										<h6 class="modal-title">حذف المنتج</h6><button aria-label="Close" class="close" data-dismiss="modal"
																					   type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<form action="products/destroy" method="post">
										{{method_field('delete')}}
										{{csrf_field()}}
										<div class="modal-body">
											<p>هل انت متاكد من عملية الحذف ؟</p><br>
											<input type="hidden" name="id" id="id" value="">
											<input class="form-control" name="product_name" id="product_name" type="text" readonly>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
											<button type="submit" class="btn btn-danger">تاكيد</button>
										</div>
								</div>
								</form>
							</div>
						</div>

				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
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
<script src="{{URL::asset('assets/js/modal.js')}}"></script>

<script>
	$('#editmodal').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var product_name = button.data('product_name');
		var section_name = button.data('section_name')
		var description = button.data('description')
		var modal = $(this)
		console.log(section_name);
		console.log(id);
		modal.find('#id').val(id);
		modal.find('#product_name').val(product_name);
		modal.find('#section_name').val(section_name);
		modal.find('#description').val(description);

	})

	
</script>

<script>
	$('#deletemodal').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var product_name = button.data('product_name')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #product_name').val(product_name);
	})
</script>

@endsection
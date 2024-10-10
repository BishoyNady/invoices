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
المنتجات
@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المنتجات</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
@if($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
	@endif

	@if(session()->has('Add'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>{{session()->get('Add')}}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="alert">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif

					@if(session()->has('delete'))
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<strong>{{session()->get('delete')}}</strong>
										<button type="button" class="close" data-dismiss="alert" aria-label="alert">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									@endif
					
					@if(session()->has('edit'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>{{session()->get('edit')}}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="alert">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif
				<!-- row -->
				<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">

								<div class="col-sm-6 col-md-3 mg-t-10 mg-sm-t-0">
		<button class="btn btn-secondary-gradient btn-block" data-toggle="modal" href="#modaldemo8">اضافه منتج</button>
	</div>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap" data-page-length="50">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">اسم المنتج </th>
												<th class="border-bottom-0">اسم القسم </th>
												<th class="border-bottom-0">ملاحظات </th>
												<th class="border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 0;?>
											@foreach($products as $product)
											<?php $i++ ?>
											<tr>
												<td>{{$i}}</td>
												<td>{{$product->product_name}}</td>
												<td>{{$product->section->section_name}}</td>
												<td>{{$product->description}}</td>
												<td>
												<a class="btn btn-outline-success btn-sm" 
												data-pro_id="{{$product->id}}"
													data-name="{{$product->product_name}}" data-section_name="{{$product->section->section_name}}"
													data-description="{{$product->description}}" data-toggle="modal" href="#modaldemo1"
													title="تعديل">تعديل</a>
													
													<a class="btn btn-outline-danger btn-sm" data-effect="effect-scale"
													data-pro_id="{{$product->id}}" data-product_name="{{$product->product_name}}"
													 data-toggle="modal" href="#modaldemo2"
													title="حذف">حذف</i></a>
												</td>
											</tr>
												@endforeach

											
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- modal add -->
						<div class="modal" id="modaldemo8">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">اضافه منتج </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
					<form action="{{route('products.store')}}" method="post">
						@csrf
						
							<div class="form-group">
								<label for="exampleInputEmail1">اسم المنتج</label>
								<input type="text" class="form-control" id="product_name" name="product_name"  >
							</div>

							<label class="my-1 mr-2" for="inlineFormCustonSelectPref">القسم</label>
							<select name="section_id" id="section_id" class="form-control" >
								<option value="" selected disabled>--حدد القسم--</option>
								@foreach($sections as $section)
								<option value="{{$section->id}}">{{$section->section_name}}</option>
								@endforeach
							</select>
							
							<div class="form-group">
								<label for="exampleFormControlTextarea1">ملاحظات </label>
							<textarea class="form-control" id="description" name="description" row="3"></textarea>
						</div>
						
					
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">تاكيد</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
					</div>
				</form>
				</div>
			</div>
		</div>


		
					</div>

						<!-- modal1 edit-->
<div class="modal" id="modaldemo1">
<div class="modal-dialog" role="document">
<div class="modal-content modal-content-demo">
<div class="modal-header">
<h6 class="modal-title">تعديل المنتج </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
<form action="products/update" method="post" autocomplete="off">
@csrf
@method('PUT')

<div class="form-group">
	<input type="hidden" name="pro_id" id="pro_id" value="">
<label for="exampleInputEmail1">اسم المنتج</label>
<input type="text" class="form-control" id="product_name" name="product_name" >
</div>

<label class="my-1 mr-2" for="inlineFormCustonSelectPref">القسم</label>
							<select name="section_name" id="section_name" class="form-control" >
								
								@foreach($sections as $section)
								<option {{$section->id}}>{{$section->section_name}}</option>
								@endforeach
							</select>

<div class="form-group">
<label for="exampleFormControlTextarea1">ملاحظات </label>
<textarea class="form-control" id="description" name="description" row="3"></textarea>
</div>


<div class="modal-footer">
<button type="submit" class="btn btn-success">تعديل البيانات</button>
<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
</div>
</form>
</div>
</div>
</div>


				<!-- row closed -->
			</div>

										<!-- modal delete -->
<div class="modal" id="modaldemo2">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">حذف المنتج  </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
					<form action="products/destroy" method="post">
						@csrf
						@method('delete')
						<p>هل انت متاكد من عمليه الحذف ؟</p>
							
								<input type="hidden" name="pro_id" id="pro_id" value="">
								<input type="text" class="form-control" id="product_name" name="product_name" readonly>
							
						
					
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">تاكيد</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
					</div>
				</form>
				</div>
			</div>
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
<script src="{{URL::asset('assets/js/modal.js')}}"></script>

<script>
	$('#modaldemo1').on('show.bs.modal' , function(event){
		var button = $(event.relatedTarget)
		var product_name = button.data('name')
		var section_name = button.data('section_name')
		var description = button.data('description')
		var pro_id = button.data('pro_id')
		var modal = $(this)
		modal.find('.modal-body #product_name').val(product_name);
		modal.find('.modal-body #section_name').val(section_name);
		modal.find('.modal-body #description').val(description);
		modal.find('.modal-body #pro_id').val(pro_id);
	})
</script>

<script>
	$('#modaldemo2').on('show.bs.modal' , function(event){
		var button = $(event.relatedTarget)
		var product_name = button.data('product_name')
		var pro_id = button.data('pro_id')
		var modal = $(this)
		modal.find('.modal-body #product_name').val(product_name);
		modal.find('.modal-body #pro_id').val(pro_id);
	})
</script>
@endsection
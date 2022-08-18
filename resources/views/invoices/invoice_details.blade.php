@extends('layouts.master')
@section('css')
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
@endsection

@section('title')
تفاصيل الفاتورة
@endsection


@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الفاتورة</span>
						</div>
					</div>
                </div>  
@endsection


@section('content')

<div class="col-xl-12">
    <!-- div -->
    <div class="card mg-b-20" id="tabs-style2">
        <div class="card-body">
            
            <div class="text-wrap">
                <div class="example">
                    <div class="panel panel-primary tabs-style-2">
                        <div class=" tab-menu-heading">
                            <div class="tabs-menu1">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs main-nav-line">
                                    <li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات الفاتورة</a></li>
                                    <li><a href="#tab5" class="nav-link" data-toggle="tab">حالات الدفع</a></li>
                                    <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body main-content-body-right border">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab4">
                                   <table class="table table-striped" style="text-align: center;">
                                        <tbody>
                                            <tr>
                                                <th class="row">رقم الفاتورة</th>
                                                <td>{{ $invoice -> invoice_number }}</td>
                                                <th class="row">تاريخ الاصدار</th>
                                                <td>{{ $invoice -> invoice_date }}</td>
                                                <th class="row">تاريخ الاستحقاق</th>
                                                <td>{{ $invoice -> due_date }}</td>
                                                <th class="row">القسم</th>
                                                <td>{{ $invoice -> section -> section_name }}</td>
                                            </tr>
                                                
                                            <tr>
                                                <th class="row">نسبة الضريبة</th>
                                                <td>{{ $invoice -> rate_vat }}</td>
                                                <th class="row">قيمة الضريبة</th>
                                                <td>{{ $invoice -> value_vat }}</td>
                                                <th class="row">الإجمالي مع الضريبة</th>
                                                <td>{{ $invoice -> total }}</td>
                                                <th class="row">الحالة الحالية</th>
                                                @if($invoice -> value_statues == 1)
                                                    <td>
                                                        <span class="badge badge-bill badge-success">{{ $invoice -> status }}</span>
                                                    </td>
                                                @elseif($invoice -> value_statues == 2)
                                                    <td>
                                                        <span class="badge badge-bill badge-danger">{{ $invoice -> status }}</span>
                                                    </td>
                                                @else
                                                    <td>
                                                        <span class="badge badge-bill badge-warning">{{ $invoice -> status }}</span>
                                                    </td>
                                                @endif    
                                            </tr>

                                            <tr>
                                                <th class="row">المستخدم</th>
                                                <td>{{ $invoice -> user}}</td>
                                                <th class="row">ملاحظات</th>
                                                <td>{{ $invoice -> note }}</td>
                                            </tr>
                                        </tbody>
                                   </table>
                                </div>
                                <div class="tab-pane" id="tab5">
                                    
                                </div>
                                <div class="tab-pane" id="tab6">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>          


@endsection


















@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Internal Input tags js-->
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
<!--- Tabs JS-->
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
@endsection
@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('title')
    تفاصيل فاتورة
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="{{ url('invoices') }}">الفواتير</a></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الفاتورة</span>
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
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                        data-x-placement="bottom-end">
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
    <!-- row opened -->
    <!-- Prism Code -->
    <!-- /div -->

    <div class="col-xl-12">
        <!-- div -->
        {{-- Delete Statue --}}
        @if (session('delete_msg'))
            <h6 class="alert alert-success">{{ session('delete_msg') }}</h6>
        @endif

        @if (session()->has('Add'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Add') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card" id="tabs-style4">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                   تفاصيل الفاتورة
                </div>
                <p class="mg-b-20">It is Very Easy to Customize and it uses in your website apllication.</p>
                <div class="text-wrap">
                    <div class="example">
                        <div class="d-md-flex">
                            <div class="">
                                <div class="panel panel-primary tabs-style-4">
                                    <div class="tab-menu-heading">
                                        <div class="tabs-menu ">
                                            <!-- Tabs -->
                                            <ul class="nav panel-tabs ml-3">
                                                <li class="">
                                                    <a href="#invoice_details" class="active" data-toggle="tab">
                                                    <i class="fa fa-laptop"></i> معلومات الفاتورة</a></li>
                                                <li>
                                                    <a href="#invoice_status" data-toggle="tab"><i class="fa fa-cube"></i> حالات الدفع</a>
                                                </li>
                                                <li>
                                                    <a href="#invoice_attachement" data-toggle="tab"><i class="fa fa-cogs"></i> المرفقات</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tabs-style-4 ">
                                <div class="panel-body tabs-menu-body">
                                    <div class="tab-content">
                                        {{-- Tab --}}
                                        <div class="tab-pane active" id="invoice_details">
                                            <table class="table table-striped" style="text-align:center">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">رقم الفاتورة</th>
                                                    <td>{{ $invoices->invoice_number }}</td>
                                                    <th scope="row">تاريخ الاصدار</th>
                                                    <td>{{ $invoices->invoice_Date }}</td>
                                                    <th scope="row">تاريخ الاستحقاق</th>
                                                    <td>{{ $invoices->Due_date }}</td>
                                                    <th scope="row">القسم</th>
                                                    <td>{{ $invoices->Section->section_name }}</td>
                                                </tr>

                                                <tr>
                                                    <th scope="row">المنتج</th>
                                                    <td>{{ $invoices->product }}</td>
                                                    <th scope="row">مبلغ التحصيل</th>
                                                    <td>{{ $invoices->Amount_collection }}</td>
                                                    <th scope="row">مبلغ العمولة</th>
                                                    <td>{{ $invoices->Amount_Commission }}</td>
                                                    <th scope="row">الخصم</th>
                                                    <td>{{ $invoices->Discount }}</td>
                                                </tr>


                                                <tr>
                                                    <th scope="row">نسبة الضريبة</th>
                                                    <td>{{ $invoices->Rate_VAT }}</td>
                                                    <th scope="row">قيمة الضريبة</th>
                                                    <td>{{ $invoices->Value_VAT }}</td>
                                                    <th scope="row">الاجمالي مع الضريبة</th>
                                                    <td>{{ $invoices->Total }}</td>
                                                    <th scope="row">الحالة الحالية</th>

                                                    @if ($invoices->Value_Status == 1)
                                                        <td><span
                                                                class="badge badge-pill badge-success">{{ $invoices->Status }}</span>
                                                        </td>
                                                    @elseif($invoices->Value_Status ==2)
                                                        <td><span
                                                                class="badge badge-pill badge-danger">{{ $invoices->Status }}</span>
                                                        </td>
                                                    @else
                                                        <td><span
                                                                class="badge badge-pill badge-warning">{{ $invoices->Status }}</span>
                                                        </td>
                                                    @endif
                                                </tr>

                                                <tr>
                                                    <th scope="row">ملاحظات</th>
                                                    <td>{{ $invoices->note }}</td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                        {{-- Tab --}}
                                        <div class="tab-pane" id="invoice_status">
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th>رقم الفاتورة</th>
                                                            <th>نوع المنتج</th>
                                                            <th>القسم</th>
                                                            <th>حالة الدفع</th>
                                                            <th>تاريخ الدفع </th>
                                                            <th>ملاحظات</th>
                                                            <th>تاريخ الاضافة </th>
                                                            <th>المستخدم</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($details as $x)
                                                            <tr>
                                                                <td>{{ $x->id }}</td>
                                                                <td>{{ $x->invoice_number }}</td>
                                                                <td>{{ $x->product }}</td>
                                                                <td>{{ $invoices->Section->section_name }}</td>
                                                                @if ($x->Value_Status === 1)
                                                                    <td>
                                                                        <span class="badge badge-pill badge-danger">غير مدفوع</span>
                                                                    </td>
                                                                @elseif($x->Value_Status === 2)
                                                                    <td><span
                                                                            class="badge badge-pill badge-success">مدفوع</span>
                                                                    </td>
                                                                @else
                                                                    <td><span
                                                                            class="badge badge-pill badge-warning">مدفوع جزئيا</span>
                                                                    </td>
                                                                @endif
                                                                <td>{{ $x->Payment_Date }}</td>
                                                                <td>{{ $x->note }}</td>
                                                                <td>{{ $x->created_at }}</td>
                                                                <td>{{ $x->user }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>
                                        {{-- tab --}}
                                        <div class="tab-pane" id="invoice_attachement">
                                            
                                            {{-- Add Attachment --}}
                                            <div class="card card-statistics">
                                                <div class="card-body">
                                                    <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                    <h5 class="card-title">اضافة مرفقات</h5>
                                                    <form method="post" action="{{ url('/Additional_InvoiceAttachments') }}"
                                                        enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile"
                                                                name="file_name" required>
                                                            <input type="hidden" id="customFile" name="invoice_number"
                                                                value="{{ $invoices->invoice_number }}">
                                                            <input type="hidden" id="invoice_id" name="invoice_id"
                                                                value="{{ $invoices->id }}">
                                                            <label class="custom-file-label" for="customFile">حدد
                                                                المرفق</label>
                                                        </div><br><br>
                                                        <button type="submit" class="btn btn-primary btn-sm "
                                                            name="uploadedFile">تاكيد</button>
                                                    </form>
                                                </div><hr>
                                            {{-- End Add Attachment --}}
                                            <table class="table center-aligned-table mb-0 table table-hover"
                                            style="text-align:center">
                                            <thead>
                                                <tr class="text-dark">
                                                    <th scope="col">م</th>
                                                    <th scope="col">اسم الملف</th>
                                                    <th scope="col">قام بالاضافة</th>
                                                    <th scope="col">تاريخ الاضافة</th>
                                                    <th scope="col">العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($attachments as $attachment)
                                                    <tr>
                                                        <td>{{ $attachment->id }}</td>
                                                        <td>{{ $attachment->file_name }}</td>
                                                        <td>{{ $attachment->Created_by }}</td>
                                                        <td>{{ $attachment->created_at }}</td>
                                                        <td colspan="2">

                                                            <a class="btn btn-outline-success btn-sm"
                                                                href="{{ url('Attachments') }}/{{ $invoices->invoice_number }}/{{ $attachment->file_name }}"
                                                                role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                عرض</a>

                                                            <a class="btn btn-outline-info btn-sm" href="{{ url('download')}}/{{ $attachment->invoice_number }}/{{$attachment->file_name}}" role="button">
                                                                <i class="fas fa-download"></i>&nbsp;  تحميل</a>

                                                            {{-- @can('حذف المرفق') --}}
                                                                <button class="btn btn-outline-danger btn-sm"
                                                                    data-toggle="modal"
                                                                    data-file_name="{{ $attachment->file_name }}"
                                                                    data-invoice_number="{{ $attachment->invoice_number }}"
                                                                    data-id_file="{{ $attachment->id }}"
                                                                    data-target="#delete_file">حذف</button>
                                                            {{-- @endcan --}}

                                                        </td>
                                                    </tr>
                                                        {{-- Delete --}}
                                                        <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="{{ url('delete_attachment_file/'.$attachment->id) }}" method="post">

                                                                    {{ csrf_field() }}
                                                                    <div class="modal-body">
                                                                        <p class="text-center">
                                                                        <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                                                                        </p>

                                                                        <input type="hidden" name="id_file" id="id_file" value="">
                                                                        <input type="hidden" name="file_name" id="file_name" value="">
                                                                        <input type="hidden" name="invoice_number" id="invoice_number" value="">

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                                                        <button type="submit" class="btn btn-danger">تاكيد</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <!-- end delete Tab --> 
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </div>
                                        {{-- tab --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---Prism Pre code-->
                </div>
            </div>
            <!-- /div -->
        </div>
    </div>
    </div>

    </div>
    <!-- /row -->

    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
@endsection

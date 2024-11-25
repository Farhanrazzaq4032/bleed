@extends('layouts.main')

@section('section')
    <!--begin::Container-->
    <div class="container">

    </div>
    <!--end::Container-->
@endsection

@push('scripts')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{asset('')}}assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{asset('')}}assets/js/pages/widgets.js"></script>
    <!--end::Page Scripts-->
@endpush
@push('styles')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{asset('')}}assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
@endpush

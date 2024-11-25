@extends('layouts.main')

@section('section')
    <!--begin::Container-->
    <div class="container">
        <form action="{{ route('admin.admins.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!--begin::Card-->
            <div class="card card-custom mb-4">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Add Admin</h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-light-primary font-weight-bolder mr-2">
                            <i class="ki ki-long-arrow-back icon-sm"></i>
                            Back
                        </a>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-6">
                            <label>Name:</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                autocomplete="off" placeholder="Enter Name" required="">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->get('name')[0] }}</span>
                            @endif
                        </div>
                        <div class="col-6">
                            <label>Email:</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                autocomplete="off" placeholder="Enter Email" required="">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->get('email')[0] }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>status:</label>
                            <div class="col-form-label">
                                <div class="radio-inline">
                                    <label class="radio radio-success">
                                        <input type="radio" name="status" {{old('status') == '0' ? '' : 'checked="checked"' }} value="1">
                                        <span></span>
                                        Active
                                    </label>
                                    <label class="radio radio-danger">
                                        <input type="radio" name="status" {{old('status') == '0' ? 'checked="checked"' : '' }} value="0">
                                        <span></span>
                                        Inactive
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="text-align: end">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary font-weight-bolder">
                        <i class="ki ki-check icon-sm"></i>
                        Submit
                    </button>
                </div>
            </div>
            <!--end::Card-->
        </form>
    </div>
    <!--end::Container-->
@endsection

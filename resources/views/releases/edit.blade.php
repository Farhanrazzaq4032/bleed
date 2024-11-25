@extends('layouts.main')

@section('section')
    <!--begin::Container-->
    <div class="container">
        <form action="{{ route('admin.releases.update', $release->id) }}" method="POST" enctype="multipart/form-data" id="release-form">
            @csrf
            @method('PUT')
            <!--begin::Card-->
            <div class="card card-custom mb-4">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Update Release</h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ route('admin.releases.index') }}" class="btn btn-light-primary font-weight-bolder mr-2">
                            <i class="ki ki-long-arrow-back icon-sm"></i>
                            Back
                        </a>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-right-lg">Image</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="image-input image-input-outline" id="kt_image_1">
                                        <div class="image-input-wrapper" style="background-image: url('{{ asset('uploads/releases/' . $release->image) }}')"></div>
                                        <label
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                            data-action="change" data-toggle="tooltip" title=""
                                            data-original-title="Change avatar">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="profile_avatar_remove" />
                                        </label>
                                        <span
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                            data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                    <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                    @if ($errors->has('image'))
                                        <span class="text-danger">{{ $errors->get('image')[0] }}</span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label>Name:</label>
                            <input type="text" name="release_name" class="form-control" id="release_name" value="{{ old('release_name') ?? $release->name }}"
                                autocomplete="off" placeholder="Enter Name" required="">
                            @if ($errors->has('release_name'))
                                <span class="text-danger">{{ $errors->get('release_name')[0] }}</span>
                            @endif
                            <span class="text-danger" id="release_name_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Artist:</label>
                            <select class="form-control select2" id="artist_id" name="artist_id" required>
                                <option></option>
                                @foreach ($artists as $artist)
                                    <option value="{{ $artist->id }}" {{old('artist_id') ?? $release->artist_id == $artist->id ? 'selected' : '' }}>{{ $artist->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="artist_id_error"></span>
                        </div>
                        <div class="col-lg-6">
                            <label>Release Date:</label>
                            <div class="input-group date">
                                <input type="text" class="form-control" readonly="readonly" name="release_date" value="{{ old('release_date') ?? $release->release_date }}" required id="kt_datepicker_1" placeholder="Select Release Date" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar"></i>
                                    </span>
                                </div>
                            </div>
                            <span class="text-danger" id="release_date_error"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->

            <!--begin::Card-->
            <div class="card card-custom mb-4">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Add Reviews</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <button type="button" onclick="addRow()" class="btn btn-light-primary font-weight-bolder mr-2">
                                <i class="la la-plus"></i>
                                Add Review
                            </button>
                        </div>
                   </div>
                   <div class="row  @if($release->reviews->count() == 0) d-none  @endif" id="review-div">
                    <table class="table table-head-noborder table-responsive-sm purchase-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>A/D</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_review">
                           @foreach($release->reviews as $review)
                                <tr>
                                    <td><input type="text" name="review_name[]" value="{{$review->name}}" class="form-control " autocomplete="off" placeholder="Enter Name" required></td>
                                    <td><textarea name="description[]" class="form-control" rows="3" required placeholder="Enter Review Discription" >{{$review->description}}</textarea></td>
                                    <td><button class="btn btn-icon btn-danger btn-sm btn-circle" type="button" onclick="deleteRow(this)" ><i class="fa fa-trash"></i></button></td>
                                </tr>
                           @endforeach
                        </tbody>

                    </table>
                </div>
                </div>
            </div>
            <!--end::Card-->
             <!--begin::Card-->
             <div class="card card-custom mb-4">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Add Track List</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <button type="button" onclick="addRowTrack()" class="btn btn-light-primary font-weight-bolder mr-2">
                                <i class="la la-plus"></i>
                                Add Track
                            </button>
                        </div>
                   </div>
                   <div class="row @if($release->tracks->count() == 0) d-none  @endif" id="track-div">
                    <table class="table table-head-noborder table-responsive-sm purchase-table">
                        <thead>
                            <tr>
                                <th>image</th>
                                <th>Name</th>
                                <th>A/D</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_track">
                            @foreach($release->tracks as $track)
                            <tr class="tracks-group">
                                <input type="hidden" name="tracks[{{ $loop->index }}][id]" value="{{ $track->id }}">
                                <td><input type="file" name="tracks[{{ $loop->index }}][track_image]" class="form-control"></td>
                                <td><input type="text" name="tracks[{{ $loop->index }}][name]" class="form-control " autocomplete="off" placeholder="Enter Name" value="{{$track->name}}" required></td>
                                <td><button class="btn btn-icon btn-danger btn-sm btn-circle" type="button" onclick="deleteRowTrack(this)" ><i class="fa fa-trash"></i></button></td>
                            </tr>
                       @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="card-footer" style="text-align: end">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary font-weight-bolder">
                        <i class="ki ki-check icon-sm"></i>
                        Update
                    </button>
                </div>
                </div>
            </div>
            <!--end::Card-->
        </form>
    </div>
    <!--end::Container-->
@endsection
@push('scripts')
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('') }}assets/js/pages/crud/forms/widgets/select2.js"></script>
    <script src="{{ asset('') }}assets/js/pages/crud/file-upload/image-input.js"></script>
    <script src="{{ asset('') }}assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js"></script>
    <script>
         var index = document.querySelectorAll('.tracks-group').length;
        const addRow = () => {
            var html = '';
            html += ' <tr>';
            html +=
                `<td><input type="text" name="review_name[]" class="form-control " autocomplete="off" placeholder="Enter Name" required></td>`;
            html +=
                `  <td><textarea name="description[]" class="form-control" rows="3" required placeholder="Enter Review Discription" ></textarea></td>`;
            html += '<td>';
            html +=
                '<button class="btn btn-icon btn-danger btn-sm btn-circle" type="button" onclick="deleteRow(this)" ><i class="fa fa-trash"></i></button>';
            html += '</td>';
            html += '</tr>';
            $('#tbl_review').prepend(html);
            $('#review-div').removeClass('d-none');
        }
        const deleteRow = (val) => {
            if($('#tbl_review tr').length == 1) {
                $('#review-div').addClass('d-none');
            }
            $(val).closest('tr').remove();
        }
        const addRowTrack = () => {
            index = index + 1;
            var html = '';
            html += ' <tr>';
                html +=
                `  <td><input type="file" name="tracks[${index}][track_image]" class="form-control"></td>`;
            html +=
                `<td><input type="text" name="tracks[${index}][name]" class="form-control " autocomplete="off" placeholder="Enter Name" required></td>`;
            html += '<td>';
            html +=
                '<button class="btn btn-icon btn-danger btn-sm btn-circle" type="button" onclick="deleteRowTrack(this)" ><i class="fa fa-trash"></i></button>';
            html += '</td>';
            html += '</tr>';
            $('#tbl_track').prepend(html);
            $('#track-div').removeClass('d-none');
        }
        const deleteRowTrack = (val) => {
            if($('#tbl_track tr').length == 1) {
                $('#track-div').addClass('d-none');
            }
            $(val).closest('tr').remove();
        }
    </script>
     <script>
        $('#release-form').submit(function(e) {
            var valid = true;
            var firstInvalidField = null;

            if ($('#release_name').val() == '') {
                $('#release_name_error').text('Release name is required');
                valid = false;
                if (!firstInvalidField) {
                    firstInvalidField = '#release_name';
                }
            } else {
                $('#release_name_error').text('')
            }

            if ($('#artist_id').val() == '') {
                $('#artist_id_error').text('Artist is required');
                valid = false;
                if (!firstInvalidField) {
                    firstInvalidField = '#artist_id';
                }
            } else {
                $('#artist_id_error').text('')
            }

            if ($('#kt_datepicker_1').val() == '') {
                $('#release_date_error').text('Release Date is required');
                valid = false;
                if (!firstInvalidField) {
                    firstInvalidField = '#release_date';
                }
            } else {
                $('#release_date_error').text('')
            }


            if (valid == false) {
                e.preventDefault();
                if (firstInvalidField) {
                    $(firstInvalidField).focus();
                }
            }


        });
    </script>
    <!--end::Page Scripts-->
@endpush

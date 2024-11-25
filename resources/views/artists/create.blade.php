@extends('layouts.main')

@section('section')
    <!--begin::Container-->
    <div class="container">
        <form action="{{ route('admin.artists.store') }}" method="POST" enctype="multipart/form-data" id="artist-form">
            @csrf
            <!--begin::Card-->
            <div class="card card-custom mb-4">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Add Artist</h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ route('admin.artists.index') }}" class="btn btn-light-primary font-weight-bolder mr-2">
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
                                        <div class="image-input-wrapper" style=""></div>
                                        <label
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                            data-action="change" data-toggle="tooltip" title=""
                                            data-original-title="Change avatar">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="image" id="image"
                                                accept=".png, .jpg, .jpeg" />
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
                                    <span class="text-danger" id="artist_image_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 my-2">
                                    <label>Name:</label>
                                    <input type="text" name="artist_name" id="artist_name" class="form-control"
                                        value="{{ old('artist_name') }}" autocomplete="off" placeholder="Enter Name">
                                    <span class="text-danger" id="artist_name_error"></span>
                                    @if ($errors->has('artist_name'))
                                        <span class="text-danger">{{ $errors->get('artist_name')[0] }}</span>
                                    @endif
                                </div>
                                <div class="col-12 my-2">
                                    <label>Link:</label>
                                    <input type="text" name="link" class="form-control" autocomplete="off"
                                        placeholder="Enter Link" value="{{ old('link') }}"
                                        id="link" required="">
                                    <span class="text-danger" id="link_error"></span>
                                    @if ($errors->has('link'))
                                        <span class="text-danger">{{ $errors->get('link')[0] }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-12">
                            <label for="exampleTextarea">Description:</label>
                            <textarea class="form-control" name="description" id="artist_description" rows="6">{{ old('description') }}</textarea>
                            <span class="text-danger" id="artist_description_error"></span>
                            @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->get('description')[0] }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->
            <!--begin::Card-->
            <div class="card card-custom mb-4">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Add Booking Agents</h3>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <table class="table table-head-noborder table-responsive-sm purchase-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>A/D</th>
                                </tr>
                            </thead>
                            <tbody id="tbl">
                                <tr>
                                    <td><input type="text" name="name[]" class="form-control " autocomplete="off"
                                            placeholder="Enter Name"></td>
                                    <td><input type="text" name="email[]" class="form-control " autocomplete="off"
                                            placeholder="Enter Email"></td>
                                    <td><input type="text" name="phone[]" class="form-control "
                                            autocomplete="off"placeholder="Enter Phone"></td>
                                    <td><button class="btn btn-icon btn-sm btn-primary" type="button"
                                            onclick="addRow()"><i class="fa fa-plus"></i></button></td>
                                </tr>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <!--end::Card-->

            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Downloads</h3>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-lg-6">
                            <label>Downloads:</label>
                            <div></div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="downloads[]" id="downloads"
                                    multiple>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-12">
                            <div id="display-files" class="d-none">

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
@push('scripts')
    <script>
        const addRow = () => {
            var html = '';
            html += ' <tr>';
            html +=
                `<td><input type="text" name="name[]" class="form-control " autocomplete="off" placeholder="Enter Name"></td>`;
            html +=
                ` <td><input type="text" name="email[]" class="form-control " autocomplete="off" placeholder="Enter Email" ></td>`;
            html +=
                ` <td><input type="text" name="phone[]" class="form-control " autocomplete="off"placeholder="Enter Phone"></td>`;
            html += '<td>';
            html +=
                '<button class="btn btn-icon btn-danger btn-sm btn-circle" type="button" onclick="deleteRow(this)" ><i class="fa fa-trash"></i></button>';
            html += '</td>';
            html += '</tr>';
            $('#tbl').append(html);
        }
        const deleteRow = (val) => {
            $(val).closest('tr').remove();
        }
    </script>
    <script>
        var files = [];
        $('#downloads').on('input', function() {
            var file = $('#downloads').val();
            files = [];
            var filesLength = files.length;
            var totalfiles = document.getElementById('downloads').files.length;
            var html = '';

            var attachment_id = filesLength;
            for (var index = 0; index < totalfiles; index++) {
                console.log(index);
                // $files.push("files[]", document.getElementById('files').files[index]);
                filename = document.getElementById('downloads').files[index].name;
                html += "<div id=\"mutli-attach-iden" + attachment_id + "\" class=\"d-inline mr-2\">\n" +
                    "                                                                <i class=\"fas fa-file\"></i>\n" +
                    "                                                                <span class=\"uploaded-file-name\">" +
                    filename + "</span>\n" +
                    "                                                                <i class=\"flaticon2-cross icon-sm\" onclick=\"removeFile(" +
                    attachment_id + ");\" style=\" cursor: pointer \"></i>\n" +
                    "                                                            </div>";
                files.push(document.getElementById('downloads').files[index]);
                attachment_id++;
            }

            $('#display-files').removeClass('d-none');
            $("#display-files").html(html);
        });

        function removeFile(index) {
            var attachments = document.getElementById('downloads').files;
            var fileBuffer = new DataTransfer();
            for (let i = 0; i < attachments.length; i++) {
                // Exclude file in specified index
                if (index !== i)
                    fileBuffer.items.add(attachments[i]);
            }

            // Assign buffer to file input
            document.getElementById("downloads").files = fileBuffer.files;
            files.splice(index, 1);
            $("#display-files #mutli-attach-iden" + index).remove();

            var html = "";
            for (var index = 0; index < files.length; index++) {
                filename = files[index].name;
                html += "<div id=\"mutli-attach-iden" + index + "\" class=\"d-inline mr-2\">\n" +
                    "                                                                <i class=\"fas fa-file\"></i>\n" +
                    "                                                                <span class=\"uploaded-file-name\">" +
                    filename + "</span>\n" +
                    "                                                                <i class=\"flaticon2-cross icon-sm\" onclick=\"removeFile(" +
                    index + ");\" style=\" cursor: pointer \"></i>\n" +
                    "                                                            </div>";
            }
            $('#display-files').removeClass('d-none');
            $("#display-files").html(html);
        }
    </script>
    <script>
        $('#artist-form').submit(function(e) {
            var valid = true;
            var firstInvalidField = null;

            if (document.getElementById("image").files.length == 0) {
                $('#artist_image_error').text('Artist Image is required');
                valid = false;
                if (!firstInvalidField) {
                    firstInvalidField = '#image';
                }
            } else {
                $('#artist_image_error').text('')
            }

            if ($('#artist_name').val() == '') {
                $('#artist_name_error').text('Artist name is required');
                valid = false;
                if (!firstInvalidField) {
                    firstInvalidField = '#artist_name';
                }
            } else {
                $('#artist_name_error').text('')
            }
            if ($('#link').val() == '') {
                $('#link_error').text('Artist Link is required');
                valid = false;
                if (!firstInvalidField) {
                    firstInvalidField = '#link';
                }
            } else {
                $('#link_error').text('')
            }

            // if ($('#artist_description').val() == '') {
            //     $('#artist_description_error').text('Description is required');
            //     valid = false;
            //     if (!firstInvalidField) {
            //         firstInvalidField = '#artist_description';
            //     }
            // } else {
            //     $('#artist_description_error').text('')
            // }


            if (valid == false) {
                e.preventDefault();
                if (firstInvalidField) {
                    $(firstInvalidField).focus();
                }
            }


        });
    </script>
    <script src="{{ asset('') }}assets/js/pages/crud/file-upload/image-input.js"></script>
@endpush

@extends('back-end.premium.layout.premium-main')
@section('content')
<style>
    th,
    td {
        padding: 5px;
    }

    th {
        text-align: left;
    }
</style>
<section class="main-contant-section">

    <div class="employee-basic-information">
        @if (Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @foreach ($errors->all() as $error)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong class="text-danger">{{ $error }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endforeach
        <form method="POST" action="{{ route('warning-letter-format-adds') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <div class="card mb-2 content-box">

                    <div class="card-header mb-10">

                        <h1 class="card-title"> {{ __('Warning Letter Format') }} </h1>
                        <nav aria-label="breadcrumb">
                            <ol id="breadcrumb1">
                                <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a>
                                </li>
                                <li><a href="{{ route('warning-letter-formats') }}"><span class="icon icon-list">
                                        </span> Warning Letter Format List</a></li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="company_name">
                                            <span style="color:black;font-weight:bold;">Headers </label>
                                        <div class="input-group">
                                            <select name="header_id" id="" class="form-control">
                                                <option value="">Select Header</option>
                                                @foreach ($headers as $header)
                                                <option value="{{ $header->id }}">
                                                    {!! preg_replace_callback(
                                                    '/\b(\w)/',
                                                    function ($matches) {
                                                    return ucfirst($matches[0]);
                                                    },
                                                    Str::limit($header->header_description, 40),
                                                    ) !!}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="company_name">
                                            <span style="color:black;font-weight:bold;">Subject </span>
                                            <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Letter Subject"
                                                name="subject" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="email">
                                        <span style="color:black;font-weight:bold;">Template Body </span><span
                                            class="text-danger"> *</span> </label>
                                    <div class="">
                                        <textarea name="warning_letter_format_body" id="description" cols="30" rows="5"
                                            placeholder="Writing Somthing...."></textarea>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="website">
                                        Signature <span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" id="profile_photo"
                                            class="form-control @error('photo') is-invalid @enderror"
                                            name="signature_img"
                                            placeholder="{{ __('Upload', ['key' => trans('file.Photo')]) }}" required>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <img id="blah"
                                            src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                            style="width: 150px" height="150px" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="website">
                                            Sginatory <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <select name="employee_id" id="employment_type" class="form-control"
                                                required>
                                                <option value="">{{ __('Select A Signatory ') }}</option>
                                                @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">
                                                    {{ $employee->first_name . ' ' . $employee->last_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="website">
                                            Footer </label>
                                        <div class="input-group">
                                            <select name="footer_id" class="form-control">
                                                <option value="">{{ __('Select A Footer...') }}</option>
                                                @foreach ($footers as $footer)
                                                <option value="{{ $footer->id }}">
                                                    {{ Str::limit($footer->footer_description, 45, '...') }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">
                                            <span style="color:black;font-weight:bold;">Extra features
                                            </span></label>
                                        <div class="input-group">
                                            <textarea name="warning_letter_format_extra" id="" cols="30" rows="5"
                                                placeholder="Writing Somthing...."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" text-left mt-4">

                                <button type="submit" id="abcd" class="btn btn-grad ladda-button"
                                    data-style="expand-right">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    <span class="ladda-label">
                                        Save </span><span class="ladda-spinner"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </form>


    </div>

</section>
@endsection
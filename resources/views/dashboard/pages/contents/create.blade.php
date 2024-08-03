@extends('dashboard.layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Content Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('admin.contents.store') }}" method="POST" role="form text-left">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                                {{$errors->first()}}
                            </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success"
                             role="alert">
                            <span class="alert-text text-white">
                                {{ session('success') }}
                            </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="content-name" class="form-control-label">{{ __('Content Name') }}</label>
                                <div class="@error('name') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Enter a Content Name"
                                           id="content-name" name="name">
                                    @error('name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="course-id" class="form-control-label">{{ __('Course') }}</label>
                                <div class="@error('course_id') border border-danger rounded-3 @enderror">
                                    <select class="form-control" id="course-id" name="course_id">
                                        <option value="" disabled selected>Select a Course</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="content-url" class="form-control-label">{{ __('Content URL') }}</label>
                                <div class="@error('url') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Enter the Content URL"
                                           id="content-url" name="url">
                                    @error('url')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="content-type" class="form-control-label">{{ __('Content Type') }}</label>
                                <div class="@error('type') border border-danger rounded-3 @enderror">
                                    <select class="form-control" id="content-type" name="type">
                                        <option value="" disabled selected>Select a Content Type</option>
                                        <option value="video">Video</option>
                                        <option value="document">Document</option>
                                    </select>
                                    @error('type')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">
                            {{ __('Save Changes') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

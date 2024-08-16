@extends('dashboard.layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Advertisement Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('admin.advertisements.update') }}" method="POST" enctype="multipart/form-data" role="form text-left">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
                             role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="advertisement-specialization"
                                       class="form-control-label">{{ __('Advertisement Specialization') }}</label>
                                <div
                                    class="@error('advertisement.specialization')border border-danger rounded-3 @enderror">
                                    <select class="form-control" type="text" name="specialization_id"
                                            id="advertisement-specialization" required>
                                        <option value="-1">-----</option>
                                        @foreach($specializations as $id => $name)
                                            <option value="{{ $id }}"
                                                    @if($ad->specialization_id === $id) selected @endif>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('specialization')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" type="hidden" name="id" value="{{ $ad->id }}">

                                <label for="advertisement-image"
                                       class="form-control-label">{{ __('Advertisement Image') }}</label>
                                <div class="@error('advertisement.image')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="file" value="{{ $ad->image }}"
                                           id="advertisement-image" name="image">
                                    @error('image')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="quiz-description"
                                       class="form-control-label">{{ __('Advertisement Description') }}</label>
                                <div
                                    class="@error('advertisement.description')border border-danger rounded-3 @enderror">
                                    <textarea class="form-control" id="advertisement-description" name="description">{{ $ad->description }}</textarea>
                                    @error('description')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">
                            {{ 'Save Changes' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

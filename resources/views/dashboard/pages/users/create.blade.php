@extends('dashboard.layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('User Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('admin.users.store') }}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                    <span class="alert-text text-white">
                        {{ $errors->first() }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success"
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
                                <label for="name" class="form-control-label">{{ __('Name') }}</label>
                                <div class="@error('name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Enter a Name" id="name"
                                           name="name">
                                    @error('name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('email') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="email" placeholder="Enter an Email" id="email"
                                           name="email">
                                    @error('email')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password" class="form-control-label">{{ __('Password') }}</label>
                                <div class="@error('password') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="password" placeholder="Enter a Password"
                                           id="password" name="password">
                                    @error('password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mobile_number" class="form-control-label">{{ __('Mobile Number') }}</label>
                                <div class="@error('mobile_number') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Enter a Mobile Number"
                                           id="mobile_number" name="mobile_number">
                                    @error('mobile_number')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="image" class="form-control-label">{{ __('Image') }}</label>
                                <div class="@error('image') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="file" placeholder="Enter an Image URL" id="image"
                                           name="image">
                                    @error('image')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender" class="form-control-label">{{ __('Gender') }}</label>
                                <div class="@error('gender') border border-danger rounded-3 @enderror">
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    @error('gender')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="birth_date" class="form-control-label">{{ __('Birth Date') }}</label>
                                <div class="@error('birth_date') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="date" placeholder="Enter a Birth Date"
                                           id="birth_date" name="birth_date">
                                    @error('birth_date')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country_id" class="form-control-label">{{ __('Country') }}</label>
                                <div class="@error('country_id') border border-danger rounded-3 @enderror">
                                    <select class="form-control" id="country_id" name="country_id">
                                        <option value="">Select a Country</option>
                                        @foreach($countries as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role_id" class="form-control-label">{{ __('Role') }}</label>
                                <div class="@error('role_id') border border-danger rounded-3 @enderror">
                                    <select class="form-control" id="role_id" name="role_id">
                                        <option value="">Select a Role</option>
                                        @foreach($roles as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
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

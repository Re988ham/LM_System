@extends('admin.layouts.base.guest.base')



@section('content')

    <section class="min-vh-100 mb-8">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg"
            style="background-image: url('../assets/img/picture.png');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                        <p class="text-lead text-white">Welcome to our Learning Management System.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Register with</h5>
                        </div>

                        <div class="card-body">
                            <form role="form text-left" method="POST" action="/register" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <div class="image-upload-container text-center">
                                        <input type="file" class="form-control d-none" name="image" id="imageUpload" accept="image/*">
                                        <label for="imageUpload" class="image-preview rounded-circle overflow-hidden d-flex justify-content-center"
                                               style="max-width: 150px; max-height: 150px; cursor: pointer; margin: 0 auto;">
                                            <img id="preview" src="{{ asset('images/profile.png') }}" alt="Image preview"
                                                 style="object-fit: cover; width: 100%; height: 100%;">
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Name" name="name"
                                        id="name" aria-label="Name" aria-describedby="name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email" name="email"
                                        id="email" aria-label="Email" aria-describedby="email-addon"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Password" name="password"
                                        id="password" aria-label="Password" aria-describedby="password-addon">
                                    @error('password')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="confirm_password"
                                        name="confirm_password" id="confirm_password" aria-label="confirm_password"
                                        aria-describedby="confirm_password">
                                    @error('confirm_password')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="mobile number"
                                        name="mobile_number" id="mobile_number" aria-label="mobile_number"
                                        aria-describedby="mobile_number" value="{{ old('mobile_number') }}">

                                    @error('mobile_number')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="address" name="address"
                                        id="address" aria-label="address" aria-describedby="address"
                                        value="{{ old('address') }}">
                                    @error('address')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3" style="display: inline">
                                    <label for="gender">Gender:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="male"
                                            value="male" {{ old('gender') === 'male' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="male">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="female"
                                            value="female" {{ old('gender') === 'female' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="female">
                                            Female
                                        </label>
                                    </div>
                                    @error('gender')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="date">Birth_Date:</label>
                                    <input type="date" class="form-control" placeholder="YYYY-MM-DD"
                                        name="birth_date" id="birth_date" aria-label="BirthDate"
                                        aria-describedby="birth_date" value="{{ old('date') }}">
                                    @error('birth_date')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-check form-check-info text-left">
                                    <input class="form-check-input" type="checkbox" name="agreement"
                                        id="flexCheckDefault" checked>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree the <a href="javascript:" class="text-dark font-weight-bolder">Terms
                                            and Conditions</a>
                                    </label>
                                    @error('agreement')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign
                                        up
                                    </button>
                                </div>
                                <p class="text-sm mt-3 mb-0">Already have an account?
                                    <a href="{{ route('signIn') }}" class="text-dark font-weight-bolder">
                                        Sign in
                                    </a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection




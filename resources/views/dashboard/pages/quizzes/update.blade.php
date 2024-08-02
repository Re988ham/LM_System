@extends('dashboard.layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Quiz Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('admin.quizzes.update') }}" method="POST" role="form text-left">
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
                        <input class="form-control" type="hidden" name="course_id" value="{{ $quiz->course_id }}">

                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" type="hidden" name="id" value="{{ $quiz->id }}">

                                <label for="quiz-title" class="form-control-label">{{ __('Quiz Title') }}</label>
                                <div class="@error('quiz.title')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" name="title" value="{{ $quiz->title }}"
                                           placeholder="Enter a Quiz Title" id="quiz-title">
                                    @error('title')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="question_number"
                                       class="form-control-label">{{ __('Questions Number') }}</label>
                                <div class="@error('quiz.question_number')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="number" value="{{ $quiz->question_number }}"
                                           placeholder="Enter The Number of Questions" id="question_number"
                                           name="question_number">
                                    @error('question_number')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{--                        <div class="col-md-12">--}}
                        {{--                            <div class="form-group">--}}
                        {{--                                <label for="quiz-description"--}}
                        {{--                                       class="form-control-label">{{ __('Quiz Description') }}</label>--}}
                        {{--                                <div class="@error('quiz.description')border border-danger rounded-3 @enderror">--}}
                        {{--                                    <textarea class="form-control" id="quiz-description" name="description">{{ $quiz->description }}</textarea>--}}
                        {{--                                    @error('description')--}}
                        {{--                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>--}}
                        {{--                                    @enderror--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
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

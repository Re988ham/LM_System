@extends('dashboard.layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Answer Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('admin.answers.store') }}" method="POST" role="form text-left">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">{{ $errors->first() }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">{{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <input class="form-control" type="hidden" name="question_id" value="{{ $questionId }}">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="answer-text" class="form-control-label">{{ __('Answer Text') }}</label>
                                <div class="@error('answer.text') border border-danger rounded-3 @enderror">
                                    <textarea class="form-control" id="answer-text" name="text"></textarea>
                                    @error('text')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="@error('is_correct') border border-danger rounded-3 @enderror align-center">
                                    <label for="is-correct" class="form-control-label">{{ __('Is Correct') }}</label>
                                    <button type="button" class="btn btn-secondary" id="is-correct-button" onclick="toggleIsCorrect()">
                                        {{ __('No') }}
                                    </button>
                                    <input type="hidden" id="is-correct" name="is_correct" value="0">
                                    @error('is_correct')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ __('Save Changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function toggleIsCorrect() {
            const button = document.getElementById('is-correct-button');
            const hiddenInput = document.getElementById('is-correct');
            if (hiddenInput.value == '0') {
                hiddenInput.value = '1';
                button.classList.remove('btn-secondary');
                button.classList.add('btn-success');
                button.textContent = '{{ __('Yes') }}';
            } else {
                hiddenInput.value = '0';
                button.classList.remove('btn-success');
                button.classList.add('btn-secondary');
                button.textContent = '{{ __('No') }}';
            }
        }
    </script>
@endsection

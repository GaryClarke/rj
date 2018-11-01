@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">

                    @if(!Auth::user()->profile_picture)

                        <div class="card-header">Please upload a profile picture</div>

                    @else

                        <div class="card-header">Update your profile picture</div>

                    @endif

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="/users" method="post" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group row">
                                <label for="profile_picture"
                                       class="col-sm-4 col-form-label text-md-right">{{ __('Profile Picture') }}</label>

                                <div class="col-md-6">
                                    <input id="profile_picture" type="file"
                                           class="form-control{{ $errors->has('profile_picture') ? ' is-invalid' : '' }}"
                                           name="profile_picture" value="{{ old('profile_picture') }}" required>

                                    @if ($errors->has('profile_picture'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profile_picture') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Upload') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if(Auth::user()->profile_picture)

                {{-- todo - add file path --}}
                <div class="col-md-4">
                    <img src="" style="max-width: 250px; max-height: 250px">
                </div>

            @endif
        </div>
    </div>
@endsection

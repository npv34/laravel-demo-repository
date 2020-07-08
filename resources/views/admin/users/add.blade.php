@extends('admin.master')
@section('content')
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item active">
            <a href="{{ route('admin.dashboard') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('users.index') }}">Users</a>
        </li>
        <li class="breadcrumb-item active">Add new</li>
    </ol>
    <div class="card-header"><i class="fas fa-table mr-1"></i></div>
    <div class="col-md-12 pt-4">
        <div class="card">
            <div class="card-header">
                Create user
            </div>
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
            <div class="card-body">
                <form method="post" action="{{ route('users.store') }}">
                    @csrf

                    @if($errors->all())
                    <div class="alert alert-danger" role="alert">
                        Có vấn đề khi tạo tài khoản người dùng.
                    </div>
                    @endif

                    <div class="form-group">
                        <label class="{{($errors->first('name')) ? 'text-danger' : ''}}">
                        <strong>Name</strong>
                        </label>
                        <input type="text" value="{{ old('name') }}" name="name" class="form-control {{($errors->first('name')) ? 'is-invalid' : ''}} ">
                        @if($errors->first('name'))
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="{{($errors->first('email')) ? 'text-danger' : ''}}">
                            <strong>Email</strong>
                        </label>
                        <input type="email" value="{{ old('email') }}" class="form-control {{($errors->first('email')) ? 'is-invalid' : ''}} " name="email">
                        @if($errors->first('email'))
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="{{($errors->first('password')) ? 'text-danger' : ''}}">
                            <strong>Password</strong>
                        </label>
                        <input type="password" value="{{ old('password') }}" class="form-control {{($errors->first('password')) ? 'is-invalid' : ''}} " name="password">
                        @if($errors->first('password'))
                            <p class="text-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="{{($errors->first('birthday')) ? 'text-danger' : ''}}">
                            <strong>Birthday</strong>
                        </label>
                        <input type="date" value="{{ old('birthday') }}" class="form-control {{($errors->first('birthday')) ? 'is-invalid' : ''}}" name="birthday">
                        @if($errors->first('birthday'))
                            <p class="text-danger">{{ $errors->first('birthday') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        @foreach($roles as $role)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="roles[{{$role->id}}]" value="{{$role->id}}"
                                       class="custom-control-input" id="role-{{$role->id}}">
                                <label class="custom-control-label" for="role-{{$role->id}}">{{ $role->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('admin.master')
@section('content')
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item active">
            <a href="{{ route('admin.dashboard') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">Users</li>
    </ol>
    <div class="card-header"><i class="fas fa-table mr-1"></i></div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="row">
                <div class="col-12 col-md-1">
                    <a href="{{ route('users.create') }}" class="btn btn-success mb-2">Create</a>
                </div>
                <div class="col-12 col-md-4">
                    <!-- Basic dropdown -->
                    <button class="btn btn-primary dropdown-toggle mr-4" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">See</button>

                    <div class="dropdown-menu">
                        <a class="dropdown-item">
                            <!-- Default unchecked -->
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input checkbox-info" data-id="data-name" id="checkbox-name" checked>
                                <label class="custom-control-label" for="checkbox-name">Name</label>
                            </div>
                        </a>
                        <a class="dropdown-item" href="#">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input checkbox-info" data-id="data-email"  id="checkbox-email" checked>
                                <label class="custom-control-label" for="checkbox-email">Email</label>
                            </div>
                        </a>
                        <a class="dropdown-item" href="#">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input checkbox-info" id="checkbox3" checked>
                                <label class="custom-control-label" for="checkbox3">Birthday</label>
                            </div>
                        </a>
                        <a class="dropdown-item" href="#">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkbox4" checked>
                                <label class="custom-control-label" for="checkbox4">Role</label>
                            </div>
                        </a>
                    </div>
                    <!-- Basic dropdown -->
                </div>
                <div class="col-12 col-md-7">
                        <input class="form-control mr-sm-2" id="search-user" type="search" placeholder="Search" aria-label="Search">
                        <ul id="ul-user"></ul>
                </div>
            </div>

            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>STT</th>
                    <th class="data-name">Name</th>
                    <th class="data-email">Email</th>
                    <th class="data-birthday">Birthday</th>
                    <th>Role</th>
                    <th></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>STT</th>
                    <th class="data-name">Name</th>
                    <th class="data-email">Email</th>
                    <th class="data-birthday">Birthday</th>
                    <th>Role</th>
                    <th></th>
                </tr>
                </tfoot>
                <tbody id="list-user">
                @forelse($users as $key => $user)
                    <tr class="data-user">
                        <td>{{ ++$key }}</td>
                        <td class="data-name">{{ $user->name }}</td>
                        <td class="data-email">{{ $user->email }}</td>
                        <td>{{ $user->birthday }}</td>
                        <td>
                            @forelse($user->roles as $role)
                                {{ $role->name . ',' }}
                            @empty

                            @endforelse
                        </td>
                        <td>
                            @if($user->id !== \Illuminate\Support\Facades\Auth::id())
                            <a href="{{ route('users.edit', $user->id) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a onclick="return confirm('ban chac chan muon xoa?')"
                               href="{{ route('users.delete', ['id' => $user->id] ) }}" style="color: red">
                                <i class="fa fa-trash"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

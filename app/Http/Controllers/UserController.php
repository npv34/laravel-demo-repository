<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Services\UserService;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        if (!Gate::allows('crud-user')) {
            abort(403);
        }
        $users = $this->userService->getAll();
        return view('admin.users.list', compact('users'));
    }

    public function create()
    {
        if (!Gate::allows('crud-user')) {
            abort(403,'Khong co quyen');
        }
        $roles = Role::all();
        return view('admin.users.add', compact('roles'));
    }

    public function store(CreateUserRequest $request)
    {
        if (!Gate::allows('crud-user')) {
            abort(403);
        }
        $this->userService->create($request);
        toastr()->success('create user success!');
        return redirect()->route('users.index');
    }

    public function delete($id)
    {
        if (!Gate::allows('crud-user')) {
            abort(403);
        }
        $user = $this->userService->findById($id);
        $user->roles()->detach();
        $this->userService->delete($user);
        toastr()->success('delete user success!');
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        if (!Gate::allows('crud-user')) {
            abort(403);
        }
        $user = $this->userService->findById($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (!Gate::allows('crud-user')) {
            abort(403);
        }
        $user = $this->userService->findById($id);
        $this->userService->update($user, $request);
        toastr()->success('update user success!');
        return redirect()->route('users.index');
    }

    public function getPostsByUser($userId)
    {
        $user = $this->userService->findById($userId);
        $posts = $user->posts;
    }

    public function search(Request $request)
    {
        $users = User::where('name','LIKE', '%' . $request->keyword . '%')
                        ->orWhere('email', 'LIKE', '%' . $request->keyword . '%')
            ->with('roles')->get();

        return response()->json($users);
    }
}

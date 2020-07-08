<?php


namespace App\Http\Services;


use App\Http\Repositories\UserRepository;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    function getAll()
    {
        return $this->userRepo->getAllUser();
    }

    function create($request)
    {
        //DB::beginTransaction();
        //try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->email;
            $user->birthday = $request->birthday;
            $user->password = Hash::make($request->password);
            $user->save();
            foreach ($request->roles as $key => $role) {
                $user->roles()->attach($key);
            }
//            DB::commit();
//        }catch (\Exception $exception) {
//           DB::rollBack();
//           return $exception->getMessage();
//        }
    }

    function findById($id)
    {
        return $this->userRepo->find($id);
    }

    function delete($user)
    {
        $this->userRepo->destroy($user);
    }

    function update($user, $request)
    {
        $user->name = $request->name;
        $user->birthday = $request->birthday;
        $user->role = $request->role;
        $this->userRepo->save($user);
    }

}

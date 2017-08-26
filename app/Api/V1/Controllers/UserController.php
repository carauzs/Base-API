<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Transformers
use App\Api\V1\Transformers\UserTransformer;

//Validators
use App\Api\V1\Validators\User\CreateUserRequest;
use App\Api\V1\Validators\User\UpdateUserRequest;

// Models
use App\Models\User;

class UserController extends Controller
{
    public function listUsers(Request $request)
    {
        $users = User::query();
        if ($request->has('q')) {
            $users->search($request->input('q'));
        }
        $total = $users->count();
        if ($request->has('limit')) {
            $users->limit($request->input('limit'));
        }
        if ($request->has('skip')) {
            $users->skip($request->input('skip'));
        }
        $users->orderBy('name');
        $users = $users->get();
        $include = explode(',', $request->input('include'));
        return $this->collection($users, new UserTransformer, $include, [
            'total' => $total
        ]);
    }

    public function getUser(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        $include = explode(',', $request->input('include'));
        return $this->item($user, new UserTransformer, $include);
    }


    public function createUser(CreateUserRequest $request)
    {
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return $this->response->created($user->id);
    }

    public function updateUser(UpdateUserRequest $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        if ($request->has('name')) {
            $user->name = $request->input('name');
        }
        if ($request->has('email')) {
            $user->email = $request->input('email');
        }
        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();
        return $this->success();
    }

    public function deleteUser(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();
        return $this->success();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use App\District;

class UsersController extends Controller{
    public function index(){
        abort_unless(\Gate::allows('user_access'), 403);

        $users = User::when(auth()->user()->roles->first()->id != 1, function($q){
            return $q->where('id', '!=', 1);
        })->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        abort_unless(\Gate::allows('user_create'), 403);

        $roles = Role::when(auth()->user()->roles->first()->id != 1, function($q){
            return $q->where('id', '!=', 1);
        })->get()->pluck('title', 'id');
        $district_list = District::all();

        return view('admin.users.create', compact('roles', 'district_list'));
    }

    public function store(StoreUserRequest $request){
        abort_unless(\Gate::allows('user_create'), 403);

        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user){
        abort_unless(\Gate::allows('user_edit'), 403);

        $roles = Role::when(auth()->user()->roles->first()->id != 1, function($q){
            return $q->where('id', '!=', 1);
        })->get()->pluck('title', 'id');
        $district_list = District::all();

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user', 'district_list'));
    }

    public function update(UpdateUserRequest $request, User $user){
        abort_unless(\Gate::allows('user_edit'), 403);

        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user){
        abort_unless(\Gate::allows('user_show'), 403);

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user){
        abort_unless(\Gate::allows('user_delete'), 403);

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request){
        User::whereIn('id', request('ids'))->delete();

        return response(NULL, 204);
    }
}

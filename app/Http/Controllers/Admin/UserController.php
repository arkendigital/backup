<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create user|edit user|delete user']);
    }


    /**
     * Show an index of users.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $filter = request()->filter;

        $users = User::all();

        $letters = [];
        foreach ($users as $user) {
            $letters[] = $user->first_letter;
        }
        sort($letters);
        $letters = array_unique($letters);

        if ($filter) {
            $users = $users->filter(function ($user) use ($filter) {
                if ($user->first_letter == strtoupper($filter)) {
                    return $user;
                }
            })->sortBy(function($user) {
                return $user->name;
            })->paginate(20);
        } else {
            $users = $user->all()->map(function($user) {
                return $user;
            })->paginate(20);
        }

        return view('admin.users.index', compact(['users', 'letters']));
    }

    /**
     * Display a user record.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Display a form to create a user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Role $role)
    {
        $roles = $role->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a user in the database.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        if (User::where('email', $request->email)->exists()) {
            alert()->error('A user with this email address already exists');

            return back();
        }

        $user->registerUser($request->name, $request->email, $request->password);

        $user->update([
                    'verified' => (bool) $request->verified ? 1 : 0,
                ]);

        if ($request->role) {
            $user->syncRoles();
            $user->assignRole($request->role);
        } else {
            $user->assignRole('Member');
        }

        alert()->success($request->name.' has been created.');

        return redirect(route('users.index'));
    }

    /**
     * Display an edit view.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Role $role)
    {
        $roles = $role->all();
        return view('admin.users.edit', compact(['user', 'roles']));
    }

    /**
     * Update a user record.
     *
     * @param Request $request
     * @param User    $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->role) {
            $user->syncRoles();
            $user->assignRole($request->role);
        } else {
            $user->assignRole('Member');
        }

        $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'verified' => (bool) $request->verified ? 1 : 0,
                ]);
        alert()->success('Account Updated');

        return back();
    }

    /**
     * Delete a user record.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        alert()->success('User deleted.');

        return back();
    }

    public function resetPassword(Request $request)
    {
        return view('admin.users.reset_password');
    }

    public function processResetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!password_verify($request->password, auth()->user()->password)) {
            alert()->error('The password you entered doesn\'t match your current password');

            return back();
        }

        $user = auth()->user();

        $user->update(['password' => bcrypt($request->new_password)]);
        alert()->success('Your password has been updated.');

        return back();
    }

    public function banUser(User $user)
    {
        if (!auth()->user()->isStaff()) {
            alert()->error('You do not have permission to ban users');
            return back();
        }

        if ($user->banned == 1) {
            $user->update([
                'banned' => 0
            ]);
            alert()->success('User unbanned');
        } else {
            $user->update([
                'banned' => 1
            ]);
            alert()->success('User banned');
        }

        return back();
    }
}

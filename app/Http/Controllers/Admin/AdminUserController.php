<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Controller for managing users in the admin panel, allowing administrators to view, create, edit, and delete users.
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['users'] = User::all();

        return view('admin.user.index')->with('viewData', $viewData);
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'balance' => $request->input('balance', 0),
            'role' => $request->input('role'),
        ]);

        return redirect()->route('admin.user.index')->with('success', __('messages.admin.success_user_created'));
    }

    public function edit(int $user): View
    {
        $viewData = [];
        $viewData['user'] = User::findOrFail($user);

        return view('admin.user.edit')->with('viewData', $viewData);
    }

    public function update(StoreUserRequest $request, int $user): RedirectResponse
    {
        $userModel = User::findOrFail($user);
        $userModel->setName($request->input('name'));
        $userModel->setEmail($request->input('email'));
        if ($request->filled('password')) {
            $userModel->setPassword(bcrypt($request->input('password')));
        }
        $userModel->setBalance($request->input('balance', 0));
        $userModel->setRole($request->input('role'));
        $userModel->save();

        return redirect()->route('admin.user.index');
    }

    public function destroy(int $user): RedirectResponse
    {
        User::destroy($user);

        return redirect()->route('admin.user.index')->with('success', __('messages.admin.success_user_deleted'));
    }
}

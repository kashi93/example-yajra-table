<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Datatables;

class UserController extends Controller
{
    public function userDataTable(Request $request)
    {
        return Datatables::of(User::query())
            ->filter(function ($query) use ($request) {
                $query->where('id', $request->input('search')['value'])
                    ->orWhere('name', 'like', "%" . $request->input('search')['value'] . "%")
                    ->orWhere('email', 'like', "%" . $request->input('search')['value'] . "%")
                    ->orWhereHas('posts', function ($query) use ($request) {
                        $query->where('title', 'like', "%" . $request->input('search')['value'] . "%");
                    });
            })
            ->editColumn('name', function (User $user) {
                return view('user', compact('user'));
            })
            ->setRowClass('{{ $id % 2 == 0 ? "alert-success" : "alert-warning" }}')
            ->editColumn('created_at', function (User $user) {
                return $user->created_at->format('d/m/Y');
            })
            ->editColumn('updated_at', function (User $user) {
                return $user->created_at->format('d/m/Y');
            })
            ->editColumn('post_count', function (User $user) {
                return $user->posts()->count();
            })
            ->make(true);
    }
}

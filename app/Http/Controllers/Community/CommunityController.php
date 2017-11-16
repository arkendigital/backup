<?php

namespace App\Http\Controllers\Community;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommunityController extends Controller
{
    public function index(User $user)
    {
        $this->seo()->setTitle('Our Community');

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
            })->paginate(20);
        } else {
            $users = $user->all()->map(function($user) {
                return $user;
            })->paginate(20);
        }

        return view('community.index', compact('users', 'letters'));
    }
}

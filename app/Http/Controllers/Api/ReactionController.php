<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function store(Request $request)
    {
        $user_id = $request->input('user_id');
        $post_id = $request->input('post_id');

        $reaction = Reaction::where(['user_id' => $user_id, 'post_id' => $post_id])->first();
        if (!$reaction) {
            $reaction = new Reaction($request->all());
            $reaction->save();
            echo json_encode($reaction);
            // Event::fire( new ReactionCreated() );
        } else {
            echo json_encode('err');
        }
    }
}

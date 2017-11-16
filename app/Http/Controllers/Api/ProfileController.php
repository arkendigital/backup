<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Storage;

class ProfileController extends Controller
{
    /**
     * Instantiate a new instance of Api\\ProfileController
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store an avatar
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAvatar()
    {
        $this->validate(request(), [
            'avatar'    => ['required', 'image', 'max:2048']
        ]);

        $avatarPath = request()->file('avatar')->store('avatars/'.auth()->user()->id, 'public');

        if (request()->file('avatar')->getClientOriginalExtension() != 'gif') {
            $avatar = Image::make(storage_path('app/public/'.$avatarPath))->fit(640, 640)->encode();
            $avatar = Storage::put($avatarPath, $avatar);
        }

        auth()->user()->profile()->update([
            'avatar_path'   => $avatarPath
        ]);

        if (request()->expectsJson()) {
            return response([], 204);
        }

        return back();
    }

    /**
     * Store a cover photo
     *
     * @return \Illuminate\Http\Response
     */
    public function storeCover()
    {
        $this->validate(request(), [
            'cover'    => ['required', 'image', 'max:4096']
        ]);

        $coverPath = request()->file('cover')->store('covers/'.auth()->user()->id, 'public');

        if (request()->file('cover')->getClientOriginalExtension() != 'gif') {
            $cover = Image::make(storage_path('app/public/'.$coverPath))->fit(1400, 500)->encode();
            $cover = Storage::put($coverPath, $cover);
        }

        auth()->user()->profile()->update([
            'cover_photo_path'   => $coverPath
        ]);

        if (request()->expectsJson()) {
            return response([], 204);
        }

        return back();
    }
}

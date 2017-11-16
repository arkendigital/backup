<?php

namespace App\Http\Controllers\Utilities;

use App\Forum;
use App\ForumThread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RedirectController extends Controller
{
    public function handle($network, $username)
    {
        switch ($network) {
            case 'twitter':
                return redirect()->to('https://twitter.com/'.$username);
                break;
            case 'steam':
                return redirect()->to('https://steamcommunity.com/id/'.$username);
                break;
            case 'twitch':
                return redirect()->to('https://twitch.tv/'.$username);
                break;
            case 'youtube':
                return redirect()->to('https://youtube.com/u/'.$username);
                break;

            default:
                alert('You have upset the delicate balance of my internal housekeeper')->persistent('I\'m sorry!');
                return redirect()->route('index');
                break;
        }
    }

    public function handleFilesNationTopic($slug, $page=null)
    {
        if (empty($slug)) {
            alert('You have upset the delicate balance of my internal housekeeper')->persistent('I\'m sorry!');
            return redirect()->route('index');
        }

        $thread = ForumThread::select(['id', 'forum_id', 'slug'])->with('forum')->where('slug',$slug)->first();
        if (!$thread) {
            alert('You have upset the delicate balance of my internal housekeeper')->persistent('I\'m sorry!');
            return redirect()->route('index');
        }
        return redirect()->route('showThread', [$thread->forum, $thread]);
    }

    public function handleFilesNationForum($slug, $page=null)
    {
        if (empty($slug)) {
            alert('You have upset the delicate balance of my internal housekeeper')->persistent('I\'m sorry!');
            return redirect()->route('index');
        }

        $forum = Forum::select(['id', 'slug'])->where('slug',$slug)->first();
        if (!$forum) {
            alert('You have upset the delicate balance of my internal housekeeper')->persistent('I\'m sorry!');
            return redirect()->route('index');
        }
        return redirect()->route('forumDisplay', $forum);
    }
}

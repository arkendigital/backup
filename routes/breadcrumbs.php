<?php

// Home
Breadcrumbs::register('index', function($breadcrumbs)
{
    $name = Setting::get('site_name') ?? env('APP_NAME');
    $breadcrumbs->push($name, route('index'));
});

// Home > Articles
Breadcrumbs::register('articles', function($breadcrumbs)
{
    $breadcrumbs->parent('index');
    $breadcrumbs->push('Articles');
});

// Home > Search > Popular Posts
Breadcrumbs::register('forumPopular', function($breadcrumbs)
{
    $breadcrumbs->parent('forumIndex');
    $breadcrumbs->push('Popular Posts');
});

// Home > Search > Latest Posts
Breadcrumbs::register('forumLatest', function($breadcrumbs)
{
    $breadcrumbs->parent('forumIndex');
    $breadcrumbs->push('Latest Posts');
});

// Home > Forum
Breadcrumbs::register('forumIndex', function($breadcrumbs)
{
    $breadcrumbs->parent('index');
    $breadcrumbs->push('Forum', route('forumIndex'));
});

// Home > Forums > [Forum]
Breadcrumbs::register('forumDisplay', function($breadcrumbs, $forum)
{
    $breadcrumbs->parent('forumIndex');
    $breadcrumbs->push($forum->category->name, route('forumIndex'));
    $breadcrumbs->push($forum->name, route('forumDisplay', $forum->slug));
});

// Home > Forums > [Forum] > Create Thread
Breadcrumbs::register('threadCreate', function($breadcrumbs, $forum)
{
    $breadcrumbs->parent('forumIndex');
    $breadcrumbs->push($forum->name, route('forumDisplay', $forum->slug));
    $breadcrumbs->push('Create Thread');
});

// Home > Forums > [Forum] > [Thread]
Breadcrumbs::register('showThread', function($breadcrumbs, $forum, $thread)
{
    $breadcrumbs->parent('forumDisplay', $forum);
    $breadcrumbs->push($thread->title);
});

// Home > Forums > [Forum] > [Thread] > Edit Post
Breadcrumbs::register('editPost', function($breadcrumbs, $forum, $thread)
{
    $breadcrumbs->parent('forumDisplay', $forum);
    $breadcrumbs->push($thread->title, route('showThread', [$forum, $thread]));
    $breadcrumbs->push('Editing Reply');
});

// Home > Community > Members
Breadcrumbs::register('memberList', function($breadcrumbs)
{
    $breadcrumbs->parent('index');
    $breadcrumbs->push('Community');
    // $breadcrumbs->push($user->profile->display_name);
});

// Home > [User]
Breadcrumbs::register('me', function($breadcrumbs, $profile)
{
    $breadcrumbs->parent('index');
    $breadcrumbs->push($profile->display_name);
});

// Home > User Control Panel
Breadcrumbs::register('myAccount', function($breadcrumbs)
{
    $breadcrumbs->parent('index');
    $breadcrumbs->push('User Control Panel');
});

// Home > User Control Panel > Edit Account
Breadcrumbs::register('accountEdit', function($breadcrumbs)
{
    $breadcrumbs->parent('myAccount');
    $breadcrumbs->push('Edit Account');
});

// Home > User Control Panel > Edit Profile
Breadcrumbs::register('profileEdit', function($breadcrumbs)
{
    $breadcrumbs->parent('myAccount');
    $breadcrumbs->push('Edit Profile');
});


// Home > User Control Panel > Conversations
Breadcrumbs::register('messageIndex', function($breadcrumbs)
{
    $breadcrumbs->parent('myAccount');
    $breadcrumbs->push('Conversations', route('messageIndex'));
});

// Home > User Control Panel > Conversations > [Message]
Breadcrumbs::register('messageView', function($breadcrumbs, $message)
{
    $breadcrumbs->parent('messageIndex');
    $breadcrumbs->push($message->subject, route('messageView', $message));
});

// Home > User Control Panel > Conversations > New Conversation
Breadcrumbs::register('messageCreate', function($breadcrumbs)
{
    $breadcrumbs->parent('messageIndex');
    $breadcrumbs->push('New Conversation', route('messageCreate'));
});

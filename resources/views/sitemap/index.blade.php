<?xml version="1.0" encoding="UTF-8"?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @for ($i = 0; $i < $pagePages; $i++)
    <sitemap>
        <loc>{{ route('sitemap.pages', $i) }}</loc>
        <lastmod>{{ $page->created_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    @endfor
    @for ($i = 0; $i < $jobPages; $i++)
    <sitemap>
        <loc>{{ route('sitemap.jobs', $i) }}</loc>
        <lastmod>{{ $job->created_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    @endfor
    @for ($i = 0; $i < $discussionPages; $i++)
    <sitemap>
        <loc>{{ route('sitemap.discussions', $i) }}</loc>
        <lastmod>{{ $discussion->created_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    @endfor
    @for ($i = 0; $i < $examPages; $i++)
    <sitemap>
        <loc>{{ route('sitemap.exam.categories', $i) }}</loc>
        <lastmod>{{ $examCategory->created_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    @endfor
</sitemapindex>

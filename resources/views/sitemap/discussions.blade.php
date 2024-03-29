<?xml version="1.0" encoding="UTF-8"?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($discussions as $discussion)
        <url>
            <loc>{{route('discussion.view', [$discussion->category, $discussion])}}</loc>
            <lastmod>{{ $discussion->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach
</urlset>

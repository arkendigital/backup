{{ Debugbar::disable() }}
<?xml version="1.0" encoding="UTF-8"?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ env("APP_URL") }}</loc>
        <lastmod>{{ $pages->first()->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    @foreach ($pages as $page)
        <url>
            <loc>{{ env("APP_URL") . "/" . $page->slug }}</loc>
            <lastmod>{{ $page->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach
	@foreach ($jobs as $job)
        <url>
            <loc>{{ env("APP_URL") . "/" . $job->slug }}</loc>
            <lastmod>{{ $job->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach
	@foreach ($discussions as $discussion)
        <url>
            <loc>{{ env("APP_URL") . "/" . $discussion->slug }}</loc>
            <lastmod>{{ $discussion->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach
	@foreach ($exam_categories as $exam_category)
        <url>
            <loc>{{ env("APP_URL") . "/" . $exam_category->slug }}</loc>
            <lastmod>{{ $exam_category->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach
</urlset>

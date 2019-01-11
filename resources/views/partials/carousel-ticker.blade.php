<div class='marquee'>
    <div class='marquee-text'>
        @foreach (json_decode($page->section->getField("exams", "exam_carousel")) as $item)
            <span>{{ $item }}</span>
        @endforeach
    </div>
</div>

@push("scripts-after")
    <script>
    var marquee = $('div.marquee');
    marquee.each(function() {
        var mar = $(this),indent = mar.width();
        mar.marquee = function() {
            indent--;
            mar.css('text-indent',indent);
            if (indent < -1 * mar.children('div.marquee-text').width()) {
                indent = mar.width();
            }
        };
        mar.data('interval',setInterval(mar.marquee,400/60));
    });
    </script>
@endpush

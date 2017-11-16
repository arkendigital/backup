@if (count($breadcrumbs))
<section class="subnav subnav__alt">
    <div class="subnav__container">
        <nav class="breadcrumbs">
            <ul class="breadcrumbs__menu">
                @foreach ($breadcrumbs as $breadcrumb)
                <li class="breadcrumbs__item">
                    <a href="{{ $breadcrumb->url }}" class="breadcrumbs__link">{{ $breadcrumb->title }}</a>
                </li>
                @endforeach
            </ul>
        </nav>
        <div class="search">
            <form action="" method="GET">
                <input class="search__input" type="text" name="q" id="q" placeholder="Type to search">
            </form>
        </div>
    </div>
</section>

@endif

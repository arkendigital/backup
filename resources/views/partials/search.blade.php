<div class="search">
    <div class="search__inner">
        <form action="{{ route('search') }}" method="">

            <p class="search__title">Search</p>

            <input type="text" class="search__input" placeholder="Start typing your search..." name="q" required>


            <i class="fas fa-times-circle search__close" title="Close Search"></i>
            <button class="search__button">Search</button>

        </form>
    </div>
</div>

<template>
<div>
    <div class="page-header">
        <a class="button icon u-pull-right" style="font-size: 2rem;">
            <i class="fa fa-upload"></i> Upload File
        </a>

        <a class="button icon u-pull-right" style="font-size: 2rem;" v-if="showFilters == false" @click="showFilters = true">
            <i class="fa fa-sliders"></i> Filters
        </a>

        <div class="u-pull-right" style="padding-top: 0; padding-left: 0;" v-if="showFilters == false">
            <select v-model="sortBy" @change="applySortBy(sortBy)" class="form__input">
                <option disabled selected :value="this.sortBy">Sort By</option>
                <option value="name">Name</option>
                <option value="created">Created</option>
                <option value="updated">Updated</option>
            </select><!-- 
            <select v-model="order" @change="applySortBy(sortBy)" class="form__input">
                <option value="asc">Oldest First</option>
                <option value="desc">Newest First</option>
            </select> -->
        </div>
        
        <h1>Latest Files</h1>
    </div>
    <div class="row">
        <div v-if="showFilters">
            <div class="box">
                <span class="box__title">Filter by Game &amp; Category</span>
                <div class="box__content">
                    <div class="col-6">
                        <label for="game_id">Game: </label>
                        <select name="game_id" id="game_id" class="form__input" v-model="selectedGame" @change="fetchCategoriesForGame(selectedGame)">
                            <option v-for="game in games" :value="game.id">{{game.title}}</option>
                        </select>
                    </div>
                    <div class="col-6" v-if="showCategoryList">
                        <label for="category_id">Category: </label>
                        <select name="category_id" id="category_id" class="form__input" v-model="selectedCategory" @change="applyFilters()">
                            <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            games: '',
            categories: '',
            selectedGame: '',
            selectedCategory: '',
            showFilters: false,
            showCategoryList: false,
            sortBy: '',
            order: 'desc'
        };
    },

    mounted() {
        console.log('mounted');
        this.fetchGames();
    },

    methods: {
        fetchGames() {
            axios.get('/api/games')
                .then(({data}) => {
                    this.games = data;
                });
        },
        fetchCategoriesForGame(gameId) {
            axios.get('/api/games/'+gameId+'/categories')
                .then(({data}) => {
                    this.showCategoryList = true;
                    this.categories = data;
                });
        },
        applyFilters() {
            let endpoint = window.location.origin + window.location.pathname;
            window.location.href = endpoint + '?game='+this.selectedGame+'&cat='+this.selectedCategory;
        },
        applySortBy(sortBy) {
            let endpoint = window.location.origin + window.location.pathname +'?sortBy='+sortBy+'&order='+this.order;
            window.location.href = endpoint;
        }
    }
}
</script>

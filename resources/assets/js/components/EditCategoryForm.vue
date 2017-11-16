<template>
    <div class="box-body">
        <div class="form-group">
            <label>Category Name</label>
            <input type="text" class="form-control" v-model="category.name">
        </div>

        <div class="form-group">
            <label for="game_id">Game</label>
            <select v-model="gameId" class="form-control" @change="fetchCategories(gameId)">
                <option value="0" selected>No Game</option>
                <option v-for="game in games" :value="game.id">
                    {{ game.title }}
                </option>
            </select>
        </div>

        <div class="form-group" v-if="showCategoryList">
            <label for="parent">Parent Category</label>
            <select v-model="categoryId" class="form-control">
                <option value="0" selected>No Parent Category</option>
                <option v-for="cat in categories" :value="cat.id">
                    {{ cat.name }}
                </option>
            </select>
        </div>

        <div class="checkbox">
            <label for="active">
                <input type="checkbox" name="active" id="active" :checked="this.category.active"> Active?
            </label>
        </div>

        <div class="form-group">
            <button class="btn btn-primary" @click="updateCategory()">Update</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['cat'],

        data() {
            return {
                category: this.cat,
                gameId: this.cat.game_id,
                categoryId: this.cat.parent,
                games: this.fetchGames(),
                categories: this.fetchCategories(this.cat.game_id),
                showGameList: true,
                showCategoryList: true
            }
        },

        mounted() {
            console.log('mounted');
        },

        methods: {
            fetchGames() {
                axios.get(window.App.homeUrl + '/api/games')
                    .then(({data}) => {
                        this.games = data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            fetchCategories(gameId) {
                this.showCategoryList = false;
                axios.get(window.App.homeUrl + '/api/games/' + gameId + '/categories')
                    .then(({data}) => {
                        this.showCategoryList = true;
                        this.categories = data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            updateCategory() {
                let data = {
                    'name': this.cat.name,
                    'game_id': this.cat.game_id,
                    'parent': this.cat.parent,
                    'active': this.cat.active,
                };
                let endpoint = window.App.homeUrl + location.pathname;
                endpoint = endpoint.replace('/edit', '');
                axios.patch(endpoint, data)
                    .then(({data}) => {
                        swal('Category Updated!');
                        window.location.href = data.redirect;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        }
    }
</script>

<style>

</style>

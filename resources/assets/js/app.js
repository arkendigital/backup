require('./bootstrap');

Vue.component('avatar-form', require('./components/AvatarForm.vue'));
Vue.component('edit-file-category-form', require('./components/EditCategoryForm.vue'));
Vue.component('rating-form', require('./components/RatingForm.vue'));
Vue.component('filters', require('./components/Filters.vue'));

const app = new Vue({
    el: '#app'
});

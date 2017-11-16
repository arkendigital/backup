<template>
    <div>
        <div class="box profile__header" :style="{ backgroundImage: 'url(' + cover + ')' }">
            <div class="profile__avatar" :style="{ backgroundImage: 'url(' + avatar + ')' }"></div>
            <div class="profile__name"><h2 v-text="this.user.profile.display_name"></h2>
                <p class="profile__usertitle" v-text="this.user.profile.user_title"></p>
            </div>
        </div>

        <hr>

        <vue-simple-spinner v-if="showSpinner"></vue-simple-spinner>

        <div class="form__group">
            <form v-show="showAvatarUpload" v-if="canUpdate" method="POST" role="form" enctype="multipart/form-data">
                <label for="avatar">Upload Avatar</label>
                <image-upload name="avatar" id="avatar" @loaded="onLoad"></image-upload>
            </form>
        </div>

        <div class="form__group">
            <form v-show="showCoverUpload" v-if="canUpdate" method="POST" role="form" enctype="multipart/form-data">
                <label for="avatar">Upload Cover Photo</label>
                <image-upload name="cover" id="cover" @loaded="onLoadCover"></image-upload>
            </form>
        </div>

    </div>
</template>

<script>
    import ImageUpload from './ImageUpload.vue';
    import Spinner from 'vue-simple-spinner'
    export default {
        props: ['user'],

        components: { ImageUpload, Spinner },

        data() {
            return {
                avatar: this.user.profile.avatar,
                cover: this.user.profile.cover,
                showAvatarUpload: true,
                showCoverUpload: true,
                showSpinner: false
            }
        },

        computed: {
            canUpdate() {
                return this.authorize(user => user.id === this.user.id);
            }
        },

        methods: {
            onLoad(avatar) {

                console.log(this.user);

                this.avatar = avatar.src;

                this.showSpinner = true;
                this.showAvatarUpload = false;
                this.persist(avatar.file);
            },

            persist(avatar) {

                let data = new FormData();

                data.append('avatar', avatar);

                axios.post(`/api/profile/${this.user.profile.slug}/avatar`, data)
                    .then(() => {
                        swal('Avatar Uploaded')
                        this.showSpinner = false;
                        this.showAvatarUpload = true;
                    })
                    .catch(function (error) {
                        console.log(error);
                        this.showSpinner = false;
                        this.showAvatarUpload = true;
                        swal('Whoops!', 'Something went wrong with that. Please check the filesize and try again?', 'warning');
                    });

            },

            onLoadCover(cover) {

                console.log(this.user);

                this.cover = cover.src;

                this.showCoverUpload = false;
                this.showSpinner = true;

                this.persistCover(cover.file);
            },

            persistCover(cover) {

                let data = new FormData();

                data.append('cover', cover);

                axios.post(`/api/profile/${this.user.profile.slug}/cover`, data)
                    .then(() => {
                        swal('Cover Photo Uploaded');
                        this.showSpinner = false;
                        this.showCoverUpload = true;
                    })
                    .catch(function (error) {
                        console.log(error);
                        this.showSpinner = false;
                        this.showCoverUpload = true;
                        swal('Whoops!', 'Something went wrong with that. Please check the filesize and try again?', 'warning');
                    });

            }
        }
    }
</script>

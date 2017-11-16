<template>
    <div>
        <div>
            <p class="post__xp"><strong>{{rating.score}}</strong>%</p>
        </div>
        <div class="rating positive" @click="thumbsUp()" :class="{ disabled : this.hasRated == true }">
            <i class="fa fa-thumbs-up fa-4x"></i>
            <p><small>{{rating.thumbsUp}}</small></p>
        </div>
        <div class="rating negative" @click="thumbsDown()" :class="{ disabled : this.hasRated == true }">
            <i class="fa fa-thumbs-down fa-4x"></i>
            <p><small>{{rating.thumbsDown}}</small></p>
        </div>
    </div>
</template>

<script>
export default {
    props: ['file'],

    mounted() {
        console.log('mounted for ' + this.file);
    },

    data() {
        return {
            'rating': {
                'thumbsUp': this.fetchThumbsUp(),
                'thumbsDown': this.fetchThumbsDown(),
                'score': this.fetchScore(),
            },
            'hasRated': this.userHasRated()
        }
    },

    methods: {
        thumbsUp() {
            if (this.hasRated == false) {
                axios.post('/api/files/'+this.file+'/thumbUp')
                    .then((data) => {
                        this.hasRated = true;
                        this.rating.thumbsUp = this.fetchThumbsUp();      
                        this.rating.thumbsDown = this.fetchThumbsDown();                        
                        this.rating.score = this.fetchScore();  
                    })
                    .catch(response => {
                        swal('Whoops, something went wrong. Please refresh the page and try again');
                    });
            }
        },
        thumbsDown() {
            if (this.hasRated == false) {
                axios.post('/api/files/'+this.file+'/thumbDown')
                    .then((data) => {
                        this.hasRated = true;
                        this.rating.thumbsUp = this.fetchThumbsUp();
                        this.rating.thumbsDown = this.fetchThumbsDown();                        
                        this.rating.score = this.fetchScore();                        
                    })
                    .catch(response => {
                        swal('Whoops, something went wrong. Please refresh the page and try again');
                    });
            }
        },
        fetchScore() {
            axios.get('/api/files/ratings/'+this.file+'?type=score')
                .then(({data}) => {
                    this.rating.score = data;
                });
        },
        fetchThumbsUp() {
            axios.get('/api/files/ratings/'+this.file+'?type=thumbsUp')
                .then(({data}) => {
                    this.rating.thumbsUp = data;
                });
        },
        fetchThumbsDown() {
            axios.get('/api/files/ratings/'+this.file+'?type=thumbsDown')
                .then(({data}) => {
                    this.rating.thumbsDown = data;
                });
        },
        userHasRated() {
            axios.get('/api/files/'+this.file+'/hasRated')
                .then(({data}) => {
                    if (data == 1) {
                        this.hasRated = true;
                    } else {
                        this.hasRated = false;
                    }
                });
        }
    }

}
</script>

<style scoped>
    .rating {
        width: 50%;
        text-align: center;
        float: left;
        cursor: pointer;
    }
    .rating.positive i {
        color: hsl(70, 70%, 55%);
    }
    .rating.negative i {
        color: hsl(340, 70%, 45%);
    }
    .rating.disabled {
        cursor: not-allowed !important;
    }
    .rating.disabled i {
        color: hsla(0, 0%, 0%, 0.5);
    }
</style>

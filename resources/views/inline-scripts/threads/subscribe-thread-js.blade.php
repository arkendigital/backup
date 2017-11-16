<script>
    $('#subscribe-thread-{{$thread->id}}').on('click', function(){
        swal({
            text: 'Are you sure you want to be notified when this thread is updated?',
            button: {
                text: "Subscribe"
            },
        })
        .then(content => {
            if (!content) throw null;
            axios.post('{{url($thread->url())}}/subscriptions');
        })
        .then(() => {
            swal("You are now subscribed to this thread!", {
                icon: "success",
            });
            $('#subscribe-thread-{{$thread->id}}').hide();
        });
    });
</script>

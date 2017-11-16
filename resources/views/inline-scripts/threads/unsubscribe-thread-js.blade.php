<script>
    $('#unsubscribe-thread-{{$thread->id}}').on('click', function(){
        swal({
            text: 'Are you sure you want to unsubscribe from this thread?',
            button: {
                text: "Unsubscribe"
            },
        })
        .then(content => {
            if (!content) throw null;
            axios.delete('{{url($thread->url())}}/subscriptions');
        })
        .then(() => {
            swal("You are now unsubscribed from this thread!", {
                icon: "success",
            });
            $('#unsubscribe-thread-{{$thread->id}}').hide();
        });
    });
</script>

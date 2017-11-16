<script>
    $('#delete-post-{{$post->id}}').on('click', function(){
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this post!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                document.getElementById('delete-post-form-{{$post->id}}').submit();
                swal("Your post has been deleted!", {
                    icon: "success",
                });
            } else {
                swal("Whew, your post is safe!");
            }
        });
    });
</script>

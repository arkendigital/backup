<script>
    $('#delete-thread-{{$thread->id}}').on('click', function(){
        swal({
            title: "Are you sure?",
            text: "Deleting this thread will delete all replies, please consider your actions carefully.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                document.getElementById('delete-thread-form-{{$thread->id}}').submit();
                swal("Your thread has been deleted!", {
                    icon: "info",
                });
            } else {
                swal("That was close", "Whew, your thread is safe!", "warning");
            }
        });
    });
</script>

<script>
    $('#report-post-{{$post->id}}').on('click', function(){
        swal({
            text: 'Please let us know what\'s wrong with this post...',
            content: "input",
            button: {
                text: "Report Post"
            },
        })
        .then(content => {
            if (!content) throw null;
            axios.post('/api/reports/{{$post->id}}', {
                content
            })
            .then((data) => {
                console.log(data);
            })
            .catch((error) => {
                console.log(error);
            });
            console.log(content);
        })
        .then(() => {
            swal("Thanks! Someone will be looking into this soon.", {
                icon: "success",
            });
        });
    });
</script>

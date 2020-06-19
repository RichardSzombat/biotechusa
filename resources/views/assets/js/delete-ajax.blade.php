<script>
    $( document ).ready(function() {
        $('#delete').on('click',function () {
            $.ajax({
                url: '{{route('product.delete',$product->id)}}',
                type: "post",
                method: 'delete',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    window.location ="/"
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
    });

</script>

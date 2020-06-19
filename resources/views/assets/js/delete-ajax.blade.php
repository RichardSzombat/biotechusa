<script>
    $( document ).ready(function() {

        $('.delete-button').on('click',function () {
            let productId = this.getAttribute("data-product");
            console.log(productId);
            $.ajax({
                url: '/product/'+productId+'/delete',
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

<script>
    $( document ).ready(function() {

        $('.delete-button').on('click',function (e) {
            e.preventDefault();
            let productId = this.getAttribute("data-product");
            $.ajax({
                url: '/product/'+productId+'/delete',
                type: "post",
                method: 'delete',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    window.location ="/"
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
    });
</script>

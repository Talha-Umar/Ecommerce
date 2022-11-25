 $(document).ready(function(){

$("#product").change(function(){
        var cid = $(this).val();

         $.ajax({
            url: 'includes/selectprice.php',
            type: 'post',
            data: {cid:cid},
            dataType: 'html',
            success:function(response){
            $("#price").val(response);
            $("#ep").text(response);
            $("#jc").text(response);
            $("#bk").text(response);
            }
        });

    });
});
<script>
    if ($('#type').val() == 'Subcategory' || $('#type').val() == 'Subcategory1' || $('#type').val() == 'Subcategory2' || $('#type').val() == 'Subcategory1' || $('#type').val() == 'Topics') {
        $("#category").attr('required', true);
        $('#cat_div').show();
    } else {
        $("#category").attr('required', false);
        $('#cat_div').hide();
    }
    if ($('#type').val() == 'Topics' || $('#type').val() == 'Subcategory1') {
        $("#subcategory_select").attr('required', true);
        $("#subcategory1_select").attr('required', false);
        $("#subcategory2_select").attr('required', false);
        $('#subcategory').show();
        if ($('#type').val() == 'Topics') {
            $('.subcategory_topics').show();
            $('.sub-danger').hide()
        } else {
            $('.subcategory_topics').hide();
            $('.sub-danger').show()
        }
    } else if ($('#type').val() == 'Subcategory2') {
        $("#subcategory1_select").attr('required', true);
        $('#subcategory1').show();
    } else {
        $("#subcategory_select").attr('required', false);
        $("#subcategory1_select").attr('required', false);
        $("#subcategory2_select").attr('required', false);
        $('#subcategory').hide();
        $('#subcategory1').hide();
        $('#subcategory2').hide();
    }
    $(function() {
        $('#type').change(function() {
            $('#subcategory_select').html('');
            $('#subcategory1_select').html('');
            $('#subcategory2_select').html('');
            if ($('#type').val() == 'Subcategory' || $('#type').val() == 'Subcategory1' || $('#type').val() == 'Subcategory2' || $('#type').val() == 'Subcategory1' || $('#type').val() == 'Topics') {
                $("#category").attr('required', true);
                $('#cat_div').show();
            } else {
                $("#category").attr('required', false);
                $('#cat_div').hide();
            }
        });
    });

    $(function() {
        $('#type').change(function() {
            if ($('#type').val() == 'Topics' || $('#type').val() == 'Subcategory1') {
                $("#subcategory_select").attr('required', true);
                $("#subcategory1_select").attr('required', false);
                $("#subcategory2_select").attr('required', false);
                $('#subcategory').show();
                if ($('#type').val() == 'Topics') {
                    $('.subcategory_topics').show();
                    $('.sub-danger').hide()
                } else {
                    $('.subcategory_topics').hide();
                    $('.sub-danger').show()
                }
            } else if ($('#type').val() == 'Subcategory2') {
                $("#subcategory1_select").attr('required', true);
                $('#subcategory1').show();
            } else {
                $("#subcategory_select").attr('required', false);
                $("#subcategory1_select").attr('required', false);
                $("#subcategory2_select").attr('required', false);
                $('#subcategory').hide();
                $('#subcategory1').hide();
                $('#subcategory2').hide();
            }
        });
    });
</script>
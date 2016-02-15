/**
 * Created by MustafaHusain on 6/17/14.
 */
$(document).ready(function () {


    function refreshSmallBasket() {

        $.ajax({
            url: 'mod/basket_small.php',
            data:'GET',
            dataType: 'json',
            success: function (data) {
                //alert(data);
                console.log(data);
                $.each(data, function (k, v) {
                    $("#basket_left ." + k + " span").text(v);
                });
            },
            error: function (jqXHR, exception, data) {
                alert("Error" + data);
                console.log(data);
                if (jqXHR.status === 0) {
                    alert('Not connect.\n Verify Network.');
                } else if (jqXHR.status == 404) {
                    alert('Requested page not found. [404]');
                } else if (jqXHR.status == 500) {
                    alert('Internal Server Error [500].');
                } else if (exception === 'parsererror') {
                    alert('Requested JSON parse failed.');
                } else if (exception === 'timeout') {
                    alert('Time out error.');
                } else if (exception === 'abort') {
                    alert('Ajax request aborted.');
                } else {
                    alert('Uncaught Error.\n' + jqXHR.responseText);
                }
                //console.log(data);
            }
        });

    }


    if ($(".add_to_basket").length > 0) {
        $(".add_to_basket").click(function () {

            var trigger = $(this);
            var param = trigger.attr("rel");
            var item = param.split("_");



            $.ajax({
                type: 'POST',
                url: 'mod/basket.php',
                dataType: 'json',
                data: {
                    id: item[0],
                    job: item[1]
                },


                success: function (data) {
                    var new_id = item[0] + '_' + data.job;
                    //alert(data);
                    //console.log(new_id);
                    if (data.job!= item[1]) {
                        if (data.job == 0) {
                            trigger.attr("rel", new_id);
                            trigger.text("Remove from basket");
                            trigger.addClass("red");
                        } else {
                            trigger.attr("rel", new_id);
                            trigger.text("Add to basket");
                            trigger.removeClass("red");
                        }
                        refreshSmallBasket();
                    }
                },
                error: function (jqXHR, exception, data) {
                    alert("Error" + data);
                    console.log(data);
                    if (jqXHR.status === 0) {
                        alert('Not connect.\n Verify Network.');
                    } else if (jqXHR.status == 404) {
                        alert('Requested page not found. [404]');
                    } else if (jqXHR.status == 500) {
                        alert('Internal Server Error [500].');
                    } else if (exception === 'parsererror') {
                        alert('Requested JSON parse failed.');
                    } else if (exception === 'timeout') {
                        alert('Time out error.');
                    } else if (exception === 'abort') {
                        alert('Ajax request aborted.');
                    } else {
                        alert('Uncaught Error.\n' + jqXHR.responseText);
                    }
                    //console.log(data);
                }
            });
            return false;

        });
    }




});
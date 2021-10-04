// Kosárba tevés gomb
$(document).on('click', '.basket-add', function() {
    $.ajax({
        type: "POST",
        url: "/webprog/"+username+"/api/basket-add",
        data: {id: $(this).data("product")},
        dataType: "text",
        success: function(response){
            if(response === "OK") {
                window.alert("A termék bekerült a kosárba!");
            } else {
                window.alert("Hiba történt a termék kosárba helyezése közben!");
            }
        },
        error: function(){
            window.alert("Hiba történt a termék kosárba helyezése közben!");
        }
    });
});

$(document).on('click', '.basket-add-count', function() {
    $.ajax({
        type: "POST",
        url: "/webprog/"+username+"/api/basket-add",
        data: {id: $(this).data("product"), pcs: $("#product-count").val()},
        dataType: "text",
        success: function(response){
            if(response === "OK") {
                window.alert("A termék bekerült a kosárba!");
            } else {
                window.alert("Hiba történt a termék kosárba helyezése közben!");
            }
        },
        error: function(){
            window.alert("Hiba történt a termék kosárba helyezése közben!");
        }
    });
});

// Megrendelés űrlap megye- és településválasztója
$(document).ready(function() {
    let county_filed = $("#county");
    let town_field   = $("#town");

    if(county_filed) {
        town_field.prop('disabled', 'disabled');
        $.ajax({
            type: "POST",
            url: "/webprog/example/megye.php",
            data: {
                lista: "megye"
            },
            dataType: "json",
            success: function (response) {
                county_filed.html('');
                county_filed.append('<option value="" disabled selected>Válasszon...</option>');
                $.each(response, function (d, v) {
                    county_filed.append('<option value="' + v + '">' + v + '</option>');
                });
                town_field.prop('disabled', 'disabled');
            }
        });

        county_filed.change(function (e) {
            $.ajax({
                type: "POST",
                url: "/webprog/example/megye.php",
                data: {
                    lista: "telepules",
                    megye: $(this).val()
                },
                dataType: "json",
                success: function (response) {
                    town_field.html('');
                    town_field.append('<option value="" disabled selected>Válasszon...</option>');
                    $.each(response, function (d, v) {
                        town_field.append('<option value="' + v + '">' + v + '</option>');
                    });
                    town_field.prop('disabled', false);
                }
            });
        });
    }
});


$("#order-form").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = " /webprog/"+username+"/api/save-order";

    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            if(data.split("|")[0] === "OK") {
                // message and redirect
                window.alert("A megrendelés sikeres!");
                window.location = "/webprog/"+username+"/track?order-id=" + data.split("|")[1]
            } else if(data === "ERR") {
                // message
                window.alert("Hiba történt a megrendelés rögíztése közben!");
            } else {
                let json_data = JSON.parse(data);
                $.each(json_data, function(k, v) {
                    validationFeedback(k, v);
                })
            }
        }
    });
});

function validationFeedback(name, error) {
    let form_field = $('[name="'+name+'"]');

    // remove all decorations:
    form_field.removeClass('is-invalid').removeClass('is-valid');

    // remove error tooltip text
    form_field.parent().find(".invalid-feedback").remove();

    if(!error) { // if OK
        form_field.addClass('is-valid');
    } else { // if not OK
        form_field.addClass('is-invalid');
        form_field.parent().append('<div class="invalid-feedback">'+error+'</div>');
    }
}
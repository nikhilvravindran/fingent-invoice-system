$(document).ready(function () {
    $('.discount_amt_wrapper').hide();
    $('.error').hide();
    var first_a = $(".data_value_key").first();
    var firsta_a = first_a.find('a[class~="remove_source"]');
    firsta_a.hide();

    var wrapper_a = $("#main_wrapper");

    $("#add_key").click(function (e) {
        e.preventDefault();
        var newid = 1;
        $("#main_wrapper tr.data_value_key").each(function () {
            if (parseInt($(this).data("id")) > newid) {
                newid = parseInt($(this).data("id"));
            }
            newid++;

        });

        var current = $(".data_value_key").last();
        var cloned = current.clone();
        cloned.find('input,text').val('');
        cloned.find('a[class~="remove_source"]').show();
        cloned.attr("id", 'row_' + newid);
        cloned.find('.gl_def_text').text('');
        cloned.insertAfter(current);
        var first = $(".data_value_key").first();
        first.find('a[class~="remove_source"]').hide();

    });

    $(wrapper_a).on("click", ".remove_source", function (e) { //user click on remove text
        e.preventDefault();
        $(this).parent('td').parent('tr').remove();
        calculateSubTotal();

    });

    $(".main_wrapper").on('change', '#tax', function () {
        calculateSubTotal();
    })

    $(".main_wrapper").on('keyup', '.price, .quantity', function () {
        calculateSubTotal();
    })

    $(".discount").on('keyup', function () {
        calculateTotal();
    })

    $(".discount_type").on('change', function () {
        var discount_type = $('input[name="discount_type"]:checked').val();
        $('.discount_icon').text(discount_type);
        calculateTotal();
    })

});


function calculateSubTotal() {
    var subtotalAmount = 0;
    var subtotalAmountTax = 0;

    $(".data_value_key .price").each(function () {

        var parentTr = $(this.closest('tr')).attr('id');
        var qty = $("#" + parentTr).find('.quantity').val();
        var price = $("#" + parentTr).find('.price').val();
        var taxRate = $("#" + parentTr).find('.tax').val();
        var subtotal = price * qty;
        var taxAmount = subtotal * taxRate / 100;
        var subtotal_tax = subtotal + taxAmount;

        $("#" + parentTr).find('.total_notax').val(subtotal);
        $("#" + parentTr).find('.total_tax').val(subtotal_tax);
        subtotalAmount += subtotal;
        subtotalAmountTax += subtotal_tax;
    });

    $('.subTotal_notax').val(subtotalAmount);
    $('.subTotal_tax').val(subtotalAmountTax);
    calculateTotal();
}

function calculateTotal() {
    var discount = $('.discount').val();
    var discount_type = $('input[name="discount_type"]:checked').val();
    var subTotal_tax = $('.subTotal_tax').val();
    if (discount_type == '%') {
        var discountamt = subTotal_tax * discount / 100;
        $('.discount_amt_wrapper').show();
        $('.discount_amt').val(discountamt);
        var totalAmount = subTotal_tax - discountamt;
    } else if (discount_type == '$') {
        $('.discount_amt_wrapper').hide();
        var totalAmount = subTotal_tax - discount;
    }
    $('.total_amt').val(totalAmount);
}

function savejsonOrder() {
    var final_details = [];
    var invoice_json = [];
    var canSendAjax=true;

    $('tr.data_value_key input').each(function() {
        if(!$(this).val()){
            $('.error').show();
           canSendAjax=false;
           return false;
        }
    });


    $('#main_wrapper tr.data_value_key').each(function () {
            
            product_name = $(this).find("input[name^='product_name']").val();
            quantity = $(this).find("input[name^='quantity']").val();
            price = $(this).find("input[name^='price']").val();
            tax = $(this).find("select[name^='tax']").val();
            total_notax = $(this).find("input[name^='total_notax']").val();
            total_tax = $(this).find("input[name^='total_tax']").val();

            invoice_json.push({ product_name: product_name, quantity: quantity, price: price, tax: tax, total_notax: total_notax, total_tax: total_tax });

    });

    
    subTotal_notax = $(".subTotal_notax").val();
    discount_type = $("input[name^='discount_type']:checked").val();
    discount = '';
    discountamt = 0;
    if (discount_type == '%') {
        discount = $(".discount").val();
        discountamt = $(".discount_amt").val();
    }
    else if (discount_type == '$') {
        discountamt = $(".discount").val();
    }
    subTotal_tax = $(".subTotal_tax").val();
    total_amt = $(".total_amt").val();

    final_details.push({ subTotal_notax: subTotal_notax, discount_type: discount_type, discount: discount, discountamt: discountamt, subTotal_tax: subTotal_tax, total_amt: total_amt });
    var base_url = window.location.href;
    if(canSendAjax){
    $.ajax({
        url: base_url + "index/generate_invoice",
        type: 'POST',
        async: false,
        data: { invoice_json: JSON.stringify(invoice_json), final_details: JSON.stringify(final_details) },
        success: function (response) {
            window.open(response, '_blank');
        }
    })
}
  



}
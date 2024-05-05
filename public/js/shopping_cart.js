$.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
})

function add_amount(url) {
    $.ajax({
        url: url,
        type: 'POST',
        success: function(data) {
            let element = JSON.parse(data)
            let amount_field = $('#amount-' + element.id)
            let product_amount = $('#price-product-' + element.id + ' span[role="product_amount"]')
            let price_result = $('#price-product-' + element.id + ' span[role="price_result"]')
            let real_price = $('#price-product-' + element.id + ' span[role="price_real"]')

            amount_field.text(element.amount)
            product_amount.text(element.amount)
            price_result.text(Number(real_price.text()) * Number(element.amount))
            
        },
        error: function(data) {
            console.log('Shopping cart error - data was not synchronized')
        },
    })
}

function rem_amount(url) {  
    $.ajax({
        url: url,
        type: 'POST',
        success: function (data) {
            if(data == 0){
                return
            }
            let element = JSON.parse(data)
            let amount_field = $('#amount-' + element.id)
            let product_amount = $('#price-product-' + element.id + '>span[role="product_amount"]')
            let price_result = $('#price-product-' + element.id + '>span[role="price_result"]')
            let real_price = $('#price-product-' + element.id + '>span[role="price_real"]')

            amount_field.text(element.amount)
            product_amount.text(element.amount)
            price_result.text(Number(real_price.text()) * Number(element.amount))
        },
        error: function (data) {
            console.log('Shopping cart error - data was not synchronized')
        },
    })
}

function rem_element(url) {  
    $.ajax({
        url: url,
        type: 'POST',
        success: function (data) {
            let response = JSON.parse(data)
            let product = $('#element-' + response.id)
            console.log(response.id, product, data)
            product.attr('style', 'display: none !important;')
        },
        error: function (data) {
            console.log('Shopping cart error - data was not synchronized')
        },
    });
}
$.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
})

function add_amount() {
    $.ajax({
        url: add_url,
        type: 'POST',
        success: function(data) {
            let element = JSON.parse(data)
            let amount_field = $('#amount-' + element.id)
            let product_amount = $('#price-product-' + element.product_id + ' span[role="product_amount"]')
            let price_result = $('#price-product-' + element.product_id + ' span[role="price_result"]')
            let real_price = $('#price-product-' + element.product_id + ' span[role="price_real"]')

            amount_field.text(element.amount)
            product_amount.text(element.amount)
            price_result.text(Number(real_price.text()) * Number(element.amount))
            
        },
        error: function(data) {
            console.log('Shopping cart error - data was not synchronized')
        },
    })
}

function rem_amount() {  
    $.ajax({
        url: rem_url,
        type: 'POST',
        success: function (data) {
            if(data == 0){
                return
            }
            let element = JSON.parse(data)
            let amount_field = $('#amount-' + element.id)
            let product_amount = $('#price-product-' + element.product_id + '>span[role="product_amount"]')
            let price_result = $('#price-product-' + element.product_id + '>span[role="price_result"]')
            let real_price = $('#price-product-' + element.product_id + '>span[role="price_real"]')

            amount_field.text(element.amount)
            product_amount.text(element.amount)
            price_result.text(Number(real_price.text()) * Number(element.amount))
        },
        error: function (data) {
            console.log('Shopping cart error - data was not synchronized')
        },
    })
}
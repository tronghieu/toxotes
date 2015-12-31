$(document).ready(function() {
    //Suggestion customer chose
//@see http://twitter.github.io/typeahead.js/examples/
    var customers = new Bloodhound({
        datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.tokens.join(' ')); },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 10,
        /*prefetch: {
            url: customers_list_url
        },*/
        remote : customers_list_url +'?k=%QUERY'
    });

// kicks off the loading/processing of `local` and `prefetch`
    customers.initialize();

    //suggest by code
    $('#_customer_code-fc').typeahead({
        hint: true,
        highlight: true,
        minLength: 1,
        autoselect: true
    }, {
        name: 'customers-list',
        displayKey: 'uid',
        source: customers.ttAdapter(),
        templates: {
            empty: [
                '<div class="empty-message">',
                'Create New',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile('<p><strong>{{uid}}</strong> / {{name}}<br>{{mobiles}}</p>')
        }
    }).on('typeahead:selected', function(obj, datum, name) {
        $('#_customer_mobile-fc').val(datum.mobiles);
        $("#_customer_name-fc").val(datum.name);
        $("#_order-customer-id-txt").val(datum.id);
        $("#_order-pickup-address-fc").val(datum.address);
        $("#_cus-district-id").val(datum.district_id);
        $("#_cus-province-id").val(datum.province_id);
    });

    //suggest by mobile
    $('#_customer_mobile-fc').typeahead({
        hint: true,
        highlight: true,
        minLength: 1,
        autoselect: true
    }, {
        name: 'customers-list',
        displayKey: 'mobiles',
        source: customers.ttAdapter(),
        templates: {
            empty: [
                '<div class="empty-message">',
                'Create New',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile('<p><strong>{{uid}}</strong> / {{name}}<br>{{mobiles}}</p>')
        }
    }).on('typeahead:selected', function(obj, datum, name) {
        $('#_customer_code-fc').val(datum.uid);
        $("#_customer_name-fc").val(datum.name);
        $("#_order-customer-id-txt").val(datum.id);
        $("#_order-pickup-address-fc").val(datum.address);
        $("#_cus-district-id").val(datum.district_id);
        $("#_cus-province-id").val(datum.province_id);
    });
});
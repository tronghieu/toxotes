$(function(){
    $('#event_location_address').change(function() {
        var address = $('#event_location_address').val();
        console.log(address);
        if ('' == address) {
            $('#event_map').hide();
            return false;
        }
        event_display_map(address, $('#event_location_name').val());
    });

    if ('' != $('#event_location_address').val()) {
        event_display_map($('#event_location_address').val(), $('#event_location_name').val());
    }

    function event_display_map(address, info_label) {
        $('#event_map').gmap3({
            action: 'destroy'
        });

        var container = $('#event_map').parent();
            $('#event_map').remove();
        container.append('<div id="event_map"></div>');


        $('#event_map').length && $('#event_map').gmap3({
            marker:{
                address: address
            },
            map:{
                options:{
                    zoom: 15
                }
            }
        }).css({'height': '300px'}).show();
    }
});
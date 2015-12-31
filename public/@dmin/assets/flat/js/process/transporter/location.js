
Transporter.Location = {
    load : function(callback) {
        locations = sessionStorage.getItem('locations');
        if (locations) {
            callback(JSON.parse(locations));
        } else {
            $.ajax({
                url: get_locations_url,
                data: {},
                type: 'GET',
                success: function(response){
                    sessionStorage.setItem('locations', JSON.stringify(response));
                    callback(response);
                }
            })
        }
    }
};

Transporter.Location.Province = {
    display : function(id) {
        var e = $('#' +id);
        Transporter.Location.load(function (locations) {
            for(var i = 0; i < locations.length; ++i) {
                if (locations[i].section != 'PROVINCE') {
                    continue;
                }

                if (i == 0 && !e.data('value')) {
                    e.data('value', locations[i].id);
                }
                var html = '<option value="' + locations[i].id +'"';
                html += (e.data('value') == locations[i].id)? ' selected':'';
                html += '>' +locations[i].name +'</option>';
                e.append(html);
            }

            Transporter.Location.District.display(e.attr('rel'), e.data('value'));
        });
    }
};

Transporter.Location.District = {
    display : function(id, province) {
        var e = $('#' +id);
        Transporter.Location.load(function (locations) {
            for(var i = 0; i < locations.length; ++i) {
                if (locations[i].id != province) {
                    continue;
                }

                var districts = locations[i].children;
                for (var j = 0; j < districts.length; ++j) {
                    var html = '<option value="' + districts[j].id +'"';
                    html += (e.data('value') == districts[j].id)? ' selected':'';
                    html += '>' +districts[j].name +'</option>';
                    e.append(html);
                }

            }
        });
    }
};
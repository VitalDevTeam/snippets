/**
 * Get address information from Google Maps API
 * @param  {string} val Any valid address or ZIP code
 *
 * Requires loading of Google Maps API first!
 * https://maps.googleapis.com/maps/api/js?v=3.13&sensor=false
 */
function vtlGetLocation(val) {

    if (typeof google != 'undefined') {
        var addr = {};
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode({ 'address': val }, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {

                if (results.length >= 1) {

                    for (var ii = 0; ii < results[0].address_components.length; ii++) {
                        var street_number = route = street = city = state = zipcode = country = formatted_address = '';
                        var types = results[0].address_components[ii].types.join(",");

                        if (types == "street_number") {
                            addr.street_number = results[0].address_components[ii].long_name;
                        }

                        if (types == "route" || types == "point_of_interest,establishment") {
                            addr.route = results[0].address_components[ii].long_name;
                        }

                        if (types == "sublocality,political" || types == "locality,political" || types == "neighborhood,political" || types == "administrative_area_level_3,political") {
                            addr.city = (city === '' || types == "locality,political") ? results[0].address_components[ii].long_name : city;
                        }

                        if (types == "administrative_area_level_1,political") {
                            addr.state = results[0].address_components[ii].short_name;
                        }

                        if (types == "postal_code" || types == "postal_code_prefix,postal_code") {
                            addr.zipcode = results[0].address_components[ii].long_name;
                        }

                        if (types == "country,political") {
                            addr.country = results[0].address_components[ii].long_name;
                        }
                    }

                    addr.lat = results[0].geometry.location.lat();
                    addr.lng = results[0].geometry.location.lng();
                    addr.success = true;

                    // If success
                    console.log(addr);

                } else {

                    // If no results

                }

            } else {

                // If Google Maps API responds !OK

            }

        });

    } else {

        // If Google Maps API not loaded

    }

}
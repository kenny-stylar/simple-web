$(".geolocation")
.on('click', function(e) {
  $(this).select();
})
.geocomplete()
.bind("geocode:result", function(event, result) {
  //create address components
  var filter_comp = ['locality', 'route', 'country', 'administrative_area_level_1', 'sublocality'];
  var address_comp = result.address_components;
  var own_comp = [];
  for ( var i=0; i<address_comp.length; i++ ) {
    if ( $.inArray(address_comp[i].types[0], filter_comp) ) {
      own_comp[ address_comp[i].types[0] ] = address_comp[i].long_name;
    }
  }

  var geoloc = {
    'address_components' : $.extend( {}, own_comp ),
    'formatted_address' : result.formatted_address,
    'lat' : result.geometry.location.nb,
    'lng' : result.geometry.location.ob,
    'reference' : result.reference,
    'place_id' : result.id
  };

  $('#location').val( JSON.stringify(geoloc) );
});
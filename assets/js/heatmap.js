// axios.get('https://api.github.com/gists/fdca2ad91f21260d3b07577eaef36765')
//   .then(response => {

	// provinceData_1.features.forEach(element => {
	// 	provinceData.features.push(element)
	// });
		
	// console.log(provinceData);
	

    var map = L.map('map').setView([14.5, 121],9);
	// var map = L.map('map', {
	// 	center: [10.015, 123],
	// 	zoom: 9,
	// 	dragging: false
	// });
	
    var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        // maxZoom: 10,
        // minZoom: 8,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // control that shows state info on hover
    var pinfo = L.control();

    pinfo.onAdd = function (map) {
      this._div = L.DomUtil.create('div', 'pinfo');
      this.update();
      return this._div;
    };

    pinfo.update = function (props) {
      this._div.innerHTML = '<h4>Active Cases in the Area</h4>' +  (props ?
        '<b>' + props.province + '</b><br />' + props.cases + ' cases' : 'Hover over a municipality')
    };

    pinfo.addTo(map);

  function getColor(d) {
      return d > 1000 ? '#d73027' :
             d > 500  ? '#f46d43' :
             d > 100  ? '#fdae61' :
             d > 50   ? '#a6d96a' :
             d > 10   ? '#66bd63' :
			 			'#1a9850';
  }

	function style(feature) {
		return {
			weight: 1,
			opacity: 1,
			color: 'black',
			dashArray: '3',
			fillOpacity: .7,
			fillColor: getColor(parseInt(feature.properties.cases.replace(/,/g, ''), 10))
		};
	}

  function highlightFeature(e) {
		var layer = e.target;

		layer.setStyle({
			weight: 2,
			color: '#000',
			dashArray: '',
			// fillOpacity: 1
		});

		if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
			layer.bringToFront();
		}

		pinfo.update(layer.feature.properties);
	}

var geojson;

	function resetHighlight(e) {
		geojson.resetStyle(e.target);
		pinfo.update();
	}
	
	function clickFeature(e) {
		var layer = e.target;
		map.fitBounds(layer.getBounds());
		// var con = 'bacolod';
		// var con = (String(layer.feature.properties.province));
		// var muni = document.getElementById(con);
		
		jQuery(function($) {
			$(".content").each(function(){
				var $curID = $(this);
				console.log($(this).attr("id"));
				if(con.indexOf($curID.attr("id")) != -1) {
					$curID.css('opacity', 1);
				} else {
					$curID.css('opacity', 0);
				}
			})
		});
		
		$('#right-container .main').css('display', 'block')

		$('#requirements').html(`
		<p class="title">COVID-19 Health and Travel Requirements</p>
		<p>FULLY VACCINATED INDIVIDUALS</p>
		<ul>
			<li>Valid ID</li>
			<li>VaxCertPH Vaccination Certificate</li>
		</ul>
		<p>PARTIALLY / UNVACCINATED INDIVIDUALS</p>
		<ul>
			<li>Valid ID</li>
			<li>Negative Rapid Antigen Test Result taken from any DOH-accredited laboratories <br> valid within 
				forty-eight (48) hours prior departure or arrival. 
			</li>
		</ul>`);

		$('#no-content').remove();
		
		$('#city-name').text(String(layer.feature.properties.province))
		$('#region').text(String(layer.feature.properties.region))

		$('#active').text(String(layer.feature.properties.cases))
		$('#deaths').text(String(layer.feature.properties.deaths))
		$('#deathrate').text(String(layer.feature.properties.deathrate) +" rate")
		$('#newcases').text("+" + String(layer.feature.properties.newcases) +" new")
		$('#recovery').text(String(layer.feature.properties.recovery))
		$('#recoveryrate').text(String(layer.feature.properties.recoveryrate) +" rate")
		$('#totalcases').text(String(layer.feature.properties.totalcases))

		$('.active-cases').css('background-color', getColor(parseInt(layer.feature.properties.cases.replace(/,/g, ''), 10)))
		
		// $('#population').text(String(layer.feature.properties.population))
	}

	function onEachFeature(feature, layer) {
		layer.on({
			mouseover: highlightFeature,
			mouseout: resetHighlight,
			click: clickFeature
		});
	}

	for (let i = 1; i <= 19; i++) {
		var filename = "geojson/provinces-region-ph"+ i + ".json";
		$.getJSON(filename, function (gjson) {
			geojson = L.geoJson(gjson, {
				style: style,
				onEachFeature: onEachFeature
			}).addTo(map);
		});
	}

	for (let j = 2; j <= 4; j++) {
		filename = "geojson/provinces-region-ph18-"+ j + ".json";
		$.getJSON(filename, function (gjson) {
			geojson = L.geoJson(gjson, {
				style: style,
				onEachFeature: onEachFeature
			}).addTo(map);
		});
	}

	/* global statesData */
	// geojson = L.geoJson(provinceData, {
	// 	style: style,
	// 	onEachFeature: onEachFeature
	// }).addTo(map);

	map.attributionControl.addAttribution('COVID-19 data &copy; <a href="https://doh.gov.ph/covid19tracker">Department of Health</a>');

	var legend = L.control({position: 'bottomright'});

	legend.onAdd = function (map) {

		var div = L.DomUtil.create('div', 'pinfo legend');
		var grades = [0, 10, 50, 100, 500, 1000];
		var labels = [];
		var from, to;

		for (var i = 0; i < grades.length; i++) {
			from = grades[i];
			to = grades[i + 1];

			labels.push(
				'<i style="background:' + getColor(from + 1) + '"></i> ' +
				from + (to ? '&ndash;' + to : '+'));
		}

		div.innerHTML = labels.join('<br>');
		return div;
	};
  
  legend.addTo(map);

//   })
//     .catch(error => {
//     console.log(error)
//   })
// axios.get('https://api.github.com/gists/fdca2ad91f21260d3b07577eaef36765')
//   .then(response => {

	// provinceData_1.features.forEach(element => {
	// 	provinceData.features.push(element)
	// });
		
	// console.log(provinceData);
	

    var map = L.map('map').setView([10.015, 123],9);
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
	// const con = document.getElementById('bacolod');
	// console.log(con);
	  this.con = document.getElementById('bacolod');
      this.update();
      return this._div;
    };

    pinfo.update = function (props) {
      this._div.innerHTML = '<h4>Active Cases in the Area</h4>' +  (props ?
        '<b>' + props.province + '</b><br />' + props.cases + ' cases' : 'Hover over a municipality');
	  
		// this.con.style.color = "red";
    };

    pinfo.addTo(map);

  function getColor(d) {
      return d > 1000 ? '#d73027' :
             d > 500  ? '#fc8d59' :
             d > 100  ? '#fee08b' :
             d > 50   ? '#d9ef8b' :
             d > 10   ? '#91cf60' :
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
var prev = document.getElementById('city of talisay');

	function resetHighlight(e) {
		geojson.resetStyle(e.target);
		pinfo.update();
	}

	function clickFeature(e) {
		var layer = e.target;
		map.fitBounds(layer.getBounds());
		// var con = 'bacolod';
		var con = (String(layer.feature.properties.province).toLowerCase());
		var muni = document.getElementById(con);
		
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

		// prev.style.opacity = 0;
		// muni.style.opacity = 1;
		// prev = muni;		
		
		// console.log(document.getElementById(con));
		// console.log(layer.feature.properties.name);
		// console.log((name.toLowerCase()).indexOf(con) != -1);
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
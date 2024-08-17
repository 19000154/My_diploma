<?php
include "path.php";
include "app/controllers/topics.php";
$posts = selectAllFromPostsWithUsersOnIndex('posts', 'users');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
    <title>Display a marker</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v8.2.0/ol.css">
    <script src="https://cdn.jsdelivr.net/npm/ol@v8.2.0/dist/ol.js"></script>
    <style>
        #map-container {
            width: 600px;
            height: 400px;
            border: 1px solid #000;
            margin: 20px auto;
            position: relative;
        }

        #map {
            width: 100%;
            height: 100%;
        }

        .popup {
            position: absolute;
            background-color: white;
            padding: 10px;
            border: 1px solid black;
            border-radius: 5px;
            bottom: 12px;
            left: -50px;
        }

        .popup a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    <div id="map-container">
        <div id="map"></div>
        <div id="popup" class="popup" style="display: none;">
            <a href="#" target="_blank" id="popup-link">Link</a>
        </div>
    </div>
    <script>
        const key = 'Kxpt0lwYRQmPKdhneuhn';

        const attribution = new ol.control.Attribution({
            collapsible: false,
        });

        const source = new ol.source.TileJSON({
            url: `https://api.maptiler.com/maps/openstreetmap/tiles.json?key=${key}`,
            tileSize: 512,
            crossOrigin: 'anonymous'
        });

        const map = new ol.Map({
            layers: [
                new ol.layer.Tile({
                    source: source
                })
            ],
            controls: ol.control.defaults.defaults({attribution: false}).extend([attribution]),
            target: 'map',
            view: new ol.View({
                constrainResolution: true,
                center: ol.proj.fromLonLat([30.316797,59.936409]),
                zoom: 11
            })
        });

        // Функция для создания SVG-иконки с возможностью изменения цвета
        function createMarkerSvg(color) {
            return `
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                    <circle cx="16" cy="16" r="10" fill="${color}" stroke="black" stroke-width="2"/>
                </svg>`;
        }

        // Функция для создания стиля маркера с заданным цветом
        function createMarkerStyle(color) {
            return new ol.style.Style({
                image: new ol.style.Icon({
                    anchor: [0.5, 0.5],
                    src: 'data:image/svg+xml;utf8,' + encodeURIComponent(createMarkerSvg(color))
                })
            });
        }

        // Функция для генерации случайных координат в пределах Санкт-Петербурга
        function getRandomCoordinates() {
            const minLon = 30.2;
            const maxLon = 30.4;
            const minLat = 59.9;
            const maxLat = 60.0;
            const lon = Math.random() * (maxLon - minLon) + minLon;
            const lat = Math.random() * (maxLat - minLat) + minLat;
            return [lon, lat];
        }

        function getRandomColor() {
            const hue = Math.random() * 180 + 10 // случайный оттенок в диапазоне от 30 до 90 (желтый до красного)
            const saturation = 100; // насыщенность
            const lightness = 50; // светлота
            
            const hslColor = `hsl(${hue}, ${saturation}%, ${lightness}%)`;
            return hslColor;
        }

        // Получение данных постов из PHP в JavaScript
        const posts = <?php echo json_encode($posts); ?>;

        // Создаем массив объектов Feature для маркеров
        const features = posts.map((post) => {
    const coordinates = getRandomCoordinates();
    const feature = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.fromLonLat(coordinates)),
        url: '<?=BASE_URL?>single.php?post=' + post.id,
        title: post.title
    });
    const color = getRandomColor(); // Получаем случайный цвет
    feature.setStyle(createMarkerStyle(color));
    return feature;
});

        // Создаем векторный источник данных
        const vectorSource = new ol.source.Vector({
            features: features
        });

        // Создаем векторный слой и добавляем векторный источник
        const markersLayer = new ol.layer.Vector({
            source: vectorSource
        });

        map.addLayer(markersLayer);

        const popup = document.getElementById('popup');
        const popupLink = document.getElementById('popup-link');
        const overlay = new ol.Overlay({
            element: popup,
            positioning: 'bottom-center',
            stopEvent: false,
            offset: [0, -10],
        });
        map.addOverlay(overlay);

        map.on('click', function(event) {
            const feature = map.forEachFeatureAtPixel(event.pixel, function(feature) {
                return feature;
            });
            if (feature) {
                const coordinates = feature.getGeometry().getCoordinates();
                const url = feature.get('url');
                const title = feature.get('title');
                popupLink.href = url;
                popupLink.textContent = title;
                overlay.setPosition(coordinates);
                popup.style.display = 'block';
            } else {
                popup.style.display = 'none';
            }
        });
    </script>
</body>
</html>

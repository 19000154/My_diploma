<?php
include "path.php";
include "app/controllers/topics.php";
$posts = selectAll('posts', ['id_topic' => $_GET['id']]);
//tt($posts);
$category = selectOne('topics', ['id' => $_GET['id']]);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!--    &lt;!&ndash; Подключение Bootstrap CSS через CDN &ndash;&gt;-->
<!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">-->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"

          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!--Custom styling-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">

    <title>My events</title>

    <!-- MAP -->
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
        <title>Display a marker</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v8.2.0/ol.css">
        <script src="https://cdn.jsdelivr.net/npm/ol@v8.2.0/dist/ol.js"></script>
        <style>
          #map {position: absolute; top: 0; right: 0; bottom: 0; left: 0;}
        </style>

</head>
<body>

<?php include("app/include/header.php"); ?>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->

<!--БЛОК main-->
<div class="container">
    <div class="content row">
    <!-- main content -->
        <div class="main-content col-md-8 col-12">
            <h2>Статьи с раздела "<?=$category['name'];?>"</h2>
                <label class="switchh">
                    <input type="checkbox" id="toggleSwitch">
                    <span class="slider round"></span>
                    <p id="fruitText">карта</p>
                </label>

                <script src="switch.js"></script>
            <div id="ONE">
                <?php if (empty($posts)): ?>
                    <p>К сожалению в данном разделе пока нет статей(</p>
                <?php else: ?>
                <?php foreach ($posts as $post) :
                        $user = selectOne('users', ['id' => $post['id_user']]);
                ?>
                <div class="post row">
                    <div class="img col-12 col-md-4">
                        <img src="<?=BASE_URL . 'assets/img/posts/' . $post['img']; ?>" alt="<?=$post['title']?>" class="img-thumbnail">
                    </div>
                    <div class="post_text col-12 col-md-8">
                        <h3>
                            <a href="<?=BASE_URL . 'single.php?post=' . $post['id'];?>"><?= substr($post['title'], 0, 120) . '...' ?></a>
                        </h3>
                        <i class="far fa-user"> <?=$user['username'];?> </i>
                        <i class="far fa-calendar"> <?=$post['created_data']; ?> </i>
                        <p class="prewiew-text">
                            <?=mb_substr($post['content'], 0, 150, 'UTF-8') . '...' ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div id="TWO" style="display: none;" class="mymap">
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
            const hue = Math.random() * 180 + 10; // случайный оттенок в диапазоне от 30 до 90 (желтый до красного)
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
            </div>

        </div>
        <!--SIDEBAR-->
        <div class="sidebar col-md-3 col-12">

<div class="section search">
                <h3>Search</h3>
                <form action="search.php" method="post">
                    <input type="text" name="search-term" class="text-input" placeholder="Search...">
                </form>
            </div>
            <div class="section topics">
                <h3>Topics</h3>
                <ul>
                    <?php foreach ($topics as $key => $topic): ?>
                    <li><a href="<?=BASE_URL . 'category.php?id=' . $topic['id']; ?>"><?=$topic['name']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

</div>
<!--БЛОК main end-->

<!--FOOTER-->
<?php include("app/include/footer.php"); ?>
<!--FOOTER end-->

</body>
</html>
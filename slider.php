<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color Slider</title>
    <link rel="stylesheet" href="slider.scss">
</head>
<body>
<header>
    <h1>Header</h1>
</header>

<!-- Slider mixin usage -->
<div class="slider-container">
    <input class="slider" type="range" name="color" min="0" max="100" step="1" id="color">
    <div class="value">180</div>
</div>

<script src="slider.js"></script>
</body>
</html>

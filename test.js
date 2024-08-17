document.addEventListener("DOMContentLoaded", function () {
  const slider = document.querySelector(".slider");
  const body = document.body;

  function updateColors(value) {
    const hue = value * 3.5;
    const hue1 = value * 3.5;
    const saturation = 6; // Насыщенность фона
    const backgroundLightness = 40; // Яркость фона
    const headersaturation = 35; // Насыщенность header
    const headerLightness = 85; // яркость header
    const thumbsaturation = 100; // Насыщенность ползунка
    const thumbLightness = 40; // Яркость ползунка
    const backgroundColor = `hsl(${
      (hue1 - 115) % 360
    }, ${saturation}%, ${backgroundLightness}%)`;
    const thumbColor = `hsl(${
      (hue1 - 165) % 360
    }, ${thumbsaturation}%, ${thumbLightness}%)`;
    const headerColor = `hsl(${
      (hue1 - 35) % 360
    }, ${headersaturation}%, ${headerLightness}%)`;

    document.documentElement.style.setProperty(
      "--background-color",
      backgroundColor
    );
    document.documentElement.style.setProperty("--header-color", headerColor);
    document.documentElement.style.setProperty("--thumb-color", thumbColor);
  }

  slider.addEventListener("input", function () {
    const value = this.value;
    this.nextElementSibling.textContent = value;
    updateColors(value);
    // Сохраняем значение слайдера в Local Storage
    localStorage.setItem("sliderValue", value);
  });

  // Проверяем, есть ли значение в Local Storage при загрузке страницы
  const savedValue = localStorage.getItem("sliderValue");
  if (savedValue !== null) {
    // Устанавливаем значение слайдера из Local Storage
    slider.value = savedValue;
    slider.nextElementSibling.textContent = savedValue;
    updateColors(savedValue);
  } else {
    // Если значение не было сохранено, используем значение по умолчанию
    slider.value = 50; // Например, значение по умолчанию 50
    slider.nextElementSibling.textContent = 50;
    updateColors(50);
  }
});

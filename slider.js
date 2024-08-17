document.addEventListener("DOMContentLoaded", function () {
  const slider = document.querySelector(".slider");
  const body = document.body;
  const header = document.querySelector("header");

  function updateColors(value) {
    const hue = value * 5;
    const hue1 = value * 5;
    const saturation = 15; // Насыщенность фона
    const headersaturation = 75; // Насыщенность header
    const thumbsaturation = 100; // Насыщенность ползунка
    const backgroundLightness = 45; // Яркость фона
    const thumbLightness = 50; // Яркость ползунка
    const headerLightness = 85; // Яркость header
    const backgroundColor = `hsl(${
      (hue1 + 10) % 360
    }, ${saturation}%, ${backgroundLightness}%)`;
    const thumbColor = `hsl(${
      (hue1 + 10) % 360
    }, ${thumbsaturation}%, ${thumbLightness}%)`;
    const headerColor = `hsl(${
      (hue1 + 80) % 360
    }, ${headersaturation}%, ${headerLightness}%)`;

    body.style.backgroundColor = backgroundColor;
    header.style.backgroundColor = headerColor;

    // Обновление цвета ползунка
    const slider = document.querySelector(".slider");
    slider.style.setProperty("--thumb-color", thumbColor);

    const css = `
        .slider::-webkit-slider-thumb {
          background: ${thumbColor};
        }
        .slider::-moz-range-thumb {
          background: ${thumbColor};
        }
      `;

    const styleSheet = document.createElement("style");
    styleSheet.type = "text/css";
    styleSheet.innerText = css;
    document.head.appendChild(styleSheet);
  }

  // Считывание значения из localStorage
  const savedValue = localStorage.getItem("sliderValue");
  if (savedValue !== null) {
    slider.value = savedValue;
    slider.nextElementSibling.textContent = savedValue;
    updateColors(savedValue);
  } else {
    updateColors(slider.value);
  }

  slider.addEventListener("input", function () {
    const value = this.value;
    this.nextElementSibling.textContent = value;
    updateColors(value);
    // Сохранение значения в localStorage
    localStorage.setItem("sliderValue", value);
  });
});

let checkAll = document.getElementById("checkAll");
checkAll.onclick = () => {
  if (checkAll.checked) {
    let elements = document.getElementsByClassName("içecek");
    for (item of elements) {
      if (item.style.display === "none") {
      } else {
        item.firstChild.checked = true;
      }
    }

    elements = document.getElementsByClassName("yiyecek");
    for (item of elements) {
      for (item of elements) {
        if (item.style.display === "none") {
        } else {
          item.firstChild.checked = true;
        }
      }
    }
    elements = document.getElementsByClassName("both");
    for (item of elements) {
      for (item of elements) {
        if (item.style.display === "none") {
        } else {
          item.firstChild.checked = true;
        }
      }
    }
  } else {
    let elements = document.getElementsByClassName("both");
    for (item of elements) {
      for (item of elements) {
        if (item.style.display === "none") {
        } else {
          item.firstChild.checked = false;
        }
      }
    }
    elements = document.getElementsByClassName("içecek");
    for (item of elements) {
      if (item.style.display === "none") {
      } else {
        item.firstChild.checked = false;
      }
    }

    elements = document.getElementsByClassName("yiyecek");
    for (item of elements) {
      for (item of elements) {
        if (item.style.display === "none") {
        } else {
          item.firstChild.checked = false;
        }
      }
    }
  }
};
let button = document.getElementById("onayButonu");
let yiyecekler = [
  "Bal",
  "Çikolata",
  "Bitkisel Yağ ve Margarin",
  "Süt ve Süt ürünleri",
  "Et ve Et ürünleri",
];
let içecekler = [
  "Alkollü İçecekler",
  "Alkolsüz İçecekler",
  "Çay,Kahve,Bitki Çayı",
];
let takviyeEdiciGıdalar = "Takviye Edici Gıdalar";

let yıl1 = document.getElementById("yıl1");
let yıl2 = document.getElementById("yıl2");
yıl1.onclick = () => {
  let yil1childs = yıl1.childNodes;
  for (item of yil1childs)
    if (item.className == "option") item.style.display = "block";
};
yıl1.onchange = (ev) => {
  yil1Value = yıl1.value;
  let yil2childs = yıl2.childNodes;
  for (item of yil2childs) {
    if (item.className == "option" && yil1Value >= item.innerText) {
      item.style.display = "none";
    } else if (item.className == "option" && yil1Value < item.innerText) {
      item.style.display = "block";
    }
  }
};

yıl2.onchange = (ev) => {
  yil2Value = yıl2.value;
  let yil1childs = yıl1.childNodes;

  for (item of yil1childs) {
    if (item.className == "option" && yil2Value < item.innerText) {
      item.style.display = "none";
    } else if (item.className == "option" && yil2Value >= item.innerText) {
      item.style.display = "block";
    }
  }
};
function addMap(startYear, endYear) {
  let divs = [];
  counter = 0;
  for (let i = startYear; i <= endYear; i++) {
    if (i == 2017) {
    } else {
      let div = createMapDivs(i);
      let childNodes = div.childNodes;
      childNodes[0].innerText = counter + 1 + "/" + (endYear - startYear + 1);
      if (counter != 0) childNodes[1].id = "chart" + counter;
      else childNodes[1].id = "chart";
      counter++;
      divs.push(div);
    }
  }
  for (item of divs) {
    document
      .getElementsByClassName("slideshow-container")[0]
      .insertBefore(
        item,
        document.getElementsByClassName("slideshow-container")[0].firstChild
      );
  }
  document.getElementsByClassName("prev")[0].click();
}

function createMapDivs(year) {
  let mySlidesFade = document.createElement("div");
  mySlidesFade.className = "mySlides";
  let numberText = document.createElement("div");
  numberText.className = "numberText";
  let mapDiv = document.createElement("div");
  mapDiv.className = "mapDiv";
  mapDiv.style.width = "100%";
  mapDiv.style.height = "550px";

  let text = document.createElement("div");
  text.className = "text";
  mySlidesFade.appendChild(numberText);
  mySlidesFade.appendChild(mapDiv);
  mySlidesFade.appendChild(text);
  return mySlidesFade;
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides((slideIndex += n));
}

function currentSlide(n) {
  showSlides((slideIndex = n));
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");

  if (n > slides.length) {
    slideIndex = 1;
  }
  if (n < 1) {
    slideIndex = slides.length;
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  if (slides[slideIndex - 1] != undefined)
    slides[slideIndex - 1].style.display = "block";
}

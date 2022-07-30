//  Dark Mode for All Pages
let hour = new Date().getHours();
// console.log(hour);
// hour = 12;
if (hour >= 18 || hour < 6) {
  const background = document.querySelector("body");
  background.style.backgroundColor = "black";
  background.style.color = "white";
  const title = document.querySelector("h1");
  title.style.borderBottom = "1px solid white";
  const footer = document.querySelector("footer");
  footer.style.borderTop = "1px solid white";
  const footerPar = document.querySelector("footer > p > a");
  footerPar.style.color = "white";
  footerPar.style.textDecorationColor = "white";
}

//Identify the date of the week
function changeIcon() {
  let date = new Date().getDay();
  // console.log(date);
  let icon = document.querySelector("header > section > img");
  // console.log(icon);
  if (date == 1) {
    icon.src = "images/icons/icons8-monday-100.png";
  } else if (date == 2) {
    icon.src = "images/icons/icons8-tuesday-100.png";
  } else if (date == 3) {
    icon.src = "images/icons/icons8-wednesday-100.png";
  } else if (date == 4) {
    icon.src = "images/icons/icons8-thursday-100.png";
  } else if (date == 5) {
    icon.src = "images/icons/icons8-friday-100.png";
  } else if (date == 6) {
    icon.src = "images/icons/icons8-saturday-100.png";
  } else if (date == 0) {
    icon.src = "images/icons/icons8-sunday-100.png";
  }
}
changeIcon();

// Fade out for the nav Bar
let buttons = document.querySelectorAll("nav > a");
// console.log(buttons);
function changeOpacity() {
  for (let i = 0; i < buttons.length; i++) {
    buttons[i].style.opacity = "0.5";
  }
  this.style.opacity = "1";
}
function resetOpacity() {
  for (let i = 0; i < buttons.length; i++) {
    buttons[i].style.opacity = "1";
  }
}
for (let i = 0; i < buttons.length; i++) {
  buttons[i].addEventListener("mouseover", changeOpacity);
  buttons[i].addEventListener("mouseout", resetOpacity);
}

// Change the image on index.html
let figure = document.querySelector("#npandpd");
console.log(figure);
function changeFigure() {
  this.src = "images/replace.png";
  this.srcset = "images/replace-2x.png";
}
function showOriginalImage() {
  this.src = "images/npandpd.png";
  this.srcset = "images/npandpd-2x.png";
}

figure.addEventListener("mousedown", changeFigure);
figure.addEventListener("mouseup", showOriginalImage);

// console.log(figures);

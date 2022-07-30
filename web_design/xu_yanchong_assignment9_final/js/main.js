//Identify the date of the week
function changeIcon() {
  let date = new Date().getDay();
  // console.log(date);
  let icon = document.querySelector("header > img");
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

//
let button = document.querySelector("div > img");
console.log(button);
function showTime() {
  let date = new Date();
  let hour = date.getHours();
  let minute = date.getMinutes();
  console.log(hour, minute);
  let p = document.querySelector("div > p");
  p.innerHTML = hour + ":" + minute;
}
function hideTime() {
  let p = document.querySelector("div > p");
  p.innerHTML = "Click to see what time it is now!";
}

button.addEventListener("mousedown", showTime);
button.addEventListener("mouseup", hideTime);
// showTime();

window.onload = function () {
  let navbar = document.querySelector(".navbar");

  document.querySelector("#menu-btn").onclick = () => {
    navbar.classList.toggle("active");
  };
};


function setLikeDislike(type,id){
  alert(type);
  alert(id);
}
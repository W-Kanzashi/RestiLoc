const handleOpenClientFolder = () => {
  document.getElementById("clientFolder").classList.remove("hidden");

  let element = document.getElementById("clientFolder");

  element.innerHTML = "hello";
  console.log("hello");
};

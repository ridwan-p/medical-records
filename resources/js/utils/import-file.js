document.addEventListener('click', function(event) {
  if (event.target.matches('.import-file')) {
    let item = document.querySelector(event.target.dataset.target)
    item.click()
  }
}, false);

document.addEventListener('change', function(event) {
  if (event.target.matches('.import-file-upload')) {
    event.target.closest('form').submit()
  }

  if(event.target.matches('.custom-file-input')) {
    const fileName = event.target.files[0].name;
    let nextSibling = event.target.nextElementSibling
    nextSibling.innerText = fileName
  }
})
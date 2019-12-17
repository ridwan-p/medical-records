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
})
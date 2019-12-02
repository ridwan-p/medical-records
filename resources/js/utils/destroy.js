document.addEventListener('click', (event) => {
  const target = event.target

	if(target.dataset.action === 'destroy') {
    event.preventDefault()

		const form = document.querySelector(target.dataset.target);
    if(form && confirm(target.dataset.message)) {
      form.setAttribute('action',target.getAttribute('href'))
      form.submit()
		}
	}
})
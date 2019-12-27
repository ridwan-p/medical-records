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

  if(target.matches(".checkbox-selected")) {
    // event.preventDefault()
    const table = target.closest('table')
    const checks = table.querySelectorAll('tbody .checkbox-selected');
    const checkHead = table.querySelector('thead .checkbox-selected');

    if(target.dataset.action === 'all') {
      for(let i of checks) {
        i.checked = checkHead.checked ? true : false
      }
    } else {
      checkHead.checked = false;
      for(let i of checks) {
        if(i.checked) { checkHead.checked = true;  }
      }
    }

  }
}, false)
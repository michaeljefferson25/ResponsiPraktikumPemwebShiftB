document.querySelectorAll('[data-confirm]').forEach((element) => {
    element.addEventListener('click', (event) => {
        if (!confirm(element.dataset.confirm)) {
            event.preventDefault();
        }
    });
});

document.querySelectorAll('.alert').forEach((element) => {
    setTimeout(() => {
        element.classList.add('hide');
    }, 4500);
});

const eleDelete = document.querySelectorAll('.js_delete');
if (eleDelete) {
    eleDelete.forEach(function (element) {
        element.addEventListener('click', function(event) {
            event.preventDefault();
            let confirmDelete = confirm("削除してよろしいですか？");
            if (confirmDelete) {
                this.closest('form').submit();
            }
        });
    });
    
}


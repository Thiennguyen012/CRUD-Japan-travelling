document.getElementById('image').addEventListener('change', function(event) {
    previewImg(event.target);
});

const jsConfirm = document.getElementById('js_confirm');
if (jsConfirm) {
    jsConfirm.addEventListener('click', function(event) {
        showConfirmPage();
    });
}
const jsBackConfirm = document.getElementById('js_back_confirm');
if (jsBackConfirm) {
    jsBackConfirm.addEventListener('click', function(event) {
        document.getElementById('form_edit').classList.remove('d-none');
        document.getElementById('form_confirm').classList.add('d-none');
    });
}

document.getElementById('icon-upload').addEventListener('click', function(event) {
    document.getElementById('image').click();
});
// preview image
function previewImg(inpFileElement) {
    const file = inpFileElement.files[0];
    const imagePreview = document.getElementById('image_preview');
    const cfImagePreview = document.getElementById('cf_image_preview');
    const cfImageUnset = document.getElementById('cf_image_unset');
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            // edit screen
            imagePreview.classList.remove('d-none');
            imagePreview.src = e.target.result;
            // confirm screen
            if (cfImagePreview) {
                cfImagePreview.src = e.target.result;
            }
            if (cfImageUnset) {
                cfImageUnset.textContent = '';
            }
        }
        
        reader.readAsDataURL(file);
    } else {
        // edit screen
        imagePreview.classList.add('d-none');
        // confirm screen
        if (cfImagePreview) {
            cfImagePreview.classList.add('d-none');
        }
        if (cfImageUnset) {
            cfImageUnset.textContent = 'なし';
        }
    }
}
// show data confirm
function showConfirmPage() {
    document.getElementById('form_edit').classList.add('d-none');
    document.getElementById('form_confirm').classList.remove('d-none');
    // previewImg(document.querySelector('#image'));
    let hotelName = document.getElementById('hotel_name').value;
    let prefectureOption = document.getElementById('prefecture_id');
    let prefectureName = prefectureOption.options[prefectureOption.selectedIndex].text;
    document.getElementById('cf_hotel_name').textContent = hotelName;
    document.getElementById('cf_prefecture').textContent = prefectureName;
}


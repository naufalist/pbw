// $(document).ready(function () {
//     alert('tes');
// });
function previewImg() {
  const sampul = document.querySelector('#foto');
  const sampulLabel = document.querySelector('.custom-file-label');
  const imgPreview = document.querySelector('.img-preview');

  // ganti url
  sampulLabel.textContent = sampul.files[0].name;

  // ganti preview
  const fileSampul = new FileReader();
  fileSampul.readAsDataURL(sampul.files[0]);

  fileSampul.onload = function(e) {
    imgPreview.src = e.target.result;
  }
}
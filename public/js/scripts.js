function imgPreview()
{
  const image = document.querySelector('#foto');
  const imgPreview = document.querySelector('.img-preview');

  const oFReader = new FileReader();

  oFReader.readAsDataURL(image.files[0]);

  oFReader.onload = function(oFREvent){
    imgPreview.src = oFREvent.target.result;
  }

}

// data tabel
$(document).ready(function() {
  $('#dataTable').DataTable({
      "ordering" : false,
      // "lengthMenu" : false,
      // "lengthChange" : false,
      "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
      "bInfo" : false,
      "pageLength" : 15,
      "pagingType" : "numbers"
  })
});

// lihat password
$(document).on('click', '#lihatPassword', function(){

  const password = document.querySelector('#password');

  if(password.type == 'password'){
    password.type = 'text'
  }else{
    password.type = 'password';
  }

})

// calendar
$(function(){
  $(".datepicker").datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
  });
});

// jam digital
setInterval(function(){

  var ampm = '';
  var jam = new Date().getHours();
  var menit = new Date().getMinutes();
  var detik = new Date().getSeconds();

  if(jam < 12) {
        ampm = "am";
    }else {
        ampm = "pm";
    }

    if(jam <= 9){
      jam = "0"+jam;
    }

    if(menit <= 9){
      menit = "0"+menit;
    }

    if(detik <= 9){
      detik = "0"+detik;
    }

    document.getElementById("jam-digital").innerHTML = jam + ' : ' + menit + ' : ' + detik + ' ' + ampm;
   
 }, 1000);







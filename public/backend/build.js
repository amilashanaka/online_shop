(function ($) {


    $('.textarea').summernote({
      height: 350,
    });

    $('#keywords').selectize({
        plugins: ['remove_button'],
        delimiter: ',',
        persist: false,
        create: function(input) {
            return {
                value: input,
                text: input
            }
        }
    });

    $('#keywords_sub').selectize({
        plugins: ['remove_button'],
        delimiter: ',',
        persist: false,
        create: function(input) {
            return {
                value: input,
                text: input
            }
        }
    });

 	$('.select2').select2();

    $("#example1").DataTable();


    $("#order_tbl").DataTable({
        "order": [[ 0, "desc" ]],
        "bFilter": false
    });

    $('.datepicker').datepicker({
        // minDate: 0,
        dateFormat: 'yy-mm-dd'
    });

    $('.datepicker-reports').datepicker({
        dateFormat: 'yy-mm-dd'
    });

    $('#reporting').dataTable({
      dom: 'Bfrtip',
      buttons: [
           'excel', 'pdf', 'print'
      ]
    });
     
    $("#logout-click").on("click", function(){
      alertify.confirm("Are you sure you want to Logout?",
            function(){
                document.getElementById('logout-form').submit();
          });
    });

     // item images preview

    $("#img").change(function() {
      if (this.files) {
        var files = event.target.files;
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#image_preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
      }
    });
    
    $("#img_2").change(function() {
      if (this.files) {
        var files = event.target.files;
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#image_preview_2').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
      }
    });

    $("#img_3").change(function() {
      if (this.files) {
        var files = event.target.files;
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#image_preview_3').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
      }
    });

    $("#img_4").change(function() {
      if (this.files) {
        var files = event.target.files;
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#image_preview_4').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
      }
    });

    $("#img_5").change(function() {
      if (this.files) {
        var files = event.target.files;
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#image_preview_5').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
      }
    });

    $("#pro_img").change(function() {
      if (this.files) {

        $.LoadingOverlay("show");
        var files = event.target.files;
        var formData = new FormData();
        if(files.length > 0 ){
           formData.append('media',this.files[0]);

          $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: base_url + "/admin/products/images/upload",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data_out) {
              console.log(data_out)
              $('#temp_img_1').val(data_out);
              $('#pro_image_preview_1').attr('src', data_out);
            }
          });
        }

        $.LoadingOverlay("hide");
      }
    });

    $("#pro_img_2").change(function() {
      if (this.files) {

        $.LoadingOverlay("show");
        var files = event.target.files;
        var formData = new FormData();
        if(files.length > 0 ){
           formData.append('media',this.files[0]);

          $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: base_url + "/admin/products/images/upload",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data_out) {
              $('#temp_img_2').val(data_out);
              $('#pro_image_preview_2').attr('src', data_out);
            }
          });
        }

        $.LoadingOverlay("hide");
      }
    });

    $("#pro_img_3").change(function() {
      if (this.files) {

        $.LoadingOverlay("show");
        var files = event.target.files;
        var formData = new FormData();
        if(files.length > 0 ){
           formData.append('media',this.files[0]);

          $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: base_url + "/admin/products/images/upload",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data_out) {
              $('#temp_img_3').val(data_out);
              $('#pro_image_preview_3').attr('src', data_out);
            }
          });
        }

        $.LoadingOverlay("hide");
      }
    });

    $("#pro_img_4").change(function() {
      if (this.files) {

        $.LoadingOverlay("show");
        var files = event.target.files;
        var formData = new FormData();
        if(files.length > 0 ){
           formData.append('media',this.files[0]);

          $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: base_url + "/admin/products/images/upload",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data_out) {
              $('#temp_img_4').val(data_out);
              $('#pro_image_preview_4').attr('src', data_out);
            }
          });
        }

        $.LoadingOverlay("hide");
      }
    });

    $("#pro_img_5").change(function() {
      if (this.files) {

        $.LoadingOverlay("show");
        var files = event.target.files;
        var formData = new FormData();
        if(files.length > 0 ){
           formData.append('media',this.files[0]);

          $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: base_url + "/admin/products/images/upload",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data_out) {
              $('#temp_img_5').val(data_out);
              $('#pro_image_preview_5').attr('src', data_out);
            }
          });
        }

        $.LoadingOverlay("hide");
      }
    });




    



    
})(jQuery); 
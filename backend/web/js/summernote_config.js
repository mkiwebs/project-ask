jQuery(document).ready(function($) {
    //summernote
    $('#blogarticle-article_content').summernote(
    {
      height: 300,                 // set editor height
      minHeight: null,             // set minimum height of editor
      maxHeight: null,             // set maximum height of editor
      dialogsInBody: true,
      dialogsFade: true,
      focus: false,
      fontSize: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '30', '36', '48' , '64'],
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'image', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ],
      fontNamesIgnoreCheck: ["Roboto"],
                       fontNames: ["Roboto","Arial", "Arial Black", "Comic Sans MS", "Courier New",
                                   "Helvetica Neue", "Helvetica", "Impact", "Lucida Grande",
                                   "Tahoma", "Times New Roman", "Verdana"],
      popover: {
              image: [
            ['custom', ['imageAttributes']],
            ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
            ['float', ['floatLeft', 'floatRight', 'floatNone']],
            ['remove', ['removeMedia']]
        ],
      },
      buttons: {
          image: function() {
          var ui = $.summernote.ui;   
          // create button
          var button = ui.button({
            contents: '<i class="note-icon-picture" />',
            tooltip: $.summernote.lang[$.summernote.options.lang].image.image,
            click: function () {
              $('#modal-image').remove();
              
              $.ajax({
                //url: 'http://localhost/projects/advanced/backend/web/files/upload',
                url: 'http://lyfey.ovicko.com/files/upload',
                dataType: 'html',
                beforeSend: function() {
                  $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                  $('#button-image').prop('disabled', true);
                },
                complete: function() {
                  $('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
                  $('#button-image').prop('disabled', false);
                },
                success: function(html) {
                  console.log(html);
                  $('body').append('<div id="modal-image" class="modal">' + html + '</div>');
                  
                  $('#modal-image').modal('show');
                  
                  $('#modal-image').delegate('a.thumbnail', 'click', function(e) {
                    e.preventDefault();
                    
                    $(element).summernote('insertImage', $(this).attr('href'));
                                  
                    $('#modal-image').modal('hide');
                  });
                }
              });           
            }
          });
        
          return button.render();
        }
        }
    })

    // Image Manager
    $(document).delegate('a[data-toggle=\'image\']', 'click', function(e) {
      e.preventDefault();
      $('.popover').popover('hide', function() {
        $('.popover').remove();
      });
      var element = this;
      $(element).popover({
        html: true,
        placement: 'right',
        trigger: 'manual',
        content: function() {
          return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" style="display:none" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
        }
      });
      $(element).popover('show');
      $('#button-image').on('click', function() {
        $('#modal-image').remove();
        $.ajax({
          url: 'index.php?route=common/filemanager&token=&target=' + $(element).parent().find('input').attr('id') + '&thumb=' + $(element).attr('id'),
          dataType: 'html',
          beforeSend: function() {
            $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
            $('#button-image').prop('disabled', true);
          },
          complete: function() {
            $('#button-image i').replaceWith('<i class="fa fa-pencil"></i>');
            $('#button-image').prop('disabled', false);
          },
          success: function(html) {
            $('body').append('<div id="modal-image" class="modal">' + html + '</div>');
            $('#modal-image').modal('show');
          }
        });
        $(element).popover('hide', function() {
          $('.popover').remove();
        });
      });   
      $('#button-clear').on('click', function() {
        $(element).find('img').attr('src', $(element).find('img').attr('data-placeholder'));
        $(element).parent().find('input').attr('value', '');
        $(element).popover('hide', function() {
          $('.popover').remove();
        });
      });
    });
});
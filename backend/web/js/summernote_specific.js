  $(document).ready(function() {  
        $('#blogarticle-article_content').summernote({  
            height: "500px", 
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,                // set focus to editable area after initializing summernote
            dialogsInBody: true,
            fontSize: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '30', '36', '48' , '64'],
            callbacks: {  
                onImageUpload: function(files) { //the onImageUpload API  
                  $('#modal-image').remove();
                    img = sendFile(files[0]);  
            }  
        }  
        }); 
        $('#question-question_answer').summernote({  
            height: "500px", 
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,                // set focus to editable area after initializing summernote
            dialogsInBody: true,
            callbacks: {  
                onImageUpload: function(files) { //the onImageUpload API  
                  $('#modal-image').remove();
                    img = questionFile(files[0]);  
            }  
        }  
        });

        $('#appevent-description').summernote({  
            height: "200px", 
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,                // set focus to editable area after initializing summernote
            dialogsInBody: true,
            callbacks: {  
                onImageUpload: function(files) { //the onImageUpload API  
                  $('#modal-image').remove();
                    img = eventFile(files[0]);  
            }  
        }  
        }); 

         $('#meme-test_content').summernote({  
            height: "200px", 
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,                // set focus to editable area after initializing summernote
            dialogsInBody: true,
            callbacks: {  
                onImageUpload: function(files) { //the onImageUpload API  
                  $('#modal-image').remove();
                    img = eventFile(files[0]);  
            }  
        }  
        }); 


         $('#question-content').summernote({  
            height: "200px", 
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,                // set focus to editable area after initializing summernote
            dialogsInBody: true,
            callbacks: {  
                onImageUpload: function(files) { //the onImageUpload API  
                  $('#modal-image').remove();
                    img = eventFile(files[0]);  
            }  
        }  
        });        
        $('#qtest-content').summernote({  
            height: "200px", 
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,                // set focus to editable area after initializing summernote
            dialogsInBody: true,
            callbacks: {  
                onImageUpload: function(files) { //the onImageUpload API  
                  $('#modal-image').remove();
                    img = eventFile(files[0]);  
            }  
        }  
        });        
         $('#memecomment-content').summernote({  
            height: "200px", 
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,                // set focus to editable area after initializing summernote
            dialogsInBody: true,
            callbacks: {  
                onImageUpload: function(files) { //the onImageUpload API  
                  $('#modal-image').remove();
                    img = eventFile(files[0]);  
            }  
        }  
        });            
         $('#qcomment-content').summernote({  
            height: "200px", 
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,                // set focus to editable area after initializing summernote
            dialogsInBody: true,
            callbacks: {  
                onImageUpload: function(files) { //the onImageUpload API  
                  $('#modal-image').remove();
                    img = eventFile(files[0]);  
            }  
        }  
        });   
    });  
      
    function sendFile(file) {  
        data = new FormData();  
        data.append("file", file); 
        data.append("_csrf",'<?=Yii::$app->request->getCsrfToken()?>') 
        $.ajax({  
            data: data,  
            type: "POST",  
            //url: "http://localhost/projects/summernote_upload.php" ,  
            url: "http://localhost/projects/advanced/backend/web/files/summernote" , 
            //url: 'http://lyfey.ovicko.com/files/summernote',
            cache: false,  
            contentType: false,  
            processData: false, 
            success: function(response) {  
                  console.log(response);
                  $("#blogarticle-article_content").summernote('insertImage', response, 'image name'); // the insertImage API  
            }  
        });  
    }

    function eventFile(file) {  
        data = new FormData();  
        data.append("file", file); 
        data.append("_csrf",'<?=Yii::$app->request->getCsrfToken()?>') 
        $.ajax({  
            data: data,  
            type: "POST",  
            //url: "http://localhost/projects/summernote_upload.php" ,  
            url: "http://localhost/projects/advanced/backend/web/files/summernote" , 
            //url: 'http://lyfey.ovicko.com/files/summernote',
            cache: false,  
            contentType: false,  
            processData: false, 
            success: function(response) {  
                  console.log(response);
                  $("#appevent-description").summernote('insertImage', response, 'image name'); // the insertImage API  
            }  
        });  
    }

     function questionFile(file) {  
        data = new FormData();  
        data.append("file", file); 
        data.append("_csrf",'<?=Yii::$app->request->getCsrfToken()?>') 
        $.ajax({  
            data: data,  
            type: "POST",  
            //url: "http://localhost/projects/summernote_upload.php" ,  
            //url: "http://localhost/projects/advanced/backend/web/files/summernote" , 
            url: 'http://lyfey.ovicko.com/files/summernote',
            cache: false,  
            contentType: false,  
            processData: false, 
            success: function(response) {  
                  console.log(response);
                  $("#question-question_answer").summernote('insertImage', response, 'image name'); // the insertImage API  
            }  
        });  
    }


tinymce.init({
  /* replace textarea having class .tinymce with tinymce editor */
  selector: "textarea.tinymce",
  setup: function (editor) {
      editor.on('change', function () {
          editor.save();
      });
  },
  fontsize_formats:
    "8px 10px 12px 14px 15px 16px 18px 20px 22px 25px 28px 30px 36px 48px 60px 72px 96px",
  
  /* theme of the editor */
  theme: "modern",
  skin: "lightgray",
  
  /* width and height of the editor */
  width: "100%",
  height: 1000,
  
  /* display statusbar */
  statubar: true,
  
  /* plugin */
  plugins: [
    "advlist link image lists charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
    "save table contextmenu directionality emoticons template paste textcolor code"
  ],

  /* toolbar */
  toolbar: "insertfile undo redo | styleselect | bold italic | fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image code | print preview media fullpage | forecolor backcolor emoticons",
  
  /* style */
  style_formats: [
    {title: "Headers", items: [
      {title: "Header 1", format: "h1"},
      {title: "Header 2", format: "h2"},
      {title: "Header 3", format: "h3"},
      {title: "Header 4", format: "h4"},
      {title: "Header 5", format: "h5"},
      {title: "Header 6", format: "h6"}
    ]},
    {title: "Inline", items: [
      {title: "Bold", icon: "bold", format: "bold"},
      {title: "Italic", icon: "italic", format: "italic"},
      {title: "Underline", icon: "underline", format: "underline"},
      {title: "Strikethrough", icon: "strikethrough", format: "strikethrough"},
      {title: "Superscript", icon: "superscript", format: "superscript"},
      {title: "Subscript", icon: "subscript", format: "subscript"},
      {title: "Code", icon: "code", format: "code"}
    ]},
    {title: "Blocks", items: [
      {title: "Paragraph", format: "p"},
      {title: "Blockquote", format: "blockquote"},
      {title: "Div", format: "div"},
      {title: "Pre", format: "pre"}
    ]},
    {title: "Alignment", items: [
      {title: "Left", icon: "alignleft", format: "alignleft"},
      {title: "Center", icon: "aligncenter", format: "aligncenter"},
      {title: "Right", icon: "alignright", format: "alignright"},
      {title: "Justify", icon: "alignjustify", format: "alignjustify"}
    ]}
  ],
  document_base_url:$("input[name=base_url]").val(),
   file_picker_callback: function(callback, value, meta) {
    // Provide file and text for the link dialog
    if (meta.filetype == 'file') {
      callback('mypage.html', {text: 'My text'});
    }

    // Provide image and alt text for the image dialog
    if (meta.filetype == 'image') {
      event.preventDefault();
      $('.list_media').toggleClass('editor_media');
      $('#mediaModal').modal('show');
      ajaxlistMedia();
      $(document).on('click', '.list_media.editor_media .media_img', function(event) {
        event.preventDefault();
        $('.media_item').removeClass('active');
        parent = $(this).closest('.media_item');
        parent.toggleClass('active');
        src = $(this).data('src');
        alt = $(this).find('img').attr('alt')
        callback(src, {alt: alt});
      });
    }

    // Provide alternative source and posted for the media dialog
    if (meta.filetype == 'media') {
      callback('movie.mp4', {source2: 'alt.ogg', poster: 'image.jpg'});
    }
  }
});

var ajaxlistMedia = function(){
  $.ajax({
    url: 'admin/media-ajax',
    type: 'GET',
  })
  .done(function(data) {
    $('.list_media_ajax').html(data);
    })
}


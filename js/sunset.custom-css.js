jQuery(document).ready(function ($) {
    let updateCSS = function(){
        $('#sunset_css').val(editor.getSession().getValue());
    };
    $('#save-custom-css-form').submit(updateCSS);

});

let editor = ace.edit('customCSS');

editor.setTheme('ace/theme/monokai');
editor.getSession().setMode('ace/mode/css');
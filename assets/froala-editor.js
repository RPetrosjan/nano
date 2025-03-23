import './styles/froala-editor.scss';
import $ from "jquery";


let FroalaEditor = require('froala-editor');
require('froala-editor/js/plugins/code_view.min');
require('froala-editor/js/plugins/inline_class.min');
require('froala-editor/js/plugins/markdown.min');
require('froala-editor/js/plugins/colors.min');
require('froala-editor/js/plugins/fullscreen.min');
require('froala-editor/js/plugins/font_size.min');
require('froala-editor/js/plugins/font_family.min');
require('froala-editor/js/plugins/link.min');


var editor = new FroalaEditor('#Questions_documentation_text', {
    theme: 'dark',
    pluginsEnabled: ['codeView', 'inlineClass', 'markdown', 'colors', 'fullscreen', 'fontSize', 'fontFamily', 'link'],
    codeViewKeepActiveButtons: ['selectAll'],
    events: {
        'codeView.update': function () {
            // Do something here.
            // this is the editor instance.
            document.getElementById("eg-previewer").textContent = this.codeView.get ();
        }
    }
});

/*
window.onload = function() {
    setTimeout(function (){
        $('a:contains("Unlicensed copy of the Froala Editor. Use it legally by purchasing a license.")').parent().addClass('d-none');
    }, 100);
}
*/




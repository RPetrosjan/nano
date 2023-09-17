/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';
const bootstrap = require('bootstrap');

let reponse = null;
let right = null;
function reDom(){
    $('.selectors>div').click(function (){
        $('.selectors>div').removeClass('select');
        reponse = $(this).text();
        $(this).addClass('select')
    });
}

function getQuestion(){
    $.post( "/ajaxmots", function( data ) {
        $('.title').text(data.question);
        $('.titleshadow').text(data.question);
        let htmlValues = '';
        data.reponses.forEach(function (value){
            htmlValues += '<div>'+value+'</div>';
        });
        right = data.right;
        $('.selectors').html(htmlValues);
        reDom();
    });
}

window.onload = function() {
    if (window.jQuery) {
        getQuestion();
        $('#valider').click(function (){
            if( $('#showalert').hasClass('show')) {
                $('#showalert').removeClass('show');
                getQuestion();
                $('#valider').text('Valider');
            }
            else {
                $('#showalert').removeClass('alert-danger').removeClass('alert-success');
                if (reponse == right) {
                    $('#showalert').addClass('alert-success');
                    $('#showalert>strong').text('Bravo!');
                } else {
                    $('#showalert').addClass('alert-danger');
                    $('#showalert>strong').text('Zut!'+ ' - '+right);
                }
                $('#showalert').addClass('show');
                $('#valider').text('Suivant');
            }
        })
    } else {
        // jQuery is not loaded
        alert("Doesn't Work");
    }
}
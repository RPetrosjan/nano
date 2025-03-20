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

let total = 15;
let rht = 0;
let fht = 0;

let numeroQuestion = 0;

function intitilize(){
    total = 15;
    rht = 0;
    fht = 0;
}

function makeProgress(){
    let procent_rht = rht * 100 / total;
    let procet_fht = fht * 100 / total;

    $('#rht').width(procent_rht+'%').text(rht);
    $('#fht').width(procet_fht+'%').text(fht);
    $('#step').text(rht+fht);
    $('#qtotal').text(total);
}

let question = null;

function reDom(){
    $('.selectors>div').click(function (){
        $('.selectors>div').removeClass('select');
        $(this).addClass('select')
    });
}

function sendAjaxReponse(type, reponse){
    let url = ''
    if(type == false){
        url ='/addfauxreponse/'+reponse;
    }
    else{
        url ='/addrighreponse/'+reponse;
    }

    $.post(url, function (data) {

    })
}

function getQuestion(){

    let url = "/ajaxmots/"+$('#typeSection').attr('idtype')+"/"+numeroQuestion;

    if(numeroQuestion >= 0)
    {
        $.post( url, function( data ) {
            numeroQuestion++;
            if(numeroQuestion  === data.max) {
                numeroQuestion = -1;
            }

            total = data.max;
            $('#qtotal').text(total);
            $('#doc').html(data.doc);
            $('.title').text(data.question);
            $('.titleshadow').text(data.question);
            let htmlValues = '';
            data.reponses.forEach(function (data){
                htmlValues += '<div correct="'+data.iscorrect+'">'+data.reponse+'</div>';
            });
            question = data.question;
            $('.selectors').html(htmlValues);
            reDom();
        });
    }

}

window.onload = function() {
    if (window.jQuery) {
        getQuestion();
        makeProgress();
        $('#valider').click(function (){
            if( $('#showalert').hasClass('show')) {
                $('#showalert').removeClass('show');
                getQuestion();
                $('#valider').text('Valider');
                if(fht+rht >=total){
                    intitilize();
                }
            }
            else {
                $('#showalert').removeClass('alert-danger').removeClass('alert-success');

                let elementSelect =$('.select');
                let isCorrect = elementSelect.attr('correct');

                if (isCorrect === 'true') {
                    $('#showalert').addClass('alert-success');
                    $('#showalert>strong').text('Bravo!');
                    rht ++;
                    sendAjaxReponse(true, question);
                } else {
                    $('#showalert').addClass('alert-danger');
                    $('#showalert>strong').text('Zut!'+ ' - '+$('[correct=true]').text());
                    fht ++;
                    sendAjaxReponse(false, question);
                }
                makeProgress();
                $('#showalert').addClass('show');
                $('#valider').text('Suivant');
            }
        })
    } else {
        // jQuery is not loaded
        alert("Doesn't Work");
    }
}
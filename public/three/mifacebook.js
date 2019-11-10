window.fbAsyncInit = function() {
  FB.init({
    appId      : '734366080409921',
    xfbml      : true,
    version    : 'v4.0'
  });
  FB.AppEvents.logPageView();
};

(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk')); 


function shareScore(score, score2) {
  FB.ui({

    method: 'share',
    href: 'https://gamejap.herokuapp.com/',
    quote: 'Mi puntuación: ' + score + ' Puntuación segundo jugador: ' + score2
  }, function(respuesta){

  });
}

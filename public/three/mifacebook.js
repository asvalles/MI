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


function shareScore(score, im) {
  FB.ui({
    method: 'share', 
    href: im,
    quote: 'Mi puntuación: ' + score 
    },
    function(response){

    } 
  );

  ///FB.ui({
    //method: 'share',
    //href: 'https://gamejap.herokuapp.com/',
    //picture: 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS4GNJYYGFc_OAQBhIftYMqobs4nASs7VoWbEWaf8izGH2oTl5k',
    //method: 'stream.share',
    //u: im,
    //quote: 'Mi puntuación: ' + score + ' Puntuación segundo jugador: ' + score2
    //}, function(respuesta){
      //method: 'feed',
      //link: 'https://gamejap.herokuapp.com/',
      ////name: 'I got "+response.country+"! Which European are you destined to date?',
      //quote: 'Mi puntuación: ' + score + ' Puntuación segundo jugador: ' + score2,
      //picture: 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS4GNJYYGFc_OAQBhIftYMqobs4nASs7VoWbEWaf8izGH2oTl5k'
  //});
}

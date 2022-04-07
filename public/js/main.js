var url = 'http://localhost/SeverProyect/PHP/Nativo/Clases_udemy/Proyecto_2/public'

window.addEventListener("load", function () {
  $(".btn-like").css("cursor", "pointer");
  $(".btn-dislike").css("cursor", "pointer");

  function like() {
    $(document).on("click", ".btn-like", function (e) {
      $(this).addClass("btn-dislike").removeClass("btn-like");
      $(this).css('color', 'red');
      $('i').addClass('fas').removeClass('far');
      
      var like = url+'/like/'+$(this).data('id')
      
      $.ajax({
        url: like,
        type: 'GET',
        success: function(responsee){
            if (responsee.like) {
                console.log('Has dado like')
            } else {
                console.log('Error')
            }
        }
      })
      
      dislike();
    });
  }
  like();

  function dislike() {
    $(document).on("click", ".btn-dislike", function (e) {
      $(this).addClass("btn-like").removeClass("btn-dislike");
      $('i').addClass('far').removeClass('fas');
      var dislike = url+'/dislike/'+$(this).data('id')
      
      $.ajax({
        url: dislike,
        type: 'GET',
        success: function(responsee){
            if (responsee.like) {
                console.log('Has dado dislike')
            } else {
                console.log('Error')
            }
        }
      })

      like();
    });
  }
  dislike();

  $('#search').submit(function (e) {
      // e.preventDefault();
      $(this).attr('action', url+'/user/'+$('#search #search_text').val())
      // $(this).submit();
  })
});

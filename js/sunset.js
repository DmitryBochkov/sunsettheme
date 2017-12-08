jQuery(document).ready(function($) {
  revealPosts();

  // custom sunset scripts
  var carousel = '.sunset-carousel-thumb';
  sunset_get_bs_thumbs(carousel);

  $(carousel).on('slid.bs.carousel', function() {
    sunset_get_bs_thumbs(carousel);
  });

  function sunset_get_bs_thumbs(carousel) {
    var nextThumb = $('.item.active').find('.next-image-preview').data('image');
    var prevThumb = $('.item.active').find('.prev-image-preview').data('image');
    $(carousel).find('.carousel-control.right').find('.thumbnail-container').css({'background-image': 'url(' + nextThumb + ')'});
    $(carousel).find('.carousel-control.left').find('.thumbnail-container').css({'background-image': 'url(' + prevThumb + ')'});

  }

  // Ajax functions
  $(document).on('click', '.sunset-load-more:not(.loading)', function() {

    var that = $(this);
    var page = $(this).data('page');
    var newPage = page + 1;
    var ajaxurl = $(this).data('url');

    that.addClass('loading').find('.text').slideUp(320);
    that.find('.sunset-icon').addClass('spin');

    $.ajax({
      url: ajaxurl,
      type: 'post',
      data: {
        page: page,
        action: 'sunset_load_more',
      },
      error: function(response) {
        console.log(response);
      },
      success: function(response) {

        setTimeout(function() {
          that.data('page', newPage);
          $('.sunset-posts-container').append(response);
          that.removeClass('loading').find('.text').slideDown(320);
          that.find('.sunset-icon').removeClass('spin');

          revealPosts();
        }, 2000);
      }
    });
  });

  //  Helper functions
  function revealPosts() {
    var posts = $('article:not(.reveal)');
    var i = 0;

    setInterval(function() {
      if (i >= posts.length) {
        return false;
      }
      var el = posts[i];
      $(el).addClass('reveal').find('.sunset-carousel-thumb').carousel();
      i++;
    }, 200);
  }

});

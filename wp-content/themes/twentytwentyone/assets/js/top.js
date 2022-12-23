jQuery(function ($) {
  function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
      sURLVariables = sPageURL.split("&"),
      sParameterName,
      i;

    for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split("=");

      if (sParameterName[0] === sParam) {
        return sParameterName[1] === undefined
          ? true
          : decodeURIComponent(sParameterName[1]);
      }
    }
    return false;
  }
  let id = getUrlParameter("post");

  $('#timestamp').remove();
  $('.edit-timestamp').remove();

  
  $('li.wp-has-current-submenu').addClass('wp-not-current-submenu').removeClass('wp-has-current-submenu');
  $('a.wp-has-current-submenu').addClass('wp-not-current-submenu').removeClass('wp-has-current-submenu');
  $('li#toplevel_page_post-post-'+id+'-action-edit').addClass('wp-has-current-submenu').removeClass('wp-not-current-submenu');
  $('li#toplevel_page_post-post-'+id+'-action-edit > a').addClass('wp-has-current-submenu').removeClass('wp-not-current-submenu');

  //Banner small: Maximum 6 banner
  $(document).on(
    "click",
    '[data-selector="page_top_bannder_ads_group_repeat"]',
    function (event) {
      var bannerSmall = $(
        "#page_top_bannder_ads_group_repeat .cmb-repeatable-grouping"
      ).length;
      if (bannerSmall > 5) {
        $("#page_top_bannder_ads_group_repeat .cmb-add-group-row").hide();
      } else {
        $("#page_top_bannder_ads_group_repeat .cmb-add-group-row").show();
      }
    }
  );

  //Banner large: Maximum 2 banner
  $(document).on(
    "click",
    '[data-selector="page_top_bannder_ads_large_group_repeat"]',
    function (event) {
      var bannerLarge = $(
        "#page_top_bannder_ads_large_group_repeat .cmb-repeatable-grouping"
      ).length;
      if (bannerLarge > 1) {
        $("#page_top_bannder_ads_large_group_repeat .cmb-add-group-row").hide();
      } else {
        $("#page_top_bannder_ads_large_group_repeat .cmb-add-group-row").show();
      }
    }
  );

  $(document).on("click", "#publish", function (event) {
    event.preventDefault();
    //Slide top: Maximum 8 post
    //Ranking: Maximum 10 post
    // var slideTop = $("#page_top_slide_top_box ul.ui-droppable li").length;
    // var ranking = $("#page_top_ranking_box ul.ui-droppable li").length;
    // var keyword = $("#page_top_keyword").val().length;
    // if (slideTop > 10) {
    //   alert("Top表紙: Please choose 10 post.");
    // } else if (ranking > 8) {
    //   alert("ランキング設定: Please choose 8 post.");
    // } else if (keyword > 15) {
    //   alert("Hot word: Please choose 15 key word.");
    // } else {
    //   $("form#post").submit();
    // }
    $("form#post").submit();

  });
});

var searchButton = function()
{
  $("#btn__search").click(function (event) {
    event.preventDefault();
    $(".form-mobie").toggleClass("actives");
    $(".form-mobie").addClass("smooth");
  });
}

var responesive = function()
{
  var $window = $(window).width();
  if ($window > 992) {
    $("#open").click(function (event) {
      event.preventDefault();
      $("#close").css("display" ,"block");
      $("#open").css("display" , "none");
      $("#set-width").addClass("main__w");
      $("#set-width-sd").css("width", "80px");
      $("#set-width").addClass("smooths");
      $("#set-width-sd").addClass("smooths");
      $(".siderbar-menu__lnk").addClass("margin-right");
      $(".sider-bar_name").addClass("sider-name-opa");
      $(".siderbar-menu__list").addClass("sider-name-br"); 
      $(".siderbar-menu").css("padding","0 0 20px");
      $("#set-width-sd").addClass("collapse-siderbar");
    });

    $("#close").click(function (event) {
      event.preventDefault();
      $("#close").css("display" ,"none");
      $("#open").css("display" , "block");
      $("#set-width").removeClass("main__w");
      $("#set-width-sd").css("width", "200px");
      $("#set-width").removeClass("smooths");
      $("#set-width-sd").removeClass("smooths");
      $(".siderbar-menu__lnk").removeClass("margin-right");
      $(".sider-bar_name").removeClass("sider-name-opa");
      $(".siderbar-menu__list").removeClass("sider-name-br");
      $(".siderbar-menu").css("padding","0 0 20px");
      $("#set-width-sd").removeClass("collapse-siderbar");
    });

    if ($(".siderbar-menu__list").length > 0) {
        $(".siderbar-menu__list").on({
        mouseenter: function () {
          if ($(this).parents(".collapse-siderbar").length === 0) return; 
          $("#set-width-sd").css("width", "200px");
          $(".siderbar-menu__lnk").addClass("margin-right");
          $("#set-width").removeClass("smooths");
          $("#set-width-sd").removeClass("smooths");
          $(".siderbar-menu__lnk").removeClass("margin-right");
          $(".sider-bar_name").removeClass("sider-name-opa");
          $(".siderbar-menu__list").removeClass("sider-name-br");
          $(".siderbar-menu").css("padding","0 0 20px");
      },
        mouseleave: function () {
          if ($(this).parents(".collapse-siderbar").length === 0) return; 
          $("#set-width-sd").css("width", "80px");
          $(".siderbar-menu__lnk").addClass("margin-right");
          $("#set-width").removeClass("smooths");
          $("#set-width-sd").removeClass("smooths");
          $(".siderbar-menu__lnk").addClass("margin-right");
          $(".sider-bar_name").addClass("sider-name-opa");
          $(".siderbar-menu__list").addClass("sider-name-br"); 
          $(".siderbar-menu").css("padding","0 0 20px");
        }
      });
    }  
  }else{
    let mainSidebar = $("#set-width-sd");
    mainSidebar.append('<div class="bg_sidebar"></div>');
    $("#open").click(function (event) {
      event.preventDefault();
      $("#close").css("display" ,"block");
      $("#open").css("display" , "none");
      $(".siderbar-menu").addClass("active").addClass("mobie");
      $(".siderbar").css("visibility" , "visible");
      $(".bg_sidebar").addClass("active");
      mainSidebar.css("transition","0.5s");
      $('.sider-bar').css("transition","0.5s");
    });
  
    $(".bg_sidebar").click(function (event) {
      event.preventDefault();
      $("#close").css("display" ,"none");
      $("#open").css("display" , "block");
      $(".siderbar-menu").removeClass("active");
      $(".bg_sidebar").removeClass("active");
      $(".siderbar").css("visibility" , "hidden");
      $(".bg_sidebar").removeClass("activde");
    });
  }
}

var checkBox = function()
{
  if($(".checkbox-none").length > 0){
    $('.checkbox-none').change(function(){
      if ($(this).prop("checked")) {
        $(this).parents(".form-group").find("#start").removeAttr("disabled", "disabled");
      }else{
        $(this).parents(".form-group").find("#start").attr("disabled", "disabled");
      }
    })
  };
}
var headerMenu = function()
{
  $(".header-menu-user__name").click(function (event) {
    event.preventDefault();
    $(".header-menu-user-all").slideToggle(300);
  });
}

var fixedMenu = function()
{
  header =$('.header').height();
  $('.siderbar').css('top', header);
  $('.siderbar').css('height', $(window).height()-header);
  $('.main-all').css('padding-top', header);

}

var sidebarMenu = function()
{
  $("ul.siderbar-menu>li.parent_li").click(function(event){
    var ul=$(this).find(".siderbar_child");
    if(ul.is(":hidden") === true){
      $('.siderbar_child').slideUp(200);
      $('.parent_li').removeClass('active');
      $(this).addClass('active');
      ul.slideDown(200);
    }
    else{
      $(this).removeClass("active");
      ul.slideUp();
    }
  });
}

var loadingPage = function()
{
  setTimeout(function() { 
    $('.loading').delay(300).fadeOut(500);  
  }, 50);
}

$(function () {
  searchButton();
  responesive();  
  checkBox();
  headerMenu();
  fixedMenu();
  sidebarMenu();
  loadingPage();
});

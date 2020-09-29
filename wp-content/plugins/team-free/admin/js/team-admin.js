jQuery(document).ready(function ($) {
  $(".sptp-generator-tabs .spf-wrapper").css("visibility", "hidden");

  $('.filter_members').find("option:nth-of-type(2), option:nth-of-type(3), option:nth-of-type(4)").attr('disabled', 'disabled');
  $('.spf--typography').find('.spf--font-family, .spf--font-style-select, .spf--font-size, .spf--line-height, .spf--text-align, .spf--text-transform, .spf--letter-spacing, .spf--margin-top, .spf--margin-bottom').attr('disabled', 'disabled');
  $('.sptp_typography_pro').css('pointer-events', 'none');
  $('.spf--block-preview').css('cursor', 'auto');
  $('.spf--block-preview .spf--toggle').hide();
  $('.spf--block-preview').css('pointer-events', 'none');
  var select_value_layout = $(
    ".sptp-layout-preset .spf--sibling.spf--image.spf--active"
  )
    .find("input")
    .val();
  console.log(select_value_layout);
  if (select_value_layout === "carousel") {
    $(".spf-nav-metabox li.menu-item__sptp_generator_2").show();
    $(".page_link_type").addClass("test");
    $(".page_link_type .spf--sibling:nth-of-type(3)").hide();
  } else {
    $(".spf-nav-metabox li.menu-item__sptp_generator_2").hide();
    $(".page_link_type .spf--sibling:nth-of-type(3)").show();
  }

  if (select_value_layout == "list") {
    $('.member_content_position, .page_link_type .spf--button:nth-of-type(2)').addClass('hidden');
    $('.responsive_columns').hide();
    $('.responsive_columns_list').show();
  } else {
    $('.member_content_position_list').addClass('hidden');
    $('.responsive_columns').show();
    $('.responsive_columns_list').hide();
  }

  var withoutPaginationLayout = ['carousel'];

  if (withoutPaginationLayout.indexOf(select_value_layout) !== -1) {
    $(".sptp-pagination-group").addClass("hidden");
  } else {
    $('.sptp-pagination-group').removeClass('hidden');
  }

  $(document).on(
    "click",
    ".sptp-layout-preset .spf--sibling.spf--image",
    function (event) {
      event.stopPropagation();
      var select_value = $(this)
        .find("input")
        .val();
      if (
        select_value == "carousel" ||
        select_value == "list"
      ) {
        $(".page_link_type .spf--sibling:nth-of-type(3)").hide();
        $(".page_link_type .spf--sibling:first-of-type").click();
      } else {
        $(".page_link_type .spf--sibling:nth-of-type(3)").show();
      }

      if (select_value !== "carousel") {
        $(".spf-nav-metabox li.menu-item__sptp_generator_2").hide();
        $(".spf-nav-metabox li.menu-item__sptp_generator_1 a").click();
      } else {
        $(".spf-nav-metabox li.menu-item__sptp_generator_2").show();
      }

      if (withoutMarginBetweenMember.indexOf(select_value) !== -1) {
        $(".style_margin_between_member").addClass("hidden");
      } else {
        $(".style_margin_between_member").removeClass("hidden");
      }

      if (withoutPaginationLayout.indexOf(select_value) !== -1) {
        $(".sptp-pagination-group").addClass("hidden");
      } else {
        $('.sptp-pagination-group').removeClass('hidden');
      }

      if (select_value == "list") {
        $('.member_content_position_list').removeClass('hidden');
        $('.member_content_position').addClass('hidden');
        $('.responsive_columns').hide();
        $('.responsive_columns_list').show();
      } else {
        $('.member_content_position_list').addClass('hidden');
        $('.member_content_position').removeClass('hidden');
        $('.responsive_columns_list').hide();
        $('.responsive_columns').show();
      }
    }
  );

  $(".sptp-generator-tabs .spf-wrapper").css("visibility", "visible");
  $(".sptp-generator-tabs .spf-wrapper li").css("opacity", 1);

  $(document).on("click", "#copy-shortcode, #copy-tag", function () {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp
      .val(
        $(this)
          .parent()
          .find("input")
          .val()
      )
      .select();
    document.execCommand("copy");
    $(this).append('<span class="copy-alert">copied</span>');
    setTimeout(function () {
      $(".copy-alert")
        .fadeOut()
        .empty();
    }, 1000);
    $temp.remove();
  });

  $("._sptp_output input[type='text']").click(function () {
    $(this).select();
  });
});

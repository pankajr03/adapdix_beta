jQuery(document).ready(function ($) {
  $(".sptp-generator-tabs .spf-wrapper").css("visibility", "hidden");

  var select_value_layout = $(
    ".sptp-layout-preset .spf--sibling.spf--image.spf--active"
  ).find("input").val();

  if (select_value_layout === "carousel" || select_value_layout === "filter" || select_value_layout === "mosaic") {
    $(".page_link_type .spf--sibling:nth-of-type(2)").hide();
  } else {
    $(".page_link_type .spf--sibling:nth-of-type(2)").show();
  }

  if (select_value_layout === "carousel") {
    $(".spf-nav-metabox li.menu-item__sptp_generator_2").show();
  } else {
    $(".spf-nav-metabox li.menu-item__sptp_generator_2").hide();
  }

  if (select_value_layout === "filter") {
    $(".spf-nav-metabox li.menu-item__sptp_generator_3").show();
  } else {
    $(".spf-nav-metabox li.menu-item__sptp_generator_3").hide();
  }

  if (select_value_layout === "thumbnail-pager") {
    $(".spf-nav-metabox li.menu-item__sptp_generator_6").hide();
    $('.image_shape_thumbnail').show();
    $('.image_shape').hide();
    $('.image_size').hide();
    $('.image_size_table').show();
    $('.icon_over_img, .icon_over_img_type, .icon_over_img_color, .icon_over_img_bg_color').removeClass('hidden');
    $('.member_content_position .spf--image:last-of-type').css('display', 'none');
  } else {
    $('.image_shape_thumbnail').hide();
    $('.image_shape').show();
    $('.image_size').show();
    $('.image_size_table').hide();
  }

  if (select_value_layout == "list" || select_value_layout == "table") {
    $(".member_content_position").addClass("hidden");
  } else {
    $(".member_content_position").removeClass("hidden");
  }
  if (select_value_layout == "list") {
    $('.page_link_type .spf--button:nth-of-type(2)').addClass('hidden');
    $('.responsive_columns').hide();
    $('.responsive_columns_list').show();
  } else {
    $('.member_content_position_list').addClass('hidden');
    $('.responsive_columns').show();
    $('.responsive_columns_list').hide();
  }
  if (select_value_layout == "table") {
    $('.page_link_type .spf--button:nth-of-type(2)').addClass('hidden');
    $('.tooltip_color_group').addClass('hidden');
    $('.image_size').hide();
    $('.image_size_table').show();
    $('.responsive_columns').hide();
    $('.responsive_columns_list').hide();
    $('.custom_image_option').hide();
  } else {
    $('.tooltip_color_group').removeClass('hidden');
    $('.image_size').show();
    $('.image_size_table').hide();
  }

  if (select_value_layout == "inline") {
    $('.style_margin_between_member').hide();
    $('.style_margin_between_member_inline').show();
    $('.border_around_inline').show();
    $('.border_around').hide();
  } else {
    $('.style_margin_between_member_inline').hide();
    $('.style_margin_between_member').show();
    $('.border_around_inline').hide();
    $('.border_around').show();
  }

  var withoutMarginBetweenMember = ['mosaic'];
  var withoutPaginationLayout = ['carousel', 'filter', 'thumbnail-pager'];

  if (withoutMarginBetweenMember.indexOf(select_value_layout) !== -1) {
    $(".style_margin_between_member").addClass("hidden");
  } else {
    $(".style_margin_between_member").removeClass("hidden");
  }

  if (withoutPaginationLayout.indexOf(select_value_layout) !== -1) {
    $(".sptp-pagination-group").addClass("hidden");
  } else {
    $('.sptp-pagination-group').removeClass('hidden');
  }

  if (select_value_layout == "mosaic") {
    $(".mosaic_bg_color").removeClass("hidden");
    $(".member_content_position").addClass("hidden");
    $(".sptp-border-bg-group").addClass("hidden");
    if ($(".bio_switch_mosaic").length > 0) {
      $(".bio_switch").parent().parent().css("display", "none");
    } else {
      $(".bio_switch").parent().parent().css("display", "block");
    }
    $(".bio_switch_mosaic").parent().parent().css("display", "block");
  } else {
    $(".mosaic_bg_color").addClass("hidden");
    $(".bio_switch").parent().parent().css("display", "block");
    $(".bio_switch_mosaic").parent().parent().css("display", "none");
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
        select_value == "filter" ||
        select_value == "list" ||
        select_value == "mosaic" ||
        select_value == "table"
      ) {
        $(".page_link_type .spf--sibling:nth-of-type(2)").hide();
        $(".page_link_type .spf--sibling:first-of-type").click();
      } else {
        $(".page_link_type .spf--sibling:nth-of-type(2)").show();
      }

      if (select_value !== "carousel") {
        $(".spf-nav-metabox li.menu-item__sptp_generator_2").hide();
        $(".spf-nav-metabox li.menu-item__sptp_generator_1 a").click();
      } else {
        $(".spf-nav-metabox li.menu-item__sptp_generator_2").show();
      }

      if (select_value == "thumbnail-pager") {
        $(".spf-nav-metabox li.menu-item__sptp_generator_6").hide();
        $(".spf-nav-metabox li.menu-item__sptp_generator_1 a").click();
        $('.image_shape_thumbnail').show();
        $('.image_shape').hide();
        $('.image_size').hide();
        $('.image_size_table').show();
        $('.icon_over_img, .icon_over_img_type, .icon_over_img_color, .icon_over_img_bg_color').removeClass('hidden');
        $('.member_content_position .spf--image:last-of-type').css('display', 'none');
      } else {
        $(".spf-nav-metabox li.menu-item__sptp_generator_6").show();
        $('.image_shape_thumbnail').hide();
        $('.image_shape').show();
        $('.image_size').show();
        $('.image_size_table').hide();
      }

      if (select_value == "filter") {
        $(".spf-nav-metabox li.menu-item__sptp_generator_3").show();
        $(".spf-nav-metabox li.menu-item__sptp_generator_1 a").click();
      } else {
        $(".spf-nav-metabox li.menu-item__sptp_generator_3").hide();
      }

      if (select_value == "inline") {
        $('.style_margin_between_member').hide();
        $('.style_margin_between_member_inline').show();
        $('.border_around_inline').show();
        $('.border_around').hide();
      } else {
        $('.style_margin_between_member_inline').hide();
        $('.style_margin_between_member').show();
        $('.border_around_inline').hide();
        $('.border_around').show();
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

      if (select_value == "table") {
        $(".member_content_position").addClass("hidden");
        $('.tooltip_color_group').addClass('hidden');
        $('.image_size').hide();
        $('.image_size_table').show();
        $('.responsive_columns').hide();
        $('.custom_image_option').hide();
      } else {
        $('.tooltip_color_group').removeClass('hidden');
        $('.image_size').show();
        $('.image_size_table').hide();
      }

      if (select_value == "mosaic") {
        $(".mosaic_bg_color").removeClass("hidden");
        $(".member_content_position").addClass("hidden");
        $(".sptp-border-bg-group").attr("style", "display: none");
        if ($(".bio_switch_mosaic").length > 0) {
          $(".bio_switch").parent().parent().css("display", "none");
        } else {
          $(".bio_switch").parent().parent().css("display", "block");
        }
        $(".bio_switch_mosaic").parent().parent().css("display", "block");
      } else {
        $(".mosaic_bg_color").addClass("hidden");
        $(".sptp-border-bg-group").attr("style", "display: block");
        $(".bio_switch").parent().parent().css("display", "block");
        $(".bio_switch_mosaic").parent().parent().css("display", "none");
      }
    }
  );

  $(".sptp-generator-tabs .spf-wrapper").css("visibility", "visible");
  $(".sptp-generator-tabs .spf-wrapper li").css("opacity", 1);

  $("._sptp_output input[type='text']").click(function () {
    $(this).select();
  });
});

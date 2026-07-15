/**
 * isMobile
 * headerFixed
 * responsiveMenu
 * themesflatSearch
 * detectViewport
 * blogLoadMore
 * commingsoon
 * goTop
 * retinaLogos
 * customizable_carousel
 * parallax
 * iziModal
 * bg_particles
 * pagetitleVideo
 * toggleExtramenu
 * removePreloader
 */

(function ($) {
  "use strict";

  var swatchColor = function () {
    if ($(".card-product").length > 0) {
      $(".wcboost-variation-swatches--color .color-swatch").on("click, mouseover", function () {
        var swatchColor = $(this).find("img").attr("src");
        var imgProduct = $(this).closest(".card-product").find(".img-product");
        imgProduct.attr("src", swatchColor);
        $(this)
          .closest(".card-product")
          .find(".color-swatch.active")
          .removeClass("active");

        $(this).addClass("active");
      });
      $(".wcboost-variation-swatches--image .color-swatch").on("click, mouseover", function () {
        if (!tfwc_woo_params?.swatches_image_hover) {
          return;
        }
        var swatchColor = $(this).find("img").attr("src");
        var imgProduct = $(this).closest(".card-product").find(".img-product");
        imgProduct.attr("src", swatchColor);
        $(this)
          .closest(".card-product")
          .find(".color-swatch.active")
          .removeClass("active");

        $(this).addClass("active");
      });
      $(".color-swatch:first-child").trigger("mouseover");
    }
  };

  var compare = function () {
    if (typeof wcboost_products_compare_params == 'undefined') {
      return;
    }

    $(document.body).on("wcboost_compare_item_added", function (event, data) {
      if ($(".wcboost-products-compare").length) {
        $('.wcboost-products-compare .tf-compare-table').load(location.href + ' .wcboost-products-compare .tf-compare-table .tf-compare-row');
        return;
      }
      if (!$('.modal-compare').hasClass('show')) {
        $('.modal-compare').load(location.href + ' .modal-compare .modal-dialog', function () {
          $('.modal-compare').modal('show');
        });
      }
    });

    $(document.body).on("wcboost_compare_item_removed", function (event, data) {
      if ($(".wcboost-products-compare").length) {
        $('.wcboost-products-compare .tf-compare-table').load(location.href + ' .wcboost-products-compare .tf-compare-table .tf-compare-row');
        return;
      }
      if (!$('.modal-compare').hasClass('show')) {
        $('.modal-compare').load(location.href + ' .modal-compare .modal-dialog', function () {
          $('.modal-compare').modal('show');
        });
      }
    });

    $(document).on("click", ".card-product .compare a", function () {
      return;

      let tooltip = $(this).find(".tooltip");
      var tooltip_added = $(this).data("tooltip_added");
      var tooltip_default = $(this).data("tooltip");

      if ($(this).hasClass("added")) {
        tooltip.text(tooltip_default);
      } else {
        tooltip.text(tooltip_added);
      }

      var productID = $(this).data("product_id");

      if (productID) {
        $.ajax({
          url: woocommerce_params.wc_ajax_url.toString().replace("%%endpoint%%", "add_to_compare"),
          type: 'POST',
          data: {
            product_id: productID
          },
          beforeSend: function () {
          },
          success: function (response) {
            $('.modal-compare').load(location.href + ' .modal-compare .modal-dialog', function () {
              $('.modal-compare').modal('show');
            });
          },
        });
      }


    });

    $('.modal-compare').on('click', '.tf-remove-compare', function (e) {
      e.preventDefault();
      let removeUrl = $(this).data('remove-url'),
        item = $(this).closest('.tf-compare-item');
      if (removeUrl) {
        removeUrl = new URLSearchParams(removeUrl);
        var data = {
          item_key: removeUrl.get("remove_compare_item"),
          _wpnonce: removeUrl.get("_wpnonce")
        };
        if (!data.item_key) {
          return
        }

        $.ajax({
          url: woocommerce_params.wc_ajax_url.toString().replace("%%endpoint%%", "remove_compare_item"),
          type: 'POST',
          data: data,
          beforeSend: function () {
            item.addClass('loading-content');
          },
          success: function (response) {
            if (response.error) {
            } else {
              if (response?.success) {

                item.remove();

                $(document.body).trigger("wcboost_compare_item_removed", [response.data]);

                let compareList = $('.tf-compare-list');
                if (compareList.find('.tf-compare-item').length === 0) {
                  compareList.html('<p class="no-compare-message">No products added in the compare table.</p>');
                  $('.modal-compare .count-item-compare').text('');
                } else {
                  $('.modal-compare .count-item-compare').text(`(${compareList.find('.tf-compare-item').length})`);
                }
              }
            }
          },
          complete: function () {
          }
        });
      }
    });

    $('.modal-compare').on('click', '.tf-clear-compare', function (e) {
      e.preventDefault();
      let clearUrl = $(this).data('clear-url'),
        list_items = $('.tf-compare-item', $(this).closest('.modal-compare'));
      if (clearUrl) {
        $.ajax({
          url: clearUrl,
          type: 'POST',
          data: {
            _wp_http_referer: wcboost_products_compare_params.page_url,
            time: (new Date).getTime()
          },
          dataType: "json",
          success: function (response) {
            if (response.error) {
              // console.error(response.error_message);
            } else {

            }
          },
          complete: function () {
            list_items.remove();
            $(document.body).trigger("products_compare_list_emptied");
            $(document.body).trigger("products_compare_fragments_refresh", [true]);
            $('.modal-compare').modal('hide');
          }
        });
      }
    });
  };

  var wishlist = function () {
    $(".card-product .wishlist a,.card-product .compare a").on("click", function () {

      let tooltip = $(this).find(".tooltip");
      var tooltip_added = $(this).data("tooltip_added");
      var tooltip_default = $(this).data("tooltip");

      if ($(this).hasClass("added")) {
        tooltip.text(tooltip_default);
      } else {
        tooltip.text(tooltip_added);
      }


    });

    $(document.body).on('added_to_wishlist removed_from_wishlist', function () {
      const $container = $('.wcboost-wishlist');

      if ($container.length === 0) {
        return;
      }

      $container.addClass('loading-wishlist');

      let $tempDiv = $('<div style="display: none;"></div>');

      $tempDiv.load(window.location.href + ' .wcboost-wishlist .wrapper-wishlist, .wcboost-wishlist .wishlist-empty', function () {

        if ($(".wrapper-wishlist", $tempDiv).length) {
          $(".wishlist-empty", $container).children().remove();
          if ($(".wrapper-wishlist", $container).length) {
            $(".wrapper-wishlist", $container).html($(".wrapper-wishlist", $tempDiv).html());
          } else {
            $container.prepend($(".wrapper-wishlist", $tempDiv).clone());
          }
        }

        if ($(".wishlist-empty", $tempDiv).length) {
          $(".wrapper-wishlist", $container).children().remove();
          if ($(".wishlist-empty", $container).length) {
            $(".wishlist-empty", $container).html($(".wishlist-empty", $tempDiv).html());
          } else {
            $container.prepend($(".wishlist-empty", $tempDiv).clone());
          }
        }

        $tempDiv.remove();

        $container.removeClass('loading-wishlist');

      });

    });

    $(document.body).on('wishlist_item_removed', function (e, data) {
      $(`.wcboost-wishlist-button[data-product_id="${data?.product_id || 0}"] .tooltip`).text(wcboost_wishlist_params?.i18n_add_to_wishlist || 'Add to wishlist');

    });

    $(document.body).on('wishlist_item_added', function (e, data) {
      if (wcboost_wishlist_params?.exists_item_behavior == 'remove') {
        $(`.wcboost-wishlist-button[data-product_id="${data?.product_id || 0}"] .tooltip`).text(wcboost_wishlist_params?.i18n_remove_from_wishlist || 'Remove from wishlist');

      }

      if (wcboost_wishlist_params?.exists_item_behavior == 'view_wishlist') {
        $(`.wcboost-wishlist-button[data-product_id="${data?.product_id || 0}"] .tooltip`).text(wcboost_wishlist_params?.i18n_view_wishlist || 'View wishlist');

      }

      const lengthItems = Object.keys(data?.wishlist_items).length;

      if ($('.wishlist-btn-fragment .count-box').text() == 0 && lengthItems) {
        $('.wishlist-btn-fragment .count-box').text(lengthItems);
      }
    });

    // wishlist_updated

  };

  var singleWishlist = function () {

    if (typeof wcboost_wishlist_params == 'undefined') {
      return;
    }

    $(document).on('click', '.tf-wishlist-btn', function (e) {
      e.preventDefault();
      let $btn = $(this);
      if ($btn.hasClass('added-wishlist')) {
        let removeUrl = $(this).data('remove-url');
        if (removeUrl) {
          e.preventDefault();
          removeUrl = new URLSearchParams(removeUrl);
          var data = {
            item_key: removeUrl.get("remove-wishlist-item"),
            _wpnonce: removeUrl.get("_wpnonce")
          };
          if (!data.item_key) {
            return
          }
          $.ajax({
            url: woocommerce_params.wc_ajax_url.toString().replace("%%endpoint%%", "remove_wishlist_item"),
            type: 'POST',
            data: data,
            success: function (response) {
              if (response.error) {
                // console.error(response.error_message);
              } else {
                if (response?.success) {
                  if ('yes' === wcboost_wishlist_params.allow_adding_variations) {

                    var variations = $btn.data('variations');
                    if (variations) {
                      var found = variations.find(function (variation) {
                        return variation.variation_id === $btn.data("product-id");
                      });

                      if (found) {
                        found.added = 'no';
                      }
                    }
                  }
                  $btn.removeClass('added-wishlist');
                  $btn.data('remove-url', '');
                  $btn.attr('href', response?.data?.add_url ? response.data.add_url : `?add-to-wishlist=${$btn.data("product-id")}`);
                  $('.tooltip', $btn).text(wcboost_wishlist_params.i18n_add_to_wishlist);
                  $('.wcboost-wishlist-button__icon', $btn).html(wcboost_wishlist_params.icon_normal);
                  $(document.body)
                    .trigger('removed_from_wishlist', [$btn, response?.data?.fragments])
                    .trigger('wishlist_item_removed', [response?.data]);
                }
              }
            },
            complete: function () {
            }
          });
        }
      } else {
        e.preventDefault();
        let data = {
          product_id: $btn.data("product-id"),
          quantity: $btn.data("quantity")
        };

        if (!data.product_id) {

          return;
        }
        $.ajax({
          url: woocommerce_params.wc_ajax_url.toString().replace("%%endpoint%%", "add_to_wishlist"),
          type: 'POST',
          data: data,
          success: function (response) {
            if (response?.success) {
              if ('yes' === wcboost_wishlist_params.allow_adding_variations) {

                var variations = $btn.data('variations');
                if (variations) {
                  var found = variations.find(function (variation) {
                    return variation.variation_id === $btn.data("product-id");
                  });

                  if (found) {
                    found.added = 'yes';
                  }
                }
              }
              $btn.addClass('added-wishlist');
              switch (wcboost_wishlist_params.exists_item_behavior) {
                case 'view_wishlist':
                  $btn.attr('href', response?.data?.wishlist_url ? response.data.wishlist_url : wcboost_wishlist_params.wishlist_url);
                  $('.tooltip', $btn).text(wcboost_wishlist_params.i18n_view_wishlist);
                  $('.wcboost-wishlist-button__icon', $btn).html(wcboost_wishlist_params.icon_filled);
                  break;

                case 'remove':
                  $btn.attr('href', $btn.data("remove-url"));
                  $btn.data('remove-url', response?.data?.remove_url);
                  $('.tooltip', $btn).text(wcboost_wishlist_params.i18n_remove_from_wishlist);
                  $('.wcboost-wishlist-button__icon', $btn).html(wcboost_wishlist_params.icon_filled);
                  break;

                case 'hide':
                  $btn.hide();
                  break;
              }
              $(document.body)
                .trigger('added_to_wishlist', [$btn, response?.data?.fragments])
                .trigger('wishlist_item_added', [response?.data]);
            }
          },
        });
      }
    });

    if ('yes' === wcboost_wishlist_params.allow_adding_variations) {
      $('.tf-single-product .variations_form')
        .on('found_variation', function (event, data) {
          var $btn = $(event.target).closest('.product').find('.tf-wishlist-btn');
          var variations = $btn.data('variations');
          $btn.data('product-id', data.variation_id);

          if (variations) {
            var found = variations.find(function (variation) {
              return variation.variation_id === data.variation_id;
            });

            if (found) {
              $btn.attr('href', found.add_url);
              if (found.added === 'yes') {
                $btn.addClass('added-wishlist');
                switch (wcboost_wishlist_params.exists_item_behavior) {
                  case 'view_wishlist':
                    $btn.data('remove-url', '');
                    $('.tooltip', $btn).text(wcboost_wishlist_params.i18n_view_wishlist);
                    $('.wcboost-wishlist-button__icon', $btn).html(wcboost_wishlist_params.icon_filled);
                    break;

                  case 'remove':
                    $btn.data('remove-url', found.remove_url);
                    $('.tooltip', $btn).text(wcboost_wishlist_params.i18n_remove_from_wishlist);
                    $('.wcboost-wishlist-button__icon', $btn).html(wcboost_wishlist_params.icon_filled);
                    break;

                  case 'hide':
                    $btn.hide();
                    break;
                }
              } else {
                $btn.removeClass('added-wishlist');
                $btn.data('remove-url', '');
                $('.tooltip', $btn).text(wcboost_wishlist_params.i18n_add_to_wishlist);
                $('.wcboost-wishlist-button__icon', $btn).html(wcboost_wishlist_params.icon_normal);
              }
            }
          }
        })
        .on('reset_data', function (event) {
          var $btn = $(event.target).closest('.product').find('.tf-wishlist-btn');
          var variations = $btn.data('variations');

          if (variations) {
            var parent = variations.find(function (variation) {
              return variation.is_parent;
            });

            if (parent) {
              $btn.data('product-id', parent.variation_id);
              $btn.attr('href', parent.add_url);
              if (parent.added === 'yes') {
                $btn.addClass('added-wishlist');
                switch (wcboost_wishlist_params.exists_item_behavior) {
                  case 'view_wishlist':
                    $btn.data('remove-url', '');
                    $('.tooltip', $btn).text(wcboost_wishlist_params.i18n_view_wishlist);
                    $('.wcboost-wishlist-button__icon', $btn).html(wcboost_wishlist_params.icon_filled);
                    break;

                  case 'remove':
                    $btn.data('remove-url', parent.remove_url);
                    $('.tooltip', $btn).text(wcboost_wishlist_params.i18n_remove_from_wishlist);
                    $('.wcboost-wishlist-button__icon', $btn).html(wcboost_wishlist_params.icon_filled);
                    break;

                  case 'hide':
                    $btn.hide();
                    break;
                }
              } else {
                $btn.removeClass('added-wishlist');
                $btn.data('remove-url', '');
                $('.tooltip', $btn).text(wcboost_wishlist_params.i18n_add_to_wishlist);
                $('.wcboost-wishlist-button__icon', $btn).html(wcboost_wishlist_params.icon_normal);
              }
            }
          }
        });
    }

    //Update status from storage

    $(document.body).on('wishlist_fragments_loaded', function () {
      if ($('.tf-wishlist-btn').data('remove-url')) {
        $('.wcboost-wishlist-button__icon', $('.tf-wishlist-btn')).html(wcboost_wishlist_params.icon_filled);
      };
    });

  };

  var countDown = function () {
    var countDown = document.getElementsByClassName("js-countdown");
    if (countDown.length > 0) {
      for (var i = 0; i < countDown.length; i++) {
        (function (i) {
          if (!countDown[i].classList.contains('countdown-initialized')) {
            CountDown(countDown[i]);
            countDown[i].classList.add('countdown-initialized');
          }
        })(i);
      }
    }
  }

  var add_to_cart = function () {
    $(document).on('added_to_cart', function () {
      tf_swiper_slider();
      setTimeout(function () {
        // var myModal = new bootstrap.Modal(document.getElementById('shoppingCart'));
        // myModal.show();
        var offcanvas = new bootstrap.Offcanvas(document.getElementById('shoppingCart'));
        $('.modal-compare')?.modal('hide');
        $('.modal-quick-view')?.modal('hide');
        $('.modal-quick-add')?.modal('hide');

        offcanvas.show();
      }, 200);
    });
  }

  var remove_wishlist = function () {
    $(document).on('wishlist_fragments_refreshed', function () {
      countDown();
      tf_swiper_slider();
    });
  }

  var quantity_input = function () {
    var ajax_in_progress = false;
    var debounce_timeout;
    var last_value = null;

    $(document).on('click', '.qty_button', function (e) {
      e.preventDefault();

      var $this = $(this),
        $input_qty = $this.siblings('.qty'),
        min = parseFloat($input_qty.attr('min')),
        max = parseFloat($input_qty.attr('max')),
        step = parseFloat($input_qty.attr('step')),
        current = parseFloat($input_qty.val());

      min = min ? min : 0;
      max = !isNaN(max) ? max : current + 1;

      if ($this.hasClass('minus') && current > min) {
        $input_qty.val(current - step);
      }
      if ($this.hasClass('plus') && current < max) {
        $input_qty.val(current + step);
      }

      $input_qty.trigger('change');
    });

    $(document).on('change', '.mini-cart-item-quantity .qty', function () {
      var input_qty = parseFloat($(this).val());

      if (ajax_in_progress) return;

      last_value = input_qty;

      var max = parseFloat($(this).attr('max'));

      if (max !== 'NaN' && max < input_qty) {
        input_qty = max;
        $(this).val(max);
      }
      var that = this;

      clearTimeout(debounce_timeout);

      debounce_timeout = setTimeout(function () {
        var cart_item_key = $(that).closest('.tf-mini-cart-item').data('cart_item_key');
        var data = {
          action: 'tfwc_update_cart_item',
          quantity: input_qty,
          cart_item_key: cart_item_key,
          nonce: tfwc_woo_params.nonce,
        };

        $(that).closest('.tf-mini-cart-item').addClass('loading-content');

        $.ajax({
          url: tfwc_woo_params.ajax_url,
          data: data,
          dataType: 'json',
          method: 'POST',
          success: function (response) {
            ajax_in_progress = false;

            $(that).closest('.tf-mini-cart-item').removeClass('loading-content');

            if (!response) {
              return;
            }

            if (response.fragments) {
              $.each(response.fragments, function (fragment, content) {
                $(fragment).replaceWith(content);
              });
            }
            $(document.body).trigger('wc_fragments_refreshed');
            tf_swiper_slider();
          },
          error: function () {
            ajax_in_progress = false;
            $(that).closest('.tf-mini-cart-item').removeClass('loading');
          },
          complete: function () {
            ajax_in_progress = false;
          }
        });
      }, 500);
    });
  };

  var quickview_product = function () {
    $(document).on("click", ".tf_quickview_btn", function (e) {
      e.preventDefault();

      var productID = $(this).data("product_id");

      $.ajax({
        url: tfwc_woo_params.ajax_url,
        type: "POST",
        data: {
          action: "load_quickview_product",
          product_id: productID,
          nonce: tfwc_woo_params.nonce,
        },
        beforeSend: function () {
          $(".modal-quick-view .modal-content").html("");
          $(".modal-quick-view .modal-content").addClass("loading-content");
        },
        success: function (response) {
          if (response.success) {
            $(".modal-quick-view .modal-content").html(response.data.content);
            $(".modal-quick-view .modal-content").removeClass("loading-content");
          } else {
            $(".modal-quick-view .modal-content").html("<p>Error Quick View</p>");
            $(".modal-quick-view .modal-content").removeClass("loading-content");
          }
          swiper_slider();
          countDown();
          swatchColor();
          // compare();
        }
      });
    });
  }

  var quickShop = function () {
    let $modalQuickAdd = $('.tf-quick-add-modal'),
      $modalQuickView = $('.modal-quick-view');

    // Quick View
    $(document).on('ajaxComplete.quick_view', function (event, xhr, settings) {
      if (settings.data && settings.data.indexOf('action=load_quickview_product') !== -1) {
        let $container = $('.tf-product-info-wrap', $modalQuickView),
          $variationForm = $('.variations_form', $modalQuickView),
          $image = $('.item img', $modalQuickView).first(),
          $price = $('.tf-price .price-wrap', $modalQuickView),
          $buttonText = $('.single_add_to_cart_button .single-add-to-cart-text', $modalQuickView),
          imageOrigin = $image.attr('src') ? $image.attr('src') : $image.attr('data-src'),
          priceHTMlOrigin = $price.html(),
          buttonTextOrigin = $buttonText.text();

        if ($container.length) {
          $container.addClass('tf-main-product');
        }
        if ($variationForm.length) {
          if (typeof $.fn.wc_variation_form !== 'undefined') {
            $variationForm.wc_variation_form();
          }
          if (typeof $.fn.wcboost_variation_swatches !== 'undefined') {
            $variationForm.wcboost_variation_swatches().trigger('init_variation_swatches.wcboost-variation-swatches');
          }

          if (typeof lazySizes !== 'undefined') {
            lazySizes?.loader?.checkElems();
          }

          $(".tf-variation-dropdown-wrapper .select-item", $variationForm).on('click', function (e) {
            e.preventDefault();
            if ($(this).hasClass('disabled')) {
              return false;
            }
            $('.select-item', $(this).closest('.tf-variant-dropdown')).removeClass('active');
            $('.current-value', $(this).closest('.tf-variant-dropdown')).text($(this).text());
            $('select', $(this).closest('.tf-variation-items')).val($(this).data('value')).change();
            $(this).addClass('active');
          });

          var updateBadgeSale = function (variation) {
            let price = variation.display_price,
              regularPrice = variation.display_regular_price,
              discount = Math.round(((regularPrice - price) / regularPrice) * 100);
            if (discount > 0) {
              if ($(".badges-on-sale", $price).length == 0) {
                $(`
                        <p class="badges-on-sale">
                            <i class="icon-tag"></i>
                            <span class="number-sale">
                                ${discount}% Off
                            </span>
                        </p>`
                )
                  .appendTo($price);
              } else {
                $(".number-sale", $price).text(`${discount}% Off`);
              }
            }
          }

          $variationForm.on("show_variation", function (e, variation) {
            updateBadgeSale(variation);
          })

          $variationForm
            .on('found_variation', function (e, data) {
              if (data?.image?.full_src) {
                $image.attr('src', data.image.full_src);
              }
              if (data?.price_html) {
                $price.html($(data.price_html).html());
              }
              if (data?.add_to_cart_text) {
                $buttonText.text(data.add_to_cart_text);
              }
            })
            .on('hide_variation', function () {
              $(".tf-variation-dropdown-wrapper .select-item", $variationForm).removeClass("active");
              $image.attr('src', imageOrigin);
              $price.html(priceHTMlOrigin);
              $buttonText.text(buttonTextOrigin);
            });

          var mainQV = new Swiper(".modal-quick-view .tf-single-slide", {
            slidesPerView: 1,
            spaceBetween: 0,
            observer: true,
            observeParents: true,
            speed: 800,
            navigation: {
              nextEl: ".modal-quick-view .single-slide-next",
              prevEl: ".modal-quick-view .single-slide-prev",
            },
          });
        }
      }
    });

    // Quick Add
    $(document).on("click", ".tf-main-product .tf_quick_add_btn, .card-product .tf_quick_add_btn, .tf_add_to_cart.product_type_variable", function (e) {
      e.preventDefault();
      let id = $(this).data('product_id');
      $.ajax({
        url: woocommerce_params.wc_ajax_url.toString().replace("%%endpoint%%", "tf_get_quick_add"),
        type: 'POST',
        data: {
          quick_add_id: id,
          security: tfwc_woo_params.nonce,
        },
        beforeSend: function () { },
        success: function (response) {
          if (response?.success) {
            let $response = $(response.data?.content);
            if (!$response.length) {
              return;
            }
            $modalQuickAdd.find('.card-product')
              .empty()
              .html($response)
              .addClass('tf-main-product');

            let $variationForm = $modalQuickAdd.find('.variations_form'),
              $price = $('.tf-price', $modalQuickAdd),
              $image = $('.product-img img', $modalQuickAdd),
              $buttonText = $('.single_add_to_cart_button .single-add-to-cart-text', $modalQuickAdd),
              priceHTMlOrigin = $price.html(),
              imageOrigin = $image.attr('src') ? $image.attr('src') : $image.attr('data-src'),
              buttonTextOrigin = $buttonText.text();
            $('.screen-reader-text', $variationForm).removeClass('screen-reader-text');
            if (typeof $.fn.wc_variation_form !== 'undefined') {
              $variationForm.wc_variation_form();
            }

            if (typeof $.fn.wcboost_variation_swatches !== 'undefined') {
              $variationForm.wcboost_variation_swatches();
              $modalQuickAdd.trigger('init_variation_swatches.wcboost-variation-swatches');
            }
            if (typeof lazySizes !== 'undefined') {
              lazySizes?.loader?.checkElems();
            }
            $(".tf-variation-dropdown-wrapper .select-item", $variationForm).on('click', function (e) {
              e.preventDefault();
              if ($(this).hasClass('disabled')) {
                return false;
              }
              $('.select-item', $(this).closest('.tf-variant-dropdown')).removeClass('active');
              $('.current-value', $(this).closest('.tf-variant-dropdown')).text($(this).text());
              $('select', $(this).closest('.tf-variation-items')).val($(this).data('value')).change();
              $(this).addClass('active');
            });

            $variationForm
              .on('found_variation', function (e, data) {
                if (data?.image?.full_src) {
                  $image.attr('src', data.image.full_src);
                }
                if (data?.price_html) {
                  $price.html($(data.price_html).html());
                }
                if (data?.add_to_cart_text) {
                  $buttonText.text(data.add_to_cart_text);
                }
              })
              .on('hide_variation', function () {
                $(".tf-variation-dropdown-wrapper .select-item", $variationForm).removeClass("active");
                $image.attr('src', imageOrigin);
                $price.html(priceHTMlOrigin);
                $buttonText.text(buttonTextOrigin);
              });
            $modalQuickAdd.modal('show');

          }

        },
        complete: function () { }
      });
    });

    var buyNow = function () {
      if (!tfwc_woo_params?.buy_now) {
        return;
      }

      $(document).on('click', '.tf-buy-now-btn', function (e) {
        e.preventDefault();
        var $form = $(this).closest('form');

        if ($(this).hasClass('disabled')) {
          return;
        }

        if ($form.hasClass('variations_form') && !($('.variation_id', $form).val() > 0)) {
          alert('Please select some product options before buy this product.');
          return;
        }
        $('.button.single_add_to_cart_button', $form).trigger('click', true);
      });

    };

    var addToCart = function () {
      $(document).on('click', '.tf-main-product form.cart:not(.tf-external-form) button.single_add_to_cart_button', function (e, buyNow = false) {
        e.preventDefault();

        var $form = $(this).closest('form');
        var formData = $form.serialize();

        if ($(this).hasClass('disabled') || $(this).prop('disabled')) {
          return;
        }

        var productID = $(this).val();
        if (productID) {
          formData += '&add-to-cart=' + productID;
        }

        if (buyNow) {
          var formParams = new URLSearchParams(formData);
          formData += `&${tfwc_woo_params?.buy_now}=` + formParams.get('add-to-cart');
        }

        $.ajax({
          url: $form.attr('action'),
          type: 'POST',
          data: formData,
          beforeSend: function () {

            if (buyNow) {
              $('.tf-buy-now-btn', $form).addClass('disabled');
              $('.tf-buy-now-btn .tf-add-to-cart-loading', $form).removeClass('d-none');
              return;
            }
            $('button.single_add_to_cart_button', $form).addClass('disabled');
            $('button.single_add_to_cart_button', $form).prop('disabled', true);
            $('button.single_add_to_cart_button .tf-add-to-cart-loading', $form).removeClass('d-none');
          },
          success: function (response) {

            if (response.error) {
              // console.error(response.error_message);
            } else {

              let $response = $(response);
              if ($('.woocommerce-error li', $response).length > 0) {

                $.toast(
                  {
                    text: $('.woocommerce-error li', $response).first().text(),
                    showHideTransition: 'fade',
                    icon: 'info',
                    position: {
                      top: 50,
                      right: 20,
                    },
                    "type": "info",
                    "closeBtn": true,
                    "dismissible": true,
                    "append": true,
                    "shadow": true,
                    "duration": null,
                    "maxWidth": "400",
                    "animateOut": 100,
                    "animateIn": 100,
                    "actions": [],
                    "bgColor": "#21503f"
                  }
                )
              } else {
                if (buyNow) {
                  window.location.href = tfwc_woo_params?.checkout_url;
                  return;
                }

                $('.tf-mini-cart-items').addClass('loading-items');

                if ($('.popup-shopping-cart', $response).length > 0) {
                  $('.popup-shopping-cart').html($('.popup-shopping-cart', $response).html());
                  $('.tf-mini-cart-items').removeClass('loading-items');
                  showMiniCart();
                } else {
                  $(document.body).trigger('wc_fragment_refresh');
                  showMiniCart();
                }
                if ($('.nav-cart', $response).length > 0) {
                  $('.shopping-cart-items-count').html($('.shopping-cart-items-count', $response).html());
                }

              };
            }
            tf_swiper_slider();
          },
          complete: function () {
            if (buyNow) {
              $('.tf-buy-now-btn', $form).removeClass('disabled');
              $('.tf-buy-now-btn .tf-add-to-cart-loading', $form).addClass('d-none');
              return;
            }
            $('button.single_add_to_cart_button', $form).removeClass('disabled');
            $('button.single_add_to_cart_button', $form).prop('disabled', false);
            $('button.single_add_to_cart_button .tf-add-to-cart-loading', $form).addClass('d-none');
          }
        });
      });

    };

    $(document.body).on("wc_fragments_refreshed", function () {
      $('.tf-mini-cart-items').removeClass('loading-items');
    });

    addToCart();
    buyNow();

  }

  var showMiniCart = function () {
    if ($(".popup-shopping-cart").length > 0) {
      var offcanvas = new bootstrap.Offcanvas(document.getElementById('shoppingCart'));
      $('.modal-compare')?.modal('hide');
      $('.modal-quick-view')?.modal('hide');
      $('.modal-quick-add')?.modal('hide');
      offcanvas.show();
    }
  };

  var shopAddedToCart = function () {
    $(document).on('added_to_cart', function () {
      if ($(".popup-shopping-cart").length > 0 && $(".popup-shopping-cart").is(':visible')) {
        var offcanvas = new bootstrap.Offcanvas(document.getElementById('shoppingCart'));
        $('.modal-compare')?.modal('hide');
        $('.modal-quick-view')?.modal('hide');
        $('.modal-quick-add')?.modal('hide');
        offcanvas.show();
      }
    });
  };

  var swiper_slider = function () {

  }

  var swLayoutShop = function () {
    let isListActive = $(".sw-layout-list").hasClass("active");
    let userSelectedLayout = null;

    function hasValidLayout() {
      return (
        $("#gridLayout").hasClass("tf-col-2") ||
        $("#gridLayout").hasClass("tf-col-3") ||
        $("#gridLayout").hasClass("tf-col-4") ||
        $("#gridLayout").hasClass("tf-col-5") ||
        $("#gridLayout").hasClass("tf-col-6") ||
        $("#gridLayout").hasClass("tf-col-7")
      );
    }

    function updateLayoutDisplay() {
      const windowWidth = $(window).width();
      const currentLayout = $("#gridLayout").attr("class");

      if (!hasValidLayout()) {

        return;
      }

      if (isListActive) {
        $(".wrapper-control-shop")
          .addClass("listLayout-wrapper")
          .removeClass("gridLayout-wrapper");
        return;
      }

      if (userSelectedLayout) {
        if (windowWidth <= 767) {
          setGridLayout("tf-col-2");
        } else if (windowWidth <= 1200 && userSelectedLayout !== "tf-col-2") {
          setGridLayout("tf-col-3");
        } else if (
          windowWidth <= 1400 &&
          (userSelectedLayout === "tf-col-5" ||
            userSelectedLayout === "tf-col-6" ||
            userSelectedLayout === "tf-col-7")
        ) {
          setGridLayout("tf-col-4");
        } else {
          setGridLayout(userSelectedLayout);
        }
        return;
      }

      if (windowWidth <= 767) {
        if (!currentLayout.includes("tf-col-2")) {
          setGridLayout("tf-col-2");
        }
      } else if (windowWidth <= 1200) {
        if (!currentLayout.includes("tf-col-3")) {
          setGridLayout("tf-col-3");
        }
      } else if (windowWidth <= 1400) {
        if (
          currentLayout.includes("tf-col-5") ||
          currentLayout.includes("tf-col-6") ||
          currentLayout.includes("tf-col-7")
        ) {
          setGridLayout("tf-col-4");
        }
      } else {
        $("#gridLayout").show();
        $(".wrapper-control-shop")
          .addClass("gridLayout-wrapper")
          .removeClass("listLayout-wrapper");
      }
    }

    function setGridLayout(layoutClass) {
      $("#gridLayout")
        .show()
        .removeClass()
        .addClass(`wrapper-shop tf-grid-layout ${layoutClass}`);
      $(".tf-view-layout-switch").removeClass("active");
      $(`.tf-view-layout-switch[data-value-layout="${layoutClass}"]`).addClass(
        "active"
      );
      $(".wrapper-control-shop")
        .addClass("gridLayout-wrapper")
        .removeClass("listLayout-wrapper");
      isListActive = false;
    }

    $(document).ready(function () {
      if (isListActive) {
        $("#listLayout").show();
        $(".wrapper-control-shop")
          .addClass("listLayout-wrapper")
          .removeClass("gridLayout-wrapper");
      } else {
        updateLayoutDisplay();
      }
    });

    $(window).on("resize", updateLayoutDisplay);

    $(".tf-view-layout-switch").on("click", function () {
      const layout = $(this).data("value-layout");
      $(".tf-view-layout-switch").removeClass("active");
      $(this).addClass("active");
      $(".wrapper-control-shop").addClass("loading-shop");
      setTimeout(() => {
        $(".wrapper-control-shop").removeClass("loading-shop");

      }, 500);

      if (layout === "list") {
        isListActive = true;
        userSelectedLayout = null;
        $(".wrapper-control-shop")
          .addClass("listLayout-wrapper")
          .removeClass("gridLayout-wrapper");
      } else {
        userSelectedLayout = layout;
        setGridLayout(layout);
      }
    });
  };

  var toogle_categry = function () {
    $(".toggle-icon").on("click", function () {
      var subMenu = $(this).next(".sub-menu");
      if (subMenu.is(":visible")) {
        subMenu.slideUp();
        $(this).addClass("active");
      } else {
        subMenu.slideDown();
        $(this).removeClass("active");
      }
    });
  }

  var rangeTwoPrice = function () {
    const sliders = document.querySelectorAll(".price-val-range");

    sliders.forEach(function (skipSlider) {
      const min = parseInt(skipSlider.getAttribute("data-min")) || 0;
      const max = parseInt(skipSlider.getAttribute("data-max")) || 500;

      const startMin = parseInt(skipSlider.getAttribute("data-start-min")) || min;
      const startMax = parseInt(skipSlider.getAttribute("data-start-max")) || max;


      if (!skipSlider.noUiSlider) {
        noUiSlider.create(skipSlider, {
          start: [startMin, startMax],
          connect: true,
          step: 1,
          range: { min, max },
          format: {
            from: value => parseInt(value),
            to: value => parseInt(value),
          },
        });

        skipSlider.noUiSlider.on("update", function (val) {
          const currencyMin = document.querySelectorAll(".price-min-value");
          const currencyMax = document.querySelectorAll(".price-max-value");

          currencyMin.forEach(el => {
            el.innerText = parseInt(val[0]);
          });
          currencyMax.forEach(el => {
            el.innerText = parseInt(val[1]);
          });
        });

        skipSlider.noUiSlider.on("change", function (val) {
          sliders.forEach(otherSlider => {
            if (otherSlider !== skipSlider) {
              otherSlider.noUiSlider.set(val);
            }
          });
        });
      }
    });
  };

  var changeValueDropdown = function () {
    if ($(".tf-dropdown-sort").length > 0) {
      $(".select-item").on("click", function (event) {
        $(this)
          .closest(".tf-dropdown")
          .find(".text-sort-value")
          .text($(this).find(".text-value-item").text());

        $(this)
          .closest(".dropdown-menu")
          .find(".select-item.active")
          .removeClass("active");

        $(this).addClass("active");
      });
    }
  };

  function getSearchKeyword() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('s') || '';
  }

  var updateTotalCount = function () {

    if ($('#applied-filters').children().length) {
      $('.count-text-total').hide();
      $('.count-text').show();
    } else {
      $('.count-text-total').show();
      $('.count-text').hide();
    }

  };

  var filter_product = function () {
    function fetchFilteredProducts(page = 1, getCount = false, scrollTop = true) {
      var sortValue = $('.tf-dropdown-sort .select-item.active').data('sort-value');
      let selectedFilters = [];
      let selectedAttributes = {};
      let selectedCategories = [];
      let selectedBrand = [];
      let selectedAvailability = [];
      let minPrice = parseFloat($('#price-min-value').text().trim());
      let maxPrice = parseFloat($('#price-max-value').text().trim());

      let defaultMin = parseFloat($('#price-value-range').data('min'));
      let defaultMax = parseFloat($('#price-value-range').data('max'));

      let $priceInput = $('.vemus-price-input:checked');
      let dataPrice = $priceInput.data('price'),
        dataOperator = $priceInput.data('operator');


      if ($('#price-value-range').length > 0) {
        if (minPrice !== defaultMin || maxPrice !== defaultMax) {
          selectedFilters.push({ label: 'Price', value: `$${minPrice} - $${maxPrice}`, type: 'price' });
        }
      }

      var productStyle = getUrlParameter('product_style');
      if ($('.tf-view-layout-switch').hasClass('active')) {
        productStyle = $('.tf-view-layout-switch.active').data('style');
      }

      let seen_attr = new Set();
      $('.tf-attribute-filter.active').each(function () {
        let $input = $(this).find('input[name^="pa_"]');
        let attr = $input.attr('name');
        let attrValue = $input.data('value');
        let attrName = $input.data('name');

        let key = `${attr}:${attrValue}`;

        if (!seen_attr.has(key)) {
          seen_attr.add(key);

          if (!selectedAttributes[attr]) {
            selectedAttributes[attr] = [];
          }
          selectedAttributes[attr].push(attrValue);

          selectedFilters.push({
            label: attr.replace('pa_', ''),
            value: attrName,
            type: attr
          });
        }
      });

      $('input[name="brand"]:checked').each(function () {
        selectedBrand.push($(this).data('brand'));
        selectedFilters.push({ label: 'Brand', value: $(this).data('brandname'), type: 'brand' });

      });

      let seen = new Set();
      $('input[name="product_status"]:checked').each(function () {
        let checkboxValue = $(this).attr('data-available');

        if (!seen.has(checkboxValue)) {
          seen.add(checkboxValue);
          selectedAvailability.push(checkboxValue);
          selectedFilters.push({
            label: 'Availability',
            value: checkboxValue,
            type: 'product_status'
          });
        }
      });

      $('.tf_filter_category').each(function () {
        if ($(this).hasClass('active')) {
          let category = $(this).data('category');

          if (!selectedCategories.includes(category)) {
            selectedCategories.push(category);
            selectedFilters.push({
              label: 'Category',
              value: category,
              type: 'category'
            });
          }
        }
      });

      $('.vemus-price-input:checked').each(function () {

        let price = $(this).data('price');
        let operator = $(this).data('operator');
        let label = $(this).next('label').text();

        selectedFilters.push({
          label: label,
          value: price,
          operator: operator,
          type: 'price'
        });

      });

      let keywords = getSearchKeyword('s');

      var pagination_type = new URLSearchParams(window.location.search).get('pagination');
      let filterData = {
        action: 'filter_products',
        sortValue: sortValue,
        attributes: selectedAttributes,
        categories: selectedCategories,
        brand: selectedBrand,
        availability: selectedAvailability,
        // min_price: minPrice,
        // max_price: maxPrice,
        page: page,
        pagination_type: pagination_type,
        product_style: productStyle,
        nonce: tfwc_woo_params.nonce,
        s: keywords
      };

      if (minPrice !== defaultMin || maxPrice !== defaultMax) {
        filterData.min_price = minPrice;
        filterData.max_price = maxPrice;
      }

      if (dataPrice && dataOperator) {
        filterData.price = dataPrice;
        filterData.operator = dataOperator;
      }

      $.ajax({
        url: tfwc_woo_params.ajax_url,
        type: 'POST',
        data: filterData,
        beforeSend: function () {
          if (getCount) {
            return;
          }
          if (scrollTop) {
            scrollToElementWithOffset($('.tf-shop-control'), ($('.header-default:visible').height() || 0) + 32);
          }
          $('.wrapper-control-shop').addClass('loading-shop');
        },
        success: function (response) {

          $('.apply-filter-count').text(` [${response.data.product_count}]`);

          if (getCount) {
            return;
          }

          if (response.data.product_count > 0) {
            $('.products-content .wrapper-control-shop .wrapper-shop ').addClass('tf-grid-layout').html(response.data.products);
          } else {
            $('.products-content .wrapper-control-shop .wrapper-shop ').removeClass('tf-grid-layout').html(response.data.products);
          }

          let productCount = response.data.product_count;
          if (productCount == 0 || !response.data.next_page) {
            $('.woocommerce-pagination')
              .removeClass('ajax-pagination')
              // .attr('style', 'display: none !important;');
              .hide();
          } else {
            $('.woocommerce-pagination')
              .addClass('ajax-pagination')
              // .attr('style', 'display: flex !important;');
              .show();
          }

          let productText = productCount === 1 ? '1 Product found' : `${productCount} Products found`;
          $('.count-text').text(productText);

          $('.count-text-total .count-number').text(productCount);

          updateFilterDisplay(selectedFilters);
          vemusSaleMarquee();
          countDown();

          swatchColor();

          if (response.data.next_page) {
            $('#autoload-btn').show().data('page', page + 1);
          } else {
            $('#autoload-btn').hide();
          }

          $('.woocommerce-pagination').html(response.data.pagination);
          $('.products-content').removeClass('loading-content');
        },
        complete: function () {
          if (getCount) {
            return;
          }
          $('.wrapper-control-shop').removeClass('loading-shop');
        }
      });
    }

    $(document).on('change', '.meta-dropdown-filter .dropdown-filter', function (e) {
      $(this).find('.dropdown-toggle').removeClass('show');
      $(this).find('.dropdown-menu').removeClass('show');
    });

    $('.tf-attribute-filter').on('change', function (e) {
      e.preventDefault();

      const $this = $(this);
      const value = $this.find('input[type=hidden]').data('value');

      const willBeActive = !$this.hasClass('active');

      const checked = $(this).find('input').prop('checked');

      $('.tf-attribute-filter', $(this).closest('.filter-group-check')).removeClass('active').find('input').prop('checked', false);

      if (checked) {
        $this.addClass('active').find('input').prop('checked', true);
      }

      if ($('.tf-apply-filters-btn:visible', $(e.target).closest('.canvas-filter')).length && tfwc_woo_params?.filter_sidebar_button) {
        updateApplyButtonCount();
        return;
      }
      closeFilterOffcanvas();
      fetchFilteredProducts();
    });

    $('.tf_filter_category').on('change', function (e) {
      e.preventDefault();

      if ($(this).prop('checked')) {
        $('.tf_filter_category', $(this).closest('.filter-group-check')).not(this).prop('checked', false).removeClass('active');
        $('.tf_filter_category').removeClass('active');
        $(this).addClass('active');
      } else {
        $(this).removeClass('active');
      }
      if ($('.tf-apply-filters-btn:visible', $(e.target).closest('.canvas-filter')).length && tfwc_woo_params?.filter_sidebar_button) {
        updateApplyButtonCount();
        return;
      }
      closeFilterOffcanvas();
      fetchFilteredProducts();
    });

    $('#availability .tf-check').on('change', function (e) {
      // e.preventDefault();

      if ($(this).prop('checked')) {
        $('#availability .tf-check').not(this)
          .prop('checked', false)
          .removeClass('active');

        $(this).addClass('active');
      } else {
        $(this).removeClass('active');
      }
      if ($('.tf-apply-filters-btn:visible', $(e.target).closest('.canvas-filter')).length && tfwc_woo_params?.filter_sidebar_button) {
        updateApplyButtonCount();
        return;
      }
      closeFilterOffcanvas();
      fetchFilteredProducts();
    });

    $(document).on('change', '.vemus-price-input', function (e) {
      e.preventDefault();

      if ($(this).prop('checked')) {
        $('.vemus-price-input').not(this).prop('checked', false);
      }

      if ($('.tf-apply-filters-btn:visible', $(e.target).closest('.canvas-filter')).length && tfwc_woo_params?.filter_sidebar_button) {
        updateApplyButtonCount();
        return;
      }

      closeFilterOffcanvas();
      fetchFilteredProducts();
    });

    $(document).on('click', '.tf-dropdown-sort .select-item', function (e) {
      $('.text-sort-value').text($(this).find('.text-value-item').text());
      closeFilterOffcanvas();
      fetchFilteredProducts();
    })

    $(document).on('click', '.tf-view-layout-switch', function (e) {
      e.preventDefault();
      $('.tf-view-layout-switch').removeClass('active');
      $(this).addClass('active');
      fetchFilteredProducts();
    })

    $(document).on('click', '.remove-all-filters, .tf-clear-filters-btn', function () {
      closeFilterOffcanvas();
      clearAllFilters();
    });

    $(document).on('click', '.tf-apply-filters-btn', function () {
      closeFilterOffcanvas();
      fetchFilteredProducts();
    });

    var updateApplyButtonCount = function () {
      fetchFilteredProducts(1, true);
    };

    function updateFilterDisplay(selectedFilters) {
      let filterContainer = $('.selected-filters');
      filterContainer.empty();
      if (selectedFilters.length > 0) {
        selectedFilters.forEach(filter => {
          let filterItem;
          if (filter?.type == 'price') {
            filterItem = $(
              `<span class="filter-tag" data-type="${filter.type}" data-value="${filter.value}" data-operator="${filter.operator}">
                      <span class="remove-tag icon-close"></span> ${filter.label}
                </span>`
            );

            filterItem.on('click', function () {
              removeFilter($(this).data('type'), $(this).data('value'), $(this).data('operator'));
            });

          } else {
            filterItem = $(
              `<span class="filter-tag" data-type="${filter.type}" data-value="${filter.value}">
                <span class="remove-tag icon-close"></span> ${filter.label}: ${filter.value}
              </span>`
            );

            filterItem.on('click', function () {
              removeFilter($(this).data('type'), $(this).data('value'));
            });
          }
          filterContainer.append(filterItem);
        });

        // let clearAll = $('<span class="remove-all-filters"><span class="icon icon-close"></span> Clear All Filter</span>');
        // filterContainer.append(clearAll);

        if ($('.filter-tag', filterContainer).length < 2) {
          $('.remove-all-filters').hide();
        } else {
          $('.remove-all-filters').show();
        }

        $(".apply-filter-wrap", ".canvas-filter.left").slideDown(300).fadeIn(300);
        $(".apply-filter-wrap", ".canvas-filter.right").slideDown(300).fadeIn(300);
      } else {
        $('.count-text').text('');
        $('.remove-all-filters').hide();
        $(".apply-filter-wrap", ".canvas-filter.left").slideUp(300).fadeOut(300);
        $(".apply-filter-wrap", ".canvas-filter.right").slideUp(300).fadeOut(300);
      }
      updateTotalCount();
    }

    function removeFilter(type, value, operator = '') {
      switch (type) {
        case 'price':
          $('input.vemus-price-input[data-price="' + value + '"][data-operator="' + operator + '"]').prop('checked', false);
          break;
        case 'category':
          $('.tf_filter_category[data-category="' + value + '"]').prop('checked', false).removeClass('active');
          break;
        case 'brand':
          $('input[data-brandname="' + value + '"]').prop('checked', false);
          break;
        case 'product_status':
          $('input[data-available="' + value + '"]').each(function () {
            $(this).prop('checked', false);
            $(this).closest('li').removeClass('active');
          });
          break;
        default:
          $('input[data-name="' + value + '"]').each(function () {
            if ($(this).data('name') === value) {
              $(this).prop('checked', false);
              $(this).closest('.tf-attribute-filter').removeClass('active');
            }
          });
          break;
      }

      fetchFilteredProducts();
    }

    $('.reset-price').on('click', function (e) {
      e.preventDefault();
      let defaultMin = parseFloat($('#price-value-range').data('min'));
      let defaultMax = parseFloat($('#price-value-range').data('max'));

      $('#price-min-value').text(defaultMin);
      $('#price-max-value').text(defaultMax);
      fetchFilteredProducts();
    })

    function clearAllFilters() {

      $('.tf-control-filter input, .sidebar-filter input')
        .prop('checked', false)
        .val('');

      $('.tf-control-filter .list-item, .sidebar-filter .list-item').removeClass('active');

      $('.tf-control-filter .tf-check, .sidebar-filter .tf-check').removeClass('active');

      $('.tf-control-filter .check-item, .sidebar-filter .check-item').removeClass('active');

      let defaultMin = parseFloat($('#price-value-range').data('min'));
      let defaultMax = parseFloat($('#price-value-range').data('max'));

      $('#price-min-value').text(defaultMin);
      $('#price-max-value').text(defaultMax);

      fetchFilteredProducts();
    }

    $(document).on('click', '.woocommerce-pagination.ajax-pagination .page-numbers a', function (e) {
      e.preventDefault();
      // scrollToElementWithOffset($('.tf-shop-control'), ($('.header-default:visible').height() || 0) + 32);
      var href = $(this).attr('href');
      var page = 1;

      var match = href.match(/(?:paged=|page\/)(\d+)/);

      if (match && match[1]) {
        page = match[1];
      }

      fetchFilteredProducts(page);
    });

    $(document).on('click', '#load-more-btn', function (e) {
      e.preventDefault();

      let currentPage = $(this).data('page');

      appendFilteredProducts(currentPage);
      let nextPage = currentPage + 1;

      $(this).data('page', nextPage);
    });

    function appendFilteredProducts(page = 1) {
      let selectedFilters = [];
      let selectedAttributes = {};
      let selectedCategories = [];
      let selectedBrand = [];
      let selectedAvailability = [];
      let minPrice = parseFloat($('#price-min-value').text().trim());
      let maxPrice = parseFloat($('#price-max-value').text().trim());
      var sortValue = $('.tf-dropdown-sort .select-item.active').data('sort-value');
      let defaultMin = parseFloat($('#price-value-range').data('min'));
      let defaultMax = parseFloat($('#price-value-range').data('max'));

      var productStyle = getUrlParameter('product_style');
      if ($('.tf-view-layout-switch').hasClass('active')) {
        productStyle = $('.tf-view-layout-switch.active').data('style');
      }

      if ($('#price-value-range').length > 0) {
        if (minPrice !== defaultMin || maxPrice !== defaultMax) {
          selectedFilters.push({ label: 'Price', value: `$${minPrice} - $${maxPrice}`, type: 'price' });
        }
      }

      $('.tf-attribute-filter.active').each(function () {
        let attr = $(this).find('input[name^="pa_"]').attr('name');
        let attrValue = $(this).find('input[name^="pa_"]').data('value');
        let attrName = $(this).find('input[name^="pa_"]').data('name');

        if (!selectedAttributes[attr]) {
          selectedAttributes[attr] = [];
        }

        selectedAttributes[attr].push(attrValue);

        selectedFilters.push({ label: attr.replace('pa_', ''), value: attrName, type: attr });
      });

      $('input[name="brand"]:checked').each(function () {
        selectedBrand.push($(this).data('brand'));
        selectedFilters.push({ label: 'Brand', value: $(this).data('brandname'), type: 'brand' });

      });

      let seen = new Set();
      $('input[name="product_status"]:checked').each(function () {
        let checkboxValue = $(this).attr('data-available');

        if (!seen.has(checkboxValue)) {
          seen.add(checkboxValue);
          selectedAvailability.push(checkboxValue);
          selectedFilters.push({
            label: 'Availability',
            value: checkboxValue,
            type: 'product_status'
          });
        }
      });

      $('.tf_filter_category').each(function () {
        if ($(this).hasClass('active')) {
          selectedCategories.push($(this).data('category'));
          selectedFilters.push({ label: 'Category', value: $(this).data('category'), type: 'category' });
        }
      });

      var pagination_type = new URLSearchParams(window.location.search).get('pagination');

      let keywords = getSearchKeyword('s');

      let filterData = {
        action: 'filter_products',
        attributes: selectedAttributes,
        categories: selectedCategories,
        brand: selectedBrand,
        availability: selectedAvailability,
        min_price: minPrice,
        max_price: maxPrice,
        page: page,
        pagination_type: pagination_type,
        sortValue: sortValue,
        product_style: productStyle,
        nonce: tfwc_woo_params.nonce,
        s: keywords,
      };

      $.ajax({
        url: tfwc_woo_params.ajax_url,
        type: 'POST',
        data: filterData,
        beforeSend: function () {
          $('#load-more-btn').addClass('loading');
        },
        success: function (response) {
          $('.woocommerce-pagination').html(response?.data?.pagination);

          if (response.data.product_count > 0) {
            var productsHtml = '';
            response.data.products.forEach(function (productHtml) {

              productsHtml += '<div class="tf-new-product-fadein" style="display:none;">' + productHtml + '</div>';
            });

            var $wrapper = $('.products-content .wrapper-control-shop .wrapper-shop');

            $wrapper.append(productsHtml);

            $wrapper.find('.tf-new-product-fadein').each(function (index) {
              $(this).delay(150 * index)
                .fadeIn(500, function () {
                  $(this).removeClass('tf-new-product-fadein');

                  if (index === 0) {
                    let offsetScroll = $(this).offset().top - ($('.header-default:visible').height() || 0);
                    offsetScroll = offsetScroll - 32 // Padding;

                    if ($("#wpadminbar:visible").length) {
                      offsetScroll = offsetScroll - $("#wpadminbar:visible").height();
                    }

                    window.scrollTo({
                      top: offsetScroll,
                      behavior: 'smooth'
                    });
                  }

                });
            });

          }

          let productCount = response.data.product_count;
          if (productCount == 0 || !response.data.next_page) {
            $('.woocommerce-pagination')
              .removeClass('ajax-pagination')
              .hide();
          } else {
            $('.woocommerce-pagination')
              .addClass('ajax-pagination')
              // .attr('style', 'display: flex !important;');
              .show();
          }

          let productText = productCount === 1 ? '1 Product found' : `${productCount} Products found`;
          $('.count-text').text(productText);
          vemusSaleMarquee();
          countDown();
          swatchColor();

        },
        complete: function () {
          $('#load-more-btn').removeClass('loading');
        }
      });
    }

    let loading = false;

    var isFading = false;
    var fadeQueue = [];

    checkAutoLoad();

    $(window).scroll(function () {
      checkAutoLoad();
    });

    function checkAutoLoad() {
      if ($('#autoload-btn:visible').length == 0) {
        return
      }
      var footerTop = $('#autoload-btn').offset().top;
      var scrollBottom = $(window).scrollTop() + $(window).height();

      if (scrollBottom >= footerTop) {
        autoFilteredProducts();
      }
    }

    function addFadeItems($items) {
      fadeQueue.push($items);
      runFadeQueue();
    }

    function runFadeQueue() {
      if (isFading) return;
      if (fadeQueue.length === 0) {
        checkAutoLoad();
        return;
      }

      var $items = fadeQueue.shift();
      isFading = true;

      $items.each(function (index) {
        $(this)
          .delay(150 * index)
          .fadeIn(500, function () {
            $(this).removeClass('tf-new-product-fadein');

            if (index === $items.length - 1) {
              isFading = false;
              runFadeQueue();
            }
          });
      });
    }

    function autoFilteredProducts() {
      if (loading) return;
      loading = true;
      let page = $('#autoload-btn').data('page');
      var pagination_type = new URLSearchParams(window.location.search).get('pagination');

      let $priceInput = $('.vemus-price-input:checked');
      let dataPrice = $priceInput.data('price'),
        dataOperator = $priceInput.data('operator');

      var sortValue = $('.tf-dropdown-sort .select-item.active').data('sort-value');
      let selectedFilters = [];
      let selectedAttributes = {};
      let selectedCategories = [];
      let selectedBrand = [];
      let selectedAvailability = [];
      let minPrice = parseFloat($('#price-min-value').text().trim());
      let maxPrice = parseFloat($('#price-max-value').text().trim());

      let defaultMin = parseFloat($('#price-value-range').data('min'));
      let defaultMax = parseFloat($('#price-value-range').data('max'));

      if ($('#price-value-range').length > 0) {
        if (minPrice !== defaultMin || maxPrice !== defaultMax) {
          selectedFilters.push({ label: 'Price', value: `$${minPrice} - $${maxPrice}`, type: 'price' });
        }
      }

      var productStyle = getUrlParameter('product_style');
      if ($('.tf-view-layout-switch').hasClass('active')) {
        productStyle = $('.tf-view-layout-switch.active').data('style');
      }

      let seen_attr = new Set();
      $('.tf-attribute-filter.active').each(function () {
        let $input = $(this).find('input[name^="pa_"]');
        let attr = $input.attr('name');
        let attrValue = $input.data('value');
        let attrName = $input.data('name');

        let key = `${attr}:${attrValue}`;

        if (!seen_attr.has(key)) {
          seen_attr.add(key);

          if (!selectedAttributes[attr]) {
            selectedAttributes[attr] = [];
          }
          selectedAttributes[attr].push(attrValue);

          selectedFilters.push({
            label: attr.replace('pa_', ''),
            value: attrName,
            type: attr
          });
        }
      });

      $('input[name="brand"]:checked').each(function () {
        selectedBrand.push($(this).data('brand'));
        selectedFilters.push({ label: 'Brand', value: $(this).data('brandname'), type: 'brand' });
      });

      let seen = new Set();
      $('input[name="product_status"]:checked').each(function () {
        let checkboxValue = $(this).attr('data-available');

        if (!seen.has(checkboxValue)) {
          seen.add(checkboxValue);
          selectedAvailability.push(checkboxValue);
          selectedFilters.push({
            label: 'Availability',
            value: checkboxValue,
            type: 'product_status'
          });
        }
      });

      $('.tf_filter_category').each(function () {
        if ($(this).hasClass('active')) {
          let category = $(this).data('category');

          if (!selectedCategories.includes(category)) {
            selectedCategories.push(category);
            selectedFilters.push({
              label: 'Category',
              value: category,
              type: 'category'
            });
          }
        }
      });

      let keywords = getSearchKeyword('s');

      let filterData = {
        action: 'filter_products',
        attributes: selectedAttributes,
        categories: selectedCategories,
        brand: selectedBrand,
        availability: selectedAvailability,
        // min_price: minPrice,
        // max_price: maxPrice,
        page: page,
        pagination_type: pagination_type,
        sortValue: sortValue,
        product_style: productStyle,
        nonce: tfwc_woo_params.nonce,
        s: keywords,
      };

      if (dataPrice && dataOperator) {
        filterData.price = dataPrice;
        filterData.operator = dataOperator;
      }

      $.ajax({
        url: tfwc_woo_params.ajax_url,
        type: 'POST',
        data: filterData,
        beforeSend: function () {
        },
        success: function (response) {
          if (response.data.product_count > 0) {
            var productsHtml = '';
            response.data.products.forEach(function (productHtml) {

              productsHtml += '<div class="tf-new-product-fadein" style="display:none;">' + productHtml + '</div>';
            });

            var $newItems = $(productsHtml).appendTo($('.products-content .wrapper-control-shop .wrapper-shop'));
            addFadeItems($newItems);
            checkAutoLoad();
          }
          let productCount = response.data.product_count;
          if (productCount == 0 || !response.data.next_page) {
            $('.woocommerce-pagination')
              .removeClass('ajax-pagination')
              // .attr('style', 'display: none !important;');
              .hide();
          } else {
            $('.woocommerce-pagination')
              .addClass('ajax-pagination')
              // .attr('style', 'display: flex !important;');
              .show();
          }

          let productText = productCount === 1 ? '1 Product found' : `${productCount} Products found`;
          $('.count-text').text(productText);
          // updateFilterDisplay(selectedFilters);
          // quickview_product();
          vemusSaleMarquee();
          countDown();
          swatchColor();
          // compare();
          if (response.data.next_page) {
            $('#autoload-btn').show().data('page', page + 1);
          } else {
            $('#autoload-btn').hide();
          }
          loading = false;
          $('.woocommerce-pagination').html(response.data.pagination);
        }
      });
    }

    function getUrlParameter(name) {
      var url = window.location.href;
      var regex = new RegExp('[?&]' + name + '=([^&#]*)', 'i');
      var results = regex.exec(url);
      return results === null ? null : decodeURIComponent(results[1]);
    }

    function closeFilterOffcanvas() {

      var offcanvasElement = document.getElementById('filterShop');
      if (offcanvasElement) {
        const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement) || new bootstrap.Offcanvas(offcanvasElement);
        offcanvas.hide();
      }
      $(".sidebar-filter, .overlay-filter").removeClass("show");
    }

    $('input.tf-check:checked').trigger('change');
  }

  var ajax_search = function () {
    // Search popup
    let typingTimer;
    let searchInput = $(".ajax-search-input");

    // let resultsContainer = $(".offcanvas-search .result-product .swiper-wrapper");
    let resultsContainer = $(".offcanvas-search .results-product");
    let resultsCatContainer = $(".offcanvas-search .results-collection");
    let resultsSuggestionContainer = $(".offcanvas-search .results-suggestion");

    let result_show = $(".offcanvas-search .result-product");
    let featured_show = $(".offcanvas-search .featured-product");

    result_show.hide();
    featured_show.show();
    let searchButton = $(".form-search button i");
    let searchCache = JSON.parse(sessionStorage.getItem("searchCache")) || {};

    let doneTypingInterval = 500;

    searchInput.on("input", function () {
      clearTimeout(typingTimer);
      let query = $(this).val().trim();

      if (query.length >= 2) {
        featured_show.hide();
        result_show.show();

        typingTimer = setTimeout(function () {
          if (searchCache[query] !== undefined) {

            if (searchCache[query]?.products) {
              $(".swiper-wrapper", resultsContainer).html(searchCache[query]?.products || '');
              vemusSwiper(resultsContainer); countDown();
              countDown();
              swatchColor();
              resultsContainer.show();
            } else if (searchCache[query]?.categories) {
              // resultsContainer.hide();
            } else {
              resultsContainer.show();
            }

            if (searchCache[query]?.categories) {
              $(".results-content", resultsCatContainer).html(searchCache[query]?.categories || '');
              resultsCatContainer.show();
            } else {
              resultsCatContainer.hide();
            }

            if (searchCache[query]?.view_all_html) {
              $(".tfwc-view-all", resultsContainer).html(searchCache[query]?.view_all_html).show();
            } else {
              $(".tfwc-view-all", resultsContainer).hide();
            }

            if (!searchCache[query]?.products) {
              $(".quick-link-content").show();
              resultsSuggestionContainer.show();
              $(".swiper-wrapper", resultsContainer).html('<div class="no-results">Looks like there’s nothing here. Would you like to browse our most popular items?</div>');
              resultsContainer.show();
            } else {
              $(".quick-link-content").hide();
              resultsSuggestionContainer.hide();
            }

            return;
          }

          $.ajax({
            type: "POST",
            url: tfwc_woo_params.ajax_url,
            data: {
              action: "tfwc_search_products",
              query: query,
              nonce: tfwc_woo_params.nonce,
            },
            beforeSend: function () {
              $(".swiper-wrapper", resultsContainer).addClass('loading-content');
              $(".tf-search-container").addClass("loading-items");
            },
            success: function (response) {
              if (response.success) {
                if (response.data?.products) {
                  $(".swiper-wrapper", resultsContainer).html(response.data?.products || '');
                  vemusSwiper(resultsContainer);
                  // swiper_slider();
                  // quickview_product();
                  countDown();
                  swatchColor();
                  // compare();
                  resultsContainer.show();
                } else if (response.data?.categories) {
                  // resultsContainer.hide();
                } else {
                  resultsContainer.show();
                }

                if (response.data?.categories) {
                  $(".results-content", resultsCatContainer).html(response.data?.categories || '');
                  resultsCatContainer.show();
                } else {
                  resultsCatContainer.hide();
                }

                if (response.data?.view_all_html) {
                  $(".tfwc-view-all", resultsContainer).html(response.data?.view_all_html).show();
                } else {
                  $(".tfwc-view-all", resultsContainer).hide();
                }

                if (!response.data?.products) {
                  $(".quick-link-content").show();
                  resultsSuggestionContainer.show();
                  $(".swiper-wrapper", resultsContainer).html('<div class="no-results">Looks like there’s nothing here. Would you like to browse our most popular items?</div>');
                  resultsContainer.show();

                } else {
                  $(".quick-link-content").hide();
                  resultsSuggestionContainer.hide();
                }

                searchCache[query] = response.data || {};
                sessionStorage.setItem("searchCache", JSON.stringify(searchCache));

              } else {
                $(".quick-link-content").show();
                resultsSuggestionContainer.show();
                $(".swiper-wrapper", resultsContainer).html('<div class="no-results">Looks like there’s nothing here. Would you like to browse our most popular items?</div>');
              }
            },
            error: function () {
              $(".quick-link-content").show();
              resultsSuggestionContainer.show();
              $(".swiper-wrapper", resultsContainer).html('<div class="error">Error!</div>');
            },
            complete: function () {
              $(".swiper-wrapper", resultsContainer).removeClass('loading-content');
              $(".tf-search-container").removeClass("loading-items");
            }
          });
        }, doneTypingInterval);
      } else {
        // resultsContainer.html("");
        result_show.hide();
        featured_show.show();

        resultsContainer.hide();
        resultsCatContainer.hide();

        $(".quick-link-content").show();
        resultsSuggestionContainer.show();

      }
    });

    $(document).on("click", ".clear-search-text", function (e) {
      e.preventDefault();
      $(".ajax-search-input").val("").trigger("input");
    });

    $(document).on("blur input change", ".ajax-search-input", function (e) {
      e.preventDefault();
      if ($(this).val()) {
        $(".clear-search-text").show();
      } else {
        $(".clear-search-text").hide();
      }
    });

    $(".form-search").on("submit", function (e) {
      e.preventDefault();

      let query = searchInput.val().trim();

      if (query.length >= 2) {

        let currentPath = window.location.pathname;
        let subFolder = currentPath.split('/')[1] || '';

        let searchUrl = (subFolder ? "/" + subFolder : "") + "/?s=" + encodeURIComponent(query);

        if (subFolder === '') {
          searchUrl = window.location.origin + searchUrl;
        }

        window.location.href = searchUrl;
      }
    });

    // Search header
    let searchInputHeader = $(".ajax-search-input-header");
    let resultsHeaderContainer = $(".search-suggests-results .search-suggests-results-inner ul");
    let searchHeaderButton = searchInputHeader.closest(".form-search").find(".btn-search i");
    let searchformButton = searchInputHeader.closest(".tf-form-search");

    let searchCacheHeader = JSON.parse(sessionStorage.getItem("searchCacheHeader")) || {};
    let doneTypingIntervalHeader = 500;

    searchInputHeader.on("input", function () {
      clearTimeout(typingTimer);
      let query = $(this).val().trim();

      if (query.length >= 2) {
        searchformButton.addClass('active');
        let category = $(".search-category-select").val();
        typingTimer = setTimeout(function () {
          if (searchCacheHeader[query]) {
            resultsHeaderContainer.html(searchCacheHeader[query]);
            return;
          }

          $.ajax({
            type: "POST",
            url: tfwc_woo_params.ajax_url,
            data: {
              action: "tfwc_search_products_header",
              query: query,
              category: category,
              nonce: tfwc_woo_params.nonce,
            },
            beforeSend: function () {
              resultsHeaderContainer.addClass('loading-content');
            },
            success: function (response) {
              if (response.success) {
                resultsHeaderContainer.html(response.data);
                searchCacheHeader[query] = response.data;
                sessionStorage.setItem("searchCacheHeader", JSON.stringify(searchCacheHeader));
                swiper_slider();
                // quickview_product();
                // countDown();
                swatchColor();
                // compare();
                resultsHeaderContainer.removeClass('loading-content');
              } else {
                resultsHeaderContainer.html('<div class="no-results">No product found</div>');
                resultsHeaderContainer.removeClass('loading-content');
              }

            },
            error: function () {
              resultsHeaderContainer.html('<div class="error">Error!</div>');
              resultsHeaderContainer.removeClass('loading-content');
            }
          });
        }, doneTypingIntervalHeader);
      } else {
        // resultsContainer.html("");
      }
    });

    $(document).on("click", function (e) {
      if (!$(e.target).closest(".tf-form-search").length) {
        searchformButton.removeClass('active');
      }
    });

    $(".tf-form-search").on("submit", function (e) {
      e.preventDefault();

      let query = $(".ajax-search-input-header").val().trim();
      let category = $(".search-category-select").val();

      if (query.length >= 2) {

        let currentPath = window.location.pathname;
        let subFolder = currentPath.split('/')[1] || '';

        let searchUrl = (subFolder ? "/" + subFolder : "") + "/?s=" + encodeURIComponent(query) + "&post_type=product";

        if (category) {
          searchUrl += "&product_cat=" + encodeURIComponent(category);
        }

        if (subFolder === '') {
          searchUrl = window.location.origin + searchUrl;
        }

        window.location.href = searchUrl;
      }
    });
  };

  var remove_item = function () {
    $(document).on('click', '.remove_from_cart_button', function (e) {
      e.preventDefault();

      var $this = $(this),
        cart_item_key = $this.data('cart_item_key');
      var $cart_item = $this.closest('.mini_cart_item');

      $cart_item.addClass('loading-content');

      var data = {
        action: 'remove_cart_item',
        cart_item_key: cart_item_key,
        nonce: tfwc_woo_params.nonce,
      };
      $.ajax({
        url: tfwc_woo_params.ajax_url,
        type: 'POST',
        data: data,
        success: function (response) {
          if (response.fragments) {
            $.each(response.fragments, function (fragment, content) {
              $(fragment).replaceWith(content);
            });

            $(document.body).trigger('wc_fragments_refreshed');
            tf_swiper_slider();
          }

          $cart_item.removeClass('loading-content');
        },
        error: function () {
          $cart_item.removeClass('loading-content');
        }
      });
    })
  }

  var update_cart = function () {
    $(document.body).on('updated_wc_div', function () {
      $.ajax({
        url: wc_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_refreshed_fragments'),
        type: 'POST',
        success: function (response) {
          if (response.fragments) {
            $.each(response.fragments, function (fragment, content) {
              $(fragment).replaceWith(content);
            });
          }
          tf_swiper_slider();
        }
      });
    });
  }

  var handleProgress = function () {
    function handleProgressBar(showEvent, hideEvent, target) {
      $(".tf-progress-bar .value").css("width", "0%");
      $(target).on(hideEvent, function () {
        $(".tf-progress-bar .value").css("width", "0%");
      });

      $(target).on(showEvent, function () {
        setTimeout(function () {
          var progressValue = $(".tf-progress-bar .value").data("progress");
          $(".tf-progress-bar .value").css("width", progressValue + "%");
        }, 600);
      });
    }

    if ($(".popup-shopping-cart").length > 0) {
      handleProgressBar("show.bs.offcanvas", "hide.bs.offcanvas", ".popup-shopping-cart");
    }

    if ($(".modal-shopping-cart").length > 0) {
      handleProgressBar("show.bs.modal", "hide.bs.modal", ".modal-shopping-cart");
    }
  };

  var clickMinicartPopup = function () {
    $(document).on("click", ".btn-quickview", function () {
      $("#quickView").modal("show");
    });

    $(document).on("click", ".btn-addtocart,.nav-cart a", function () {
      tf_swiper_slider();
    });

    $(document).on("click", ".btn-add-gift", function () {
      $('.tf-mini-cart-tool-openable').removeClass('open');
      $(".add-gift").addClass("open");
    });

    $(document).on("click", ".btn-add-note", function () {
      $('.tf-mini-cart-tool-openable').removeClass('open');
      $(".add-note").addClass("open");
    });

    $(document).on("click", ".btn-coupon", function () {
      $('.tf-mini-cart-tool-openable').removeClass('open');
      $(".coupon").addClass("open");
    });

    $(document).on("click", ".btn-estimate-shipping", function () {
      $('.tf-mini-cart-tool-openable').removeClass('open');
      $(".estimate-shipping").addClass("open");
    });

    $(document).on("click", ".tf-mini-cart-tool-close", function () {
      $(".tf-mini-cart-tool-openable").removeClass("open");
      $('.shipping-calculator-form').hide().removeClass('open');
    });
  };

  var save_order_note = function () {
    let noteForm = $(".add-note .tf-mini-cart-tool-content");

    if (noteForm.length == 0) {
      return;
    }

    $(document).on("submit", noteForm, function (e) {
      let notice = $('.notice-order-note');
      notice.html('');
      e.preventDefault();
      let noteTextarea = $("#Cart-note");
      var note = noteTextarea.val();

      if (note != '') {
        $.ajax({
          url: tfwc_woo_params.ajax_url,
          type: "POST",
          data: {
            action: "save_order_note",
            order_comments: noteTextarea.val(),
            nonce: tfwc_woo_params.nonce,
          },
          beforeSend: function () {
            $('.add-note .subscribe-button').addClass('loading');
          },
          success: function (response) {
            if (response.success) {
              $('.add-note .subscribe-button').removeClass('loading');
              notice.html('Save successfully!');
              $(".tf-mini-cart-tool-openable").removeClass("open");
            }
          },
        });
      } else {
        notice.html('Please Enter Note');
      }

    });
  };

  var vemusSwiper = function ($container = null) {

    if (!$container) {
      $container = document;
    }
    $(".vemus-swiper", $container).each(function (index, element) {
      var $this = $(element);
      if ($this.children('.swiper-wrapper').length < 2) {
        return;
      }

      var preview = $this.data("preview") || 1;
      var tablet = $this.data("tablet") || 1;
      var mobile = $this.data("mobile") || 1;
      var mobileSm = $this.data("mobile-sm") !== undefined ? $this.data("mobile-sm") : mobile;

      // Spacing
      var spacing = $this.data("space");
      var spacingMd = $this.data("space-md");
      var spacingLg = $this.data("space-lg");
      if (spacing !== undefined && spacingMd === undefined && spacingLg === undefined) {
        spacingMd = spacing;
        spacingLg = spacing;
      } else if (spacing === undefined && spacingMd !== undefined && spacingLg === undefined) {
        spacing = 0;
        spacingLg = spacingMd;
      }
      spacing = spacing || 0;
      spacingMd = spacingMd || 0;
      spacingLg = spacingLg || 0;

      var perGroup = $this.data("pagination") || 1;
      var perGroupSm = $this.data("pagination-sm") || 1;
      var perGroupMd = $this.data("pagination-md") || 1;
      var perGroupLg = $this.data("pagination-lg") || 1;
      var gridRows = $this.data("grid") || 1;
      var cursorType = $this.data("cursor") ?? false;
      var loop = $this.data("loop") ?? false;
      var loopMd = $this.data("loop-md") ?? false;
      var effect = $this.data("effect") || "slide";
      var atPlay = $this.data("auto"); // True || False
      var speed = $this.data("speed") || 800;
      var delay = $this.data("delay") || 1000;
      var direction = $this.data("direction") || "horizontal";

      let configs = {
        direction: direction,
        speed: speed,
        slidesPerView: mobile,
        spaceBetween: spacing,
        slidesPerGroup: perGroup,
        grabCursor: cursorType,
        loop: loop,
        effect: effect,
        autoplay: atPlay
          ? {
            delay: delay,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
          }
          : false,
        pagination: {
          el: [$this.find(".tf-sw-pagination")[0], $this.closest(".tf-pag-swiper").find(".tf-sw-pagination")[0]],
          clickable: true,
        },
        observer: true,
        observeParents: true,
        navigation: {
          nextEl: [
            $this.closest(".tf-btn-swiper-item").find(".nav-next-swiper")[0],
            $this.closest(".container").find(".group-btn-slider .nav-next-swiper")[0],
          ],
          prevEl: [
            $this.closest(".tf-btn-swiper-item").find(".nav-prev-swiper")[0],
            $this.closest(".container").find(".group-btn-slider .nav-prev-swiper")[0],
          ],
        },
        breakpoints: {
          575: {
            slidesPerView: mobileSm,
            spaceBetween: spacing,
            slidesPerGroup: perGroupSm,
          },
          768: {
            slidesPerView: tablet,
            spaceBetween: spacingMd,
            slidesPerGroup: perGroupMd,
          },
          1200: {
            slidesPerView: preview,
            spaceBetween: spacingLg,
            slidesPerGroup: perGroupLg,
          },
        },
      };

      var swiperT = new Swiper($this[0], configs);
      $(".swiper-button")
        .on("mouseenter", function () {
          var slideIndex = $(this).data("slide");
          swiperT.slideTo(slideIndex, 500, false);

          $(".tf-swiper .card_product--V01.style_2").removeClass("active");
          $(".tf-swiper .card_product--V01.style_2").eq(slideIndex).addClass("active");
        })
        .on("mouseleave", function () {
          $(".tf-swiper .card_product--V01.style_2").removeClass("active");
        })
        .on("click", function () {
          var slideIndex = $(this).data("slide");
          $(".tf-swiper .card_product--V01.style_2").eq(slideIndex).toggleClass("clicked");
        });
    });
  }

  var updateCart = function () {
    let isLoading = false;

    $(document).on('change', '.woocommerce-cart-form .tf-add-gift, .woocommerce-cart-form .order-comments', function () {
      $('.tf-update-cart-btn').prop('disabled', false);
    });

    $(document).on('click', '.tf-update-cart-btn', function () {
      return;

      if (isLoading) {
        return;
      }

      let isAdding = $('.woocommerce-cart-form .tf-add-gift').prop('checked');

      let noteContent = $('.woocommerce-cart-form .order-comments').val();

      // Gift
      $.ajax({
        type: 'POST',
        url: tfwc_woo_params.ajax_url,
        data: {
          action: isAdding ? 'tfwc_apply_gift' : 'tfwc_remove_gift',
          nonce: tfwc_woo_params.nonce,
        },
        beforeSend: function () {
          isLoading = true;
        },
        success: function (response) {

        },
        error: function (xhr, status, error) {
          console.error("Error AJAX:", error);
        }
        ,
        complete: function () {
          isLoading = false;
        }
      });

      // Note
      $.ajax({
        url: tfwc_woo_params.ajax_url,
        type: "POST",
        data: {
          action: "save_order_note",
          order_comments: noteContent,
          nonce: tfwc_woo_params.nonce,
        },
        beforeSend: function () {
          isLoading = true;
        },
        success: function (response) {
        },
        complete: function () {
          isLoading = false;
        }
      });

    });
  };

  var save_coupon = function () {
    $(document).on('submit', '.coupon .tf-mini-cart-tool-content', function (e) {
      e.preventDefault();

      var coupon_code = $('input[name="tfwc_coupon_code"]').val();
      $('.notice-coupon').html("");
      if (coupon_code != '') {
        $.ajax({
          url: tfwc_woo_params.ajax_url,
          method: 'POST',
          data: {
            action: 'apply_coupon',
            coupon_code: coupon_code,
            nonce: tfwc_woo_params.nonce,
          },
          beforeSend: function () {
            $('.coupon .subscribe-button').addClass('loading');
          },
          success: function (response) {
            if (response.success) {
              $('.notice-coupon').html(response.data.message);
              if (!response.data.minicart_totals || response.data.minicart_totals.trim() !== "") {
                $('.tfwc-minicart-totals').html(response.data.minicart_totals);
              }
            } else {
              $('.notice-coupon').html(response.data.message);
            }
            $('.coupon .subscribe-button').removeClass('loading');
            $(".tf-mini-cart-tool-openable").removeClass("open");
          },
          error: function () {
            $('.notice-coupon').html('An error occurred. Please try again.');
            $('.coupon .subscribe-button').removeClass('loading');
          }
        });
      } else {
        $('.notice-coupon').html('Please enter a coupon code.');
      }
    });

  }

  var delete_coupon = function () {
    $(document).on('click', '.woocommerce-remove-coupon', function (e) {
      e.preventDefault();

      var coupon_code = $(this).data('coupon');

      $.ajax({
        url: tfwc_woo_params.ajax_url,
        method: 'POST',
        data: {
          action: 'tfwc_remove_coupon',
          coupon_code: coupon_code,
          nonce: tfwc_woo_params.nonce,
        },
        beforeSend: function () {
          $('.tfwc-minicart-totals').addClass('loading-content');
        },
        success: function (response) {
          if (response.success) {
            if (!response.data.minicart_totals || response.data.minicart_totals.trim() !== "") {
              $('.tfwc-minicart-totals').html(response.data.minicart_totals);
            }
            $('.tfwc-minicart-totals').removeClass('loading-content');
          }
        },
        error: function () {
          console.log('Error.');
        }
      });
    });
  }

  var save_shipping = function () {

    $(document).on('click', '.tf-mini-cart-wrap .shipping-calculator-button', function (e) {
      if ($('.tf-mini-cart-wrap .shipping-calculator-form').is('visible')) {
        $('.tf-mini-cart-wrap .shipping-calculator-form').hide().removeClass('open');
      } else {
        $('.tf-mini-cart-wrap .shipping-calculator-form').show().addClass('open');
      }
    });

    $(document).on('change', '#calc_shipping_state, #billing_state, #shipping_state', function (e) {
      $(document.body).trigger('country_to_state_changed');
    });

    $(document).on('click', '#shipping-form .subscribe-button, .shipping-est-btn', function (e) {
      e.preventDefault();
      var $button = $(this);
      var country = $('#calc_shipping_country').val();
      var state = $('#calc_shipping_state').val();
      var city = $('#calc_shipping_city').val();
      var postcode = $('#calc_shipping_postcode').val();
      $('.notice-shipping').html('');

      $.ajax({
        url: tfwc_woo_params.ajax_url,
        type: 'POST',
        data: {
          action: 'tfwc_save_shipping',
          country: country,
          state: state,
          city: city,
          postcode: postcode,
          nonce: tfwc_woo_params.nonce,
        },
        beforeSend: function () {
          $button.addClass('loading');
        },
        success: function (response) {
          if (response.success) {
            $button.removeClass('loading');
            $('.notice-shipping').html('Shipping information has been updated successfully.');
            $(document.body).trigger('wc_fragment_refresh');
          } else {
            $button.removeClass('loading');
            $('.notice-shipping').html('There was an error updating the shipping information.');

          }
        },
        error: function () {
          $('.notice-shipping').html('An error occurred while processing the shipping information.');
        }
      });
    });

  }

  var save_gift = function () {
    $(document).on('submit', '.add-gift .tf-mini-cart-tool-content', function (e) {
      e.preventDefault();

      let $form = $(this);
      let $button = $form.find('button[type="submit"]');
      let $notice = $('.notice-gift');
      let isAdding = $button.data('action') === 'add';
      $notice.text('').hide();

      $.ajax({
        type: 'POST',
        url: tfwc_woo_params.ajax_url,
        data: {
          action: 'tfwc_apply_gift',
          nonce: tfwc_woo_params.nonce,
        },
        beforeSend: function () {
          $button.addClass('loading');
        },
        success: function (response) {
          if (isAdding) {
            $button.removeClass('loading');
            $button.text('Remove').data('action', 'remove');
            $notice.text('Gift save successfully! Please view card or checkout to check').show();

          } else {
            $button.removeClass('loading');
            $button.text('Save').data('action', 'add');
            $notice.text('Gift removed successfully! Please view card or checkout to check').show();
          }

          $(document.body).trigger('wc_fragment_refresh');
        },
        error: function (xhr, status, error) {
          console.error("Error AJAX:", error);
          $notice.text('An error occurred. Please try again.').show();
        }
      });
    });
  };

  var tf_swiper_slider = function () {
    var swiperInstances = {}
    if ($(".tfwc-slider").length > 0) {
      $(".tfwc-slider").each(function (index) {
        const config = $(this).data("swiper");
        if (swiperInstances[index]) {
          swiperInstances[index].destroy(true, true);
        }
        swiperInstances[index] = new Swiper(this, config);

      });
    }
  }

  var sizeGuide = function () {
    $(document).on('click', '.modal-quick-view .open-size-guide-btn', function () {
      let id = $(this).data('product_id');
      if (!id) {
        return;
      }
      $.ajax({
        url: tfwc_woo_params?.ajax_url || '/wp-admin/admin-ajax.php',
        type: 'POST',
        data: {
          'security': tfwc_woo_params?.nonce,
          'product_id': id,
          'action': 'tf_get_size_guide'
        },
        beforeSend: function () { },
        success: function (response) {
          if (response?.success) {
            const temp = $(response?.data?.content);
            $('#sizeGuideQV').html(temp.html());
          }
        },
        complete: function () { }
      });
    });
  };

  var checkoutTerms = function () {
    $(document).on('click', '.checkout-btn', function (e) {
      if ($('#agree-term').length && !$('#agree-term').prop('checked')) {
        e.preventDefault();
        alert('Please agree to the Terms and Conditions before contiuing.');
        return false;
      }
    });
  };

  function fetchLiveSales() {
    if (tfwc_woo_params.live_notification == 1) {
      $.ajax({
        url: tfwc_woo_params.ajax_url,
        type: 'POST',
        data: {
          action: 'tfwc_live_notification',
          nonce: tfwc_woo_params.nonce,
        },
        success: function (response) {
          if (response.success) {
            let products = response.data;
            let currentIndex = 0;
            function appendProduct() {
              if (currentIndex < products.length) {
                let productHtml = products[currentIndex].product_html;
                $('#live-sales-container').html(productHtml);
                $('#live-sales-container .live-notification').addClass('tf-fade-in-left');
                $('#live-sales-container .live-notification').removeClass('tf-fade-out-left');

                setTimeout(function () {
                  $('#live-sales-container .live-notification').removeClass('tf-fade-in-left');
                  $('#live-sales-container .live-notification').addClass('tf-fade-out-left');

                  $(this).remove();

                }, tfwc_woo_params.live_timeout);
                currentIndex++;
              } else {
                currentIndex = 0;
              }
            }

            let appendInterval = setInterval(appendProduct, tfwc_woo_params.live_interval);
          } else {
            console.log('No data returned.');
          }
        },
        error: function (xhr, status, error) {
          console.log('AJAX Error: ' + error);
        }
      });

      $(document).on('mouseenter', '.live-notification', function () {
        if (!$(this).hasClass('active')) {
          $(this).addClass('active');
        }
      });

      $(document).on('mouseleave', '.live-notification', function () {
        if ($(this).hasClass('active')) {
          $(this).removeClass('active');
        }
      });

      $(document).on('click', '.icon-close-notification', function () {
        $('#live-sales-container').remove();
      });
    }

  }

  /* Auto Popup
  ------------------------------------------------------------------------------------- */
  var autoPopup = function () {
    $(".auto-popup").each(function (index) {
      let $popup = $(this);
      let timeout = parseInt($popup.data("timeout")) || 3000;

      let popupId = $popup.attr("id") || "popup_" + index;
      let pageKey = "showPopup_" + popupId + "_" + window.location.pathname;
      let showPopup = sessionStorage.getItem(pageKey);

      if (!JSON.parse(showPopup)) {
        setTimeout(function () {
          $(".auto-popup").modal("hide");
          $popup.modal("show");
        }, timeout);
      }

      $popup.find(".btn-hide-popup").on("click", function () {
        sessionStorage.setItem(pageKey, true);
      });
    });
  };

  var cookieSetting = function () {
    $(".cookie-banner .overplay").on("click", function () {
      $(".cookie-banner").hide();
    });

    function setCookie(name, value, days) {
      const date = new Date();
      date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
      const expires = "expires=" + date.toUTCString();
      document.cookie = `${name}=${value}; ${expires}; path=/`;
    }

    function getCookie(name) {
      const nameEQ = name + "=";
      const cookies = document.cookie.split(";");
      for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i].trim();
        if (cookie.indexOf(nameEQ) === 0) {
          return cookie.substring(nameEQ.length, cookie.length);
        }
      }
      return null;
    }

    function checkCookie() {
      const $cookieBanner = $("#cookie-banner");
      const accepted = getCookie("cookieAccepted");

      if (accepted) {
        $cookieBanner.hide();
      } else {
        $cookieBanner.show();
      }
    }

    $(document).ready(function () {
      $("#accept-cookie").on("click", function () {
        setCookie("cookieAccepted", "true", 30);
        $("#cookie-banner").hide();
      });

      checkCookie();
    });
  };

  var posNavSwiper = function () {
    $(".wrap-pos-nav").each(function () {
      var imageBlog = $(this).find(".blog-item-v2 .entry-image");
      if (imageBlog.length) {
        var contentHeight = $(this).find(".blog-item-v2 .entry-content").outerHeight();
        var newTop = `calc(50% - ${contentHeight / 2}px)`;
        $(this).find(".nav-swiper").css("top", newTop);
      }
      var imageProduct = $(this).find(".card-product .card-product-wrapper");
      if (imageProduct.length) {
        var contentHeight = $(this).find(".card-product .product-img").outerHeight();
        var newTop = `calc(${contentHeight / 2}px)`;
        $(this).find(".nav-swiper").css("top", newTop);
      }
    });
  }

  function scrollToTopWithOffset(elementId, offset) {
    const element = document.getElementById(elementId);

    if (element) {
      const rect = element.getBoundingClientRect();
      const scrollTop = window.scrollY + rect.top - offset;

      window.scrollTo({
        top: scrollTop,
        behavior: 'smooth'
      });
    }
  }

  function scrollToElementWithOffset($element, offset) {

    if (!$element?.length) {
      return;
    }

    const element = $element.get(0);

    if (element) {
      const rect = element.getBoundingClientRect();
      const scrollTop = window.scrollY + rect.top - offset;

      window.scrollTo({
        top: scrollTop,
        behavior: 'smooth'
      });
    }
  }

  var minicart = function () {
    if (typeof wc_cart_fragments_params !== 'undefined') {
      $(document.body).trigger('wc_fragment_refresh');
    }
  }

  var handleSidebarFilter = function () {
    $("#filterShop,.tf-btn-filter,.tf-sticky-filter-btn").on("click", function (e) {
      if ($(window).width() <= 1200) {
        $(".sidebar-filter,.overlay-filter").addClass("show");
      }
    });
    $(".close-filter,.overlay-filter").on("click", function () {
      $(".sidebar-filter,.overlay-filter").removeClass("show");
    });

    $(".tf-sticky-filter-btn").on("click", function (e) {
      e.preventDefault();
      if ($(window).width() <= 1200) {
        $(".sidebar-filter,.overlay-filter").addClass("show");
      }
    });
  };

  var commentform_product = function () {
    $('#commentform').on('submit', function (e) {
      e.preventDefault();
      HTMLFormElement.prototype.submit.call(this);
    });
  }

  var vemusSaleMarquee = function () {
    if ($(".vemus-marquee-sale").length > 0) {
      $(".vemus-marquee-sale").each(function () {
        var $this = $(this);

        var style = $this.data("style") || "left";
        var clone = $this.data("clone") || 2;
        var speed = $this.data("speed") || 50;

        if ($this.hasClass("marquee-initialized")) {
          return;
        }

        $this.infiniteslide({
          speed: speed,
          direction: style,
          clone: clone,
        });

        $this.addClass("marquee-initialized");

      });
    }
  };

  var clearMiniCart = function () {
    $(document).on('click', '.tf-clear-cart-btn', function (e) {
      e.preventDefault();

      $.ajax({
        url: tfwc_woo_params.ajax_url || '/wp-admin/admin-ajax.php',
        type: 'POST',
        data: {
          action: 'tfwc_clear_cart'
        },
        success: function (response) {
          $(document.body).trigger('wc_fragment_refresh');
        },
        error: function (e) {
          console.log(e?.getMessage());
        }
      });
    });
  }

  var shippingSlider = function () {
    $(document.body).on("wc_fragments_refreshed", function () {
      var progressValue = $(".tf-progress-bar .value").data("progress");
      setTimeout(function () {
        $(".tf-progress-bar .value").css("width", progressValue + "%");
      }, 100)
    });

    var progressValue = $(".tf-progress-bar .value").data("progress");
    setTimeout(function () {
      $(".tf-progress-bar .value").css("width", progressValue + "%");
    }, 100)
  }

  var stickyFilterButton = function () {
    let isShown = false;
    function checkFilterButton() {

      if ($(".tf-sticky-filter-btn")?.length == 0 || $(".tf-btn-filter")?.length == 0 || $(".wrapper-shop")?.length == 0) {
        return;
      }

      var scrollTop = $(window).scrollTop();
      var filterTop = $('.tf-btn-filter').offset()?.top;
      var filterHeight = $('.tf-btn-filter').outerHeight();
      var headerHeight = $('.header-sticky:visible').outerHeight() || 0;

      var toolbarHeight = $('.tf-toolbar-bottom:visible').outerHeight() || 0;

      var wrapper = $('.wrapper-shop');
      var wrapperTop = wrapper.offset()?.top;
      var wrapperHeight = wrapper.outerHeight();
      var wrapperBottom = wrapperTop + wrapperHeight;

      if (scrollTop + headerHeight > filterTop + filterHeight &&
        scrollTop < wrapperBottom - $(window).height() + toolbarHeight) {
        if (!isShown) {
          $('.tf-sticky-filter-btn').show();
          isShown = true;
        }
      } else {
        if (isShown) {
          $('.tf-sticky-filter-btn').hide();
          isShown = false;
        }
      }
    }

    $(window).on('scroll', checkFilterButton); checkFilterButton();
  }

  // Dom Ready
  $(function () {
    swatchColor();
    wishlist();
    singleWishlist();
    compare();
    countDown();
    // add_to_cart();
    quantity_input();
    quickview_product();
    quickShop();
    sizeGuide();
    swLayoutShop();
    changeValueDropdown();
    toogle_categry();
    rangeTwoPrice();
    filter_product();
    stickyFilterButton();
    ajax_search();
    remove_item();
    handleProgress();
    // update_cart();
    clickMinicartPopup();
    save_order_note();
    save_coupon();
    save_shipping();
    save_gift();
    fetchLiveSales();
    checkoutTerms();
    autoPopup();
    cookieSetting();
    posNavSwiper();
    delete_coupon();
    remove_wishlist();
    minicart();
    shopAddedToCart();
    updateCart();
    clearMiniCart();
    shippingSlider();
    handleSidebarFilter();
    commentform_product();
    vemusSaleMarquee();
    updateTotalCount();
  })
})(jQuery);

(function ($) {
    "use strict";

    var init = function () {
        variationSwatches();
    };

    var variationSwatches = function () {

        if ($(".wcboost-variation-swatches") == 0) {
            return;
        }

        let variationForm = $(".variations_form "),
            mainProduct = $(variationForm).closest('.tf-main-product'),
            productPrice = $(".product-info-price .price-wrap", mainProduct),
            // badgeSale = $(".badge-sale", productPrice),
            variation_id = $(".variation_id", variationForm),
            origin_price_html = productPrice.html();

        var onChange = function (item) {
            return;
            let select = $("select", item.closest(".wcboost-variation-swatches"));
            select.change();
        }

        var updatePrice = function () {
            if (variation_id.val()) {
                productPrice.html($(".woocommerce-variation-price .price").html());
            } else {
                productPrice.html(origin_price_html);
            }
        }

        var updateBadgeSale = function (variation) {
            let price = variation.display_price,
                regularPrice = variation.display_regular_price,
                discount = Math.round(((regularPrice - price) / regularPrice) * 100);
            if (discount > 0) {
                if ($(".badges-on-sale", productPrice).length == 0) {
                    $(`
                        <p class="badges-on-sale">
                            <i class="icon-tag"></i>
                            <span class="number-sale">
                                ${discount}% Off
                            </span>
                        </p>`
                    )
                        .appendTo(productPrice);
                } else {
                    $(".number-sale", productPrice).text(`${discount}% Off`);
                }
            }
        }

        var resetOptions = function () {
            $(".wcboost-variation-swatches__item", variationForm).removeClass("selected");
            $(".tf-variation-dropdown-wrapper .select-item", variationForm).removeClass("active");
            $(".wcboost-variation-swatches__item", variationForm).removeClass("disabled");
            $(".tf-variation-dropdown-wrapper .select-item", variationForm).removeClass("disabled");

        }

        var updateOptions = function () {
            return;
            $(".wcboost-variation-swatches__item", variationForm).each(function () {
                let $self = $(this);
                let select = $("select", $self.closest(".wcboost-variation-swatches"));

                var optionValues = select.find('option').map(function () {
                    return $(this).val();
                }).get();

                if ($.inArray($self.data('value'), optionValues) === -1) {
                    $self.addClass('disabled');
                    $self.removeClass('selected');
                } else {
                    $self.removeClass('disabled');
                }
            });

            $(".tf-variation-dropdown-wrapper .select-item", variationForm).each(function () {
                let $self = $(this);
                let select = $("select", $self.closest(".tf-variation-dropdown-wrapper"));

                var optionValues = select.find('option').map(function () {
                    return $(this).val();
                }).get();

                if ($.inArray($self.data('value'), optionValues) === -1) {
                    $self.addClass('disabled');
                    $self.removeClass('active');
                } else {
                    $self.removeClass('disabled');
                }
            });

            $(".tf-variation-dropdown-wrapper select", variationForm).each(function () {
                let $self = $(this),
                    $dropdownWrapper = $self.closest('.tf-variation-dropdown-wrapper');
                $('.current-value', $dropdownWrapper).text($self.find('option:selected').text());
            });
        }

        var appendSelectedLabel = function (t) {
            return;
            var a = $(t).closest(".value").siblings(".label").find("label")
                , e = a.find(".wcboost-variation-swatches__selected-label");
            if (!e.length) {
                e = $('<span class="wcboost-variation-swatches__selected-label" />');
                a.append(e);
            }
            if (t.value) {
                e.text(t.options[t.selectedIndex].text).show();
            } else {
                e.text("").hide();
            }
        }

        variationForm.find(".value select").each(function () {
            appendSelectedLabel(this);
        });

        variationForm.on("click.wcboost-variation-swatches", ".wcboost-variation-swatches__item", function () {
            let $self = $(this);
            setTimeout(() => {
                onChange($self);
            }, 1);
        });

        variationForm.on("woocommerce_variation_has_changed", function () {
        });

        variationForm.on("show_variation", function (e, variation) {
            updateOptions();
            updatePrice();
            updateBadgeSale(variation);
        }).on('hide_variation', function () {
            updateOptions();
            updatePrice();
            variationForm.find(".value select").each(function () {
                appendSelectedLabel(this);
            });
            $(".tf-variation-dropdown-wrapper .select-item", variationForm).removeClass("active");
            // resetOptions();
        });

        variationForm.on("reset_focus", function () {
            resetOptions();
            variationForm.find(".value select").each(function () {
                appendSelectedLabel(this);
            });
        });

        $(".tf-variation-dropdown-wrapper .select-item", variationForm).on('click', function (e) {
            e.preventDefault();
            if ($(this).hasClass('disabled')) {
                return false;
            }
            $('.select-item', $(this).closest('.tf-variant-dropdown')).removeClass('active');
            $('.current-value', $(this).closest('.tf-variant-dropdown')).text($(this).text());
            $('select', $(this).closest('.tf-variation-items')).val($(this).data('value')).change();
            $(this).addClass('active');
        });

    }

    init();
})(jQuery);
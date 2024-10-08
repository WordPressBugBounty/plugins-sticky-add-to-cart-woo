"use strict";

(function ($) {
  'use strict';

  /**
   * All of the code for your public-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */
})(jQuery);
document.addEventListener('DOMContentLoaded', function (e) {
  var isSimpleProduct = document.querySelector('#wsatc-stick-cart-wrapper').classList.contains('simple');
  var isVariableProduct = document.querySelector('#wsatc-stick-cart-wrapper').classList.contains('variable');
  var isExternalProduct = document.querySelector('#wsatc-stick-cart-wrapper').classList.contains('external');
  var applyFilters = wp.hooks.applyFilters;
  var doAction = wp.hooks.doAction;
  document.addEventListener('scroll', function (event) {
    var _documentHeight = document.body.scrollHeight;
    var scrollPosY = window.pageYOffset || document.body.scrollTop;
    var scrollHeight = _documentHeight / 100 * 10; // Getting 10% of the total page height
    var footerHeight = document.documentElement.clientHeight;
    var scrollPixelsHide = WSATC.scrollPixelsHide;
    //first before parent or for both position on scroll
    if (scrollPosY > (scrollPixelsHide || scrollHeight) || scrollPosY <= _documentHeight - window.innerHeight && 'bottom' == WSATC.barPosition ||
    //no scroll bottom
    'top' == WSATC.barPosition) {
      document.getElementById('wsatc-stick-cart-wrapper').classList.add('active');
    }

    // If position top then before 10px stroll op hide sticky bar.
    if (scrollPosY < (scrollPixelsHide || 10) && 'top' == WSATC.barPosition) {
      document.getElementById('wsatc-stick-cart-wrapper').classList.remove('active');
    }
    if ((scrollPosY >= _documentHeight - window.innerHeight || scrollPosY <= (scrollPixelsHide || 0) && scrollPixelsHide) && 'bottom' == WSATC.barPosition) {
      document.getElementById('wsatc-stick-cart-wrapper').classList.remove('active');
    }
  });
  var stickyBar = document.querySelector('#wsatc-stick-cart-wrapper .wsatc-add-to-cart');
  if (stickyBar) {
    stickyBar.addEventListener('click', function (e) {
      doAction('wsatc_button_before_click');
      AnalyticsPush('click');
      if (isExternalProduct) {
        e.preventDefault();
        document.querySelector('.single_add_to_cart_button').click();
      }
      if (isVariableProduct && !WSATC.isPro) {
        e.preventDefault();
        window.scrollTo({
          top: 100,
          left: 0,
          behavior: 'smooth'
        });
      }
      if (WSATC.isPro) {
        var is_ajax_cart = applyFilters('wsatc_ajax_cart', false);
        if (is_ajax_cart) {
          e.preventDefault();
          doAction('wsatc_button_click');
        }
      }
    });
    document.querySelector(".wsatc-qty-minus").addEventListener('click', function (e) {
      changeQuantity('decrease');
    });
    document.querySelector(".wsatc-qty-plus").addEventListener('click', function (e) {
      changeQuantity('increase');
    });
  }
  AnalyticsPush(); // Count immersion.
});

function changeQuantity() {
  var type = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'increase';
  var qty = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;
  var productID = document.querySelector(".wsatc-container").dataset.productId;
  var cartBtn = document.querySelector(".wsatc-add-to-cart");
  var currentQty = parseInt(document.querySelector(".wsatc-qty-field").value);
  if ('increase' === type) {
    document.querySelector(".wsatc-qty-field").value = currentQty + 1;
    wsatcChangeURL(productID, currentQty + 1);
  }
  if ('decrease' === type && currentQty > 1) {
    document.querySelector(".wsatc-qty-field").value = currentQty - 1;
    wsatcChangeURL(productID, currentQty - 1);
  }
}
function wsatcChangeURL() {
  var productID = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
  var qty = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
  if (!qty) {
    qty = parseInt(document.querySelector(".wsatc-qty-field").value);
  }
  if (!productID) {
    productID = document.querySelector(".wsatc-container").dataset.productId;
  }
  var url = wp.hooks.applyFilters('wsatc_url', "?add-to-cart=" + productID + "&quantity=" + qty);
  document.querySelector(".wsatc-add-to-cart").href = url;
}
function AnalyticsPush() {

  if( '1' !== WSATC.isAdmin ) {
    var eventType = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'view';
    var productID = document.querySelector(".wsatc-container").dataset.productId;
    var formData = new FormData();
    formData.append('action', 'wsatc_pro_analytics');
    formData.append('security', WSATC.nonce);
    formData.append('event_type', eventType);
    formData.append('post_id', productID);
    fetch(WSATC.ajaxUrl, {
      method: 'POST',
      body: formData
    }).then(function (res) {
      return res.json();
    }) // parse response as JSON (can be res.text() for plain response)
    .then(function (response) {
      console.log("WooCommerce Sticky Add to Cart ".concat(eventType, " added"));
    }).catch(function (err) {
      console.log("sorry, product not added to cart");
    });
  }
}
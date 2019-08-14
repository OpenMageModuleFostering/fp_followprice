var $j=jQuery.noConflict();
var isValidated = localStorage.getItem('isValidated') || "0";

$j( document ).ready(function() {

  if (storeKey && (isValidated === "0")) {

    $j.ajax({
      method: "GET",
      url: 'https://followprice.co/api/v1/stores/' + encodeURIComponent(siteUrl) + '/validate/' + encodeURIComponent(storeKey),
      success: function (rsp) {

        if (rsp && rsp.success && !rsp.data) {
          $j( '.fp-title-div' ).after( '<div class="alert-box warning"><span>warning: </span>We couldn\'t validate your store key. Please make sure you entered it correctly in your <a href="' + configurationUrl + '">configuration page</a>.</div>' );
        } else {
          localStorage.setItem('isValidated', "1");
        }
      }
    });
  }
});



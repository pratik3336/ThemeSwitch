(function($) {
  Drupal.behaviors.civicAccessibilityToolbar = {
    attach(context, settings) {
      // cookie functions http://www.quirksmode.org/js/cookies.html
      function createCookie(name, value, days) {
        let expires = "";
        if (days) {
          const date = new Date();
          date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
          expires = `; expires=${date.toGMTString()}`;
        }
        document.cookie = `${name}=${value}${expires}; SameSite=Strict; path=/`;
      }
      function readCookie(name) {
        const nameEQ = `${name}=`;
        const ca = document.cookie.split(";");
        for (let i = 0; i < ca.length; i++) {
          let c = ca[i];
          while (c.charAt(0) === " ") c = c.substring(1, c.length);
          if (c.indexOf(nameEQ) === 0)
            return c.substring(nameEQ.length, c.length);
        }
        return null;
      }
      function eraseCookie(name) {
        createCookie(name, "", -1);
      }

      $(".accessibility--control").click(function() {
        const accessibilityFeature = $(this).attr("data-accessibility-feature");
        const accessibilityUnit = $(this).attr("data-accessibility-unit");
        if (accessibilityFeature === "fontSize") {
          /* $('html').css('font-size', accessibilityUnit + 'em'); */
          $("html").removeClass("font__1 font__125 font__15");
          $("html").addClass(`font__${accessibilityUnit.replace(".", "")}`);
        } else if (accessibilityFeature === "colorContrast") {
          $("body").removeClass("theme__soft theme__blue theme__hivis");
          $("body").addClass(`theme__${accessibilityUnit}`);
        }
        eraseCookie(accessibilityFeature);
        createCookie(accessibilityFeature, accessibilityUnit, 365);
      });

      const textCookie = readCookie("fontSize");
      if (textCookie) {
        /* $('html').css('font-size', textCookie + 'em'); */
        $("html").addClass(`font__${textCookie.replace(".", "")}`);
      }
      const contrastCookie = readCookie("colorContrast");
      if (contrastCookie) {
        $("body").addClass(`theme__${contrastCookie}`);
      }
    }
  };
})(jQuery);

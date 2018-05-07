<?php

// speakers Gallery

if (!function_exists('evnt_newsletter_form')) {

    function evnt_newsletter_form($atts, $content = null) {
        extract(shortcode_atts(array(
            'form' => ''
                        ), $atts));
        $siteaddress = get_site_url();

        if ($form and $form != "standard") {
//            echo "fooorm " . $form;

            return do_shortcode("[newsletter_form form='$form']");
        } elseif ($form == "standard") {
            return do_shortcode("[newsletter]");
        } else {
            return '<script type="text/javascript">
                    //<![CDATA[
                    if (typeof newsletter_check !== "function") {
                    window.newsletter_check = function (f) {
                        var re = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-]{1,})+\.)+([a-zA-Z0-9]{2,})+$/;
                        if (!re.test(f.elements["ne"].value)) {
                            alert("' . __("The email is not correct", "evnt-vc-extensions") . '");
                            return false;
                        }
                        for (var i=1; i<20; i++) {
                        if (f.elements["np" + i] && f.elements["np" + i].required && f.elements["np" + i].value == "") {
                            alert("");
                            return false;
                        }
                        }
                        if (f.elements["ny"] && !f.elements["ny"].checked) {
                            alert("' . __("You must accept the privacy statement", "evnt-vc-extensions") . '");
                            return false;
                        }
                        return true;
                    }
                    }
                    //]]>
                    </script>
                    <div class="newsletter newsletter-subscription">
                        <form method="post" class="form-inline" action="' . $siteaddress . '/?na=s" onsubmit="return newsletter_check(this)">
                            <div class="form-group">
                                    <label class="sr-only" for="newsletter-input">' . __("Email", "evnt-vc-extensions") . '</label>
                                    <input type="email" name="ne" class="form-control" id="newsletter-input" placeholder="jane.doe@example.com">
                            </div>
                            <button type="submit" class="btn btn-secondary">' . __("Subscribe", "evnt-vc-extensions") . '</button>
                        </form>
                    </div>';
        }
    }

}

add_shortcode('evnt_newsletter_form', 'evnt_newsletter_form');

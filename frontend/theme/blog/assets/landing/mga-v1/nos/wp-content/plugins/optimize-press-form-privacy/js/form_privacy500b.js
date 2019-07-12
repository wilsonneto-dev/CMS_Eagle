opjq(document).ready(function($) {

    /**
     * We submit optin form only after all deferreds in
     * OptimizePress._validationDeferreds
     * are resolved.
     *
     * To ensure we don't break other validation
     * checks, we're adding following check
     * into the deferreds list and
     * resolving it once it has
     * been validated.
     *
     * Check lib/js/validation.js
     * in OP Theme / Plugin for
     * more details on this.
     */
    OptimizePress._validationDeferreds = OptimizePress._validationDeferreds || [];

    // Check privacy validation
    function privacyValidation(deferred) {
        var $forms = $('form.op-optin-validation');

        $forms.submit(function(e) {
            var $form = $(this),
                returnValue = true;

            // Privacy
            if ($form.find('.op-form-privacy-privacy-checkbox').length && $form.find('.op-form-privacy-privacy-checkbox').is(':checked') === false) {
                alert(OPPrivacy.labels.privacy);
                returnValue = false;
            }

            // Newsletter
            if ($form.find('.op-form-privacy-newsletter-checkbox').length && $form.find('.op-form-privacy-newsletter-checkbox').is(':checked') === false) {
                alert(OPPrivacy.labels.newsletter);
                returnValue = false;
            }

            deferred.resolve(returnValue);
            return false;
        });
    }

    // Add privacy validation into OP list of
    // validation checks for optin forms
    OptimizePress._validationDeferreds.push(privacyValidation);

});

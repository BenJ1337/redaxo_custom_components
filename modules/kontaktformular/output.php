<?php

$rex_values_settings = json_decode(rex_article_slice::getArticleSliceById($rex_slice_id)->getValue(1), true);

$outputBuilder = new CM_OutputBuilder(
    $rex_values_settings[BootstrapColWidth::lg],
    $rex_values_settings[BootstrapColWidth::md],
    $rex_values_settings[BootstrapColWidth::sm],
    $rex_values_settings[BootstrapColWidth::xs]
);

$rex_values_content = json_decode(rex_article_slice::getArticleSliceById($rex_slice_id)->getValue(2), true);

$htmlOutput = '';


$htmlOutput .= '<div id="kontakt-formular">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-block">
                    <h1>Kontakt</h1>
                    <p>Sie haben Fragen oder brauchen Hilfe! Bitte kontaktieren Sie Uns!</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="kontakt-info">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Anschrift</h4>
                            <ul style="list-style: none; padding: 0;">
                                <li>' . (isset($rex_values_content['anschrift_name']) ? $rex_values_content['anschrift_name'] : ' ') . '</li>
                                <li>' . (isset($rex_values_content['anschrift_str_hnr']) ? $rex_values_content['anschrift_str_hnr'] : ' ') . '</li>
                                <li>' . (isset($rex_values_content['anschrift_plz_ort']) ? $rex_values_content['anschrift_plz_ort'] : ' ') . '</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Kontakt</h4>
                            <ul style="list-style: none; padding: 0;">
                                <li>Tel.: ' . (isset($rex_values_content['kontaktTelInput']) ? $rex_values_content['kontaktTelInput'] : ' ') . '</li>
                                <li>Fax.: ' . (isset($rex_values_content['kontaktFaxInput']) ? $rex_values_content['kontaktFaxInput'] : ' ') . '</li>
                                <li>E-Mail: ' . (isset($rex_values_content['target_email_address']) ? $rex_values_content['target_email_address'] : ' ') . '</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Bürozeiten</h4>
                            <ul style="list-style: none; padding: 0;">
                                <li>Mo-Do: ' . (isset($rex_values_content['bueroZeitMoDo']) ? $rex_values_content['bueroZeitMoDo'] : '') . '</li>
                                <li>Freitag: ' . (isset($rex_values_content['bueroZeitFr']) ? $rex_values_content['bueroZeitFr'] : '') . '</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <form id="contact-form" method="post">
                    <div class="row">
						<div class="col-md-12" id="contact-form-result">
						</div>
                        <div class="col-md-6">
                            <input type="text" id="personname" name="personname" 
                                required oninvalid="this.setCustomValidity(\'Bitte geben Sie Ihren Namen an.\')" 
                                oninput="setCustomValidity(\'\')"
                                placeholder="Name *">
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="firma" name="firma" 
                            required oninvalid="this.setCustomValidity(\'Bitte geben Sie den Namen Ihrer Firma an.\')"
                            oninput="setCustomValidity(\'\')"
                            placeholder="Firma *">
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="telefon" name="telefon" 
                            required oninvalid="this.setCustomValidity(\'Bitte geben Sie Ihre Telefonnummer an.\')"
                            oninput="setCustomValidity(\'\')" 
                            placeholder="Telefon *">
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="email" name="email" 
                            required oninvalid="this.setCustomValidity(\'Bitte geben Sie Ihre E-Mail-Adresse an.\')"
                            oninput="setCustomValidity(\'\')" 
                            placeholder="E-Mail *">
                        </div>
                        <div class="col-md-6 fax">
                            <input type="text" name="fax" placeholder="Fax *">
                        </div>
                        <div class="col-md-6 spampro">
                            <input type="text" name="spampro" placeholder="Spam protect *">
							<script>var timestamp = Math.floor(Date.now() / 1000); $(\'input[name="spampro"]\').val(timestamp);</script>
                        </div>
                        <div class="col-md-6 spampro">
                            <input type="text" name="rex_slice_id" value="' . $rex_slice_id . '">
                        </div>
                        <div class="col-md-12">
                            <textarea id="nachricht" name="nachricht" placeholder="Nachricht *" 
                            required  oninvalid="this.setCustomValidity(\'Bitte geben Sie Ihre Nachricht ein.\')"
                            oninput="setCustomValidity(\'\')" ></textarea>
                        </div>
                        <div class="col-md-12">
                            <label>
                                <input type="checkbox" id="privacy" name="privacy" 
                                required oninvalid="this.setCustomValidity(\'Bitte bestätigen Sie die Datenschutzbestimmungen.\')"
                                oninput="setCustomValidity(\'\')">
                                Hiermit erkläre ich mit den <a target="_blank" href="' . rex_getUrl(7) . '">Datenschutzbestimmungen</a> einverstanden. *
                            </label>
                        </div>
                        <div class="col-md-12">
                            <button type="button" onClick="sendEmail()" name="footer-kontaktformular" class="btn">Nachricht senden</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<div>
<script>
	function sendEmail() {
        const formdata =  $("#contact-form").serialize();
        // console.log(formdata);
        var form = document.getElementById("contact-form"); 
        if(form.reportValidity()) {
            $.ajax({
                "url": "/index.php?rex-api-call=email_contact",
                method: "post",
                data: formdata,
                statusCode: {
                    200: function(responseObj, textStatus, jqYHR) {
                        //console.log(responseObj);
                        $("#contact-form-result").empty();
                        $("#contact-form-result").append("<p class=\'success\'>" + responseObj.resultmessage + "</p>");
                        var timestamp = Math.floor(Date.now() / 1000);
                        $(\'input[name="spampro"]\').val(timestamp);
                    },
                    400: function(responseObj, textStatus, jqYHR) {
                        var result;
                        //console.log(responseObj.responseJSON);
                        $("#contact-form-result").empty();
                        $("#contact-form-result").append("<p class=\'error\'>" + responseObj.responseJSON.resultmessage + "</p>");
                    }
                }
            });
        }
	}
</script>';


$outputBuilder->withFrontendOutput($htmlOutput);

echo $outputBuilder->build();

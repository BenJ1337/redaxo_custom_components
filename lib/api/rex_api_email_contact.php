<?php

class rex_api_email_contact extends rex_api_function
{
    protected $published = true;
    private $debug = false;
    private $res = [];

    function execute()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (
                isset($_POST["personname"]) && $_POST["personname"] != ""
                && isset($_POST["firma"]) && $_POST["firma"] != ""
                && isset($_POST["telefon"]) && $_POST["telefon"] != ""
                && isset($_POST["email"]) && $_POST["email"] != ""
                && isset($_POST["nachricht"]) && $_POST["nachricht"] != ""
                && isset($_POST["privacy"])

                && isset($_POST["rex_slice_id"])
                && is_numeric($_POST["rex_slice_id"])

                && isset($_POST["fax"]) && $_POST["fax"] == ""
                && isset($_POST["spampro"]) && $_POST["spampro"] != "" && is_numeric($_POST["spampro"])
            ) {
                $waittime = 15;

                if ($_POST["spampro"] + $waittime < time()) {
                    $rex_slice_id = $_POST["rex_slice_id"];
                    $contactFormSlice = rex_article_slice::getArticleSliceById($rex_slice_id);
                    $rexValue2 = $contactFormSlice->getValue(2);
                    $rexValue2JSON = json_decode($rexValue2, true);

                    $targetEmail = $rexValue2JSON["target_email_address"];

                    if ($this->debug) {
                        $this->res["resultmessage"] = "Anfrage erfolgreich bearbeitet";
                        $this->res["targetEMail"] = $targetEmail;
                        $this->res["debug"] = $this->debug;
                    } else {
                        $empfaenger = $targetEmail;
                        $betreff = "Kontaktanfrage: solaranlagenversicherung.de";
                        $text = "";
                        $text .= "Angegebene Informationen:\n\n";
                        $text .= "Name:" . $_POST["personname"] . "\n";
                        $text .= "Firma:" . $_POST["firma"] . "\n";
                        $text .= "Telefon:" . $_POST["telefon"] . "\n";
                        $text .= "E-Mail:" . $_POST["email"] . "\n";
                        $text .= "Nachricht:" . $_POST["nachricht"] . "\n";

                        $result = true; // @mail($empfaenger, $betreff, $text); 
                        if ($result) {
                            $this->res["resultmessage"] = "Die E-Mail wurde erfolgreich versendet. <br>Vielen Dank für Ihr Vertrauen.";
                        } else {
                            $this->res["resultmessage"] = "Es gab einen technischen Fehler beim Versenden der E-Mail. Bitte versuchen Sie es erneut. Sollte das Problem wiederholt auftreten, so "
                                . "informieren Sie ggf. bitte den Seitenbetreiber über die anderen Kontaktdaten auf der Seite.";
                            header("HTTP/1.0 400 Internal Server Error");
                        }
                    }
                } else {
                    $this->res["resultmessage"] = "Spamschutz, bitte versuchen Sie es in ein paar Sekunden (" . ($waittime - (time() - $_POST["spampro"])) . ") erneut.";
                    header("HTTP/1.0 400 Internal Server Error");
                }
            } else {
                $this->res["resultmessage"] = "Das Formular muss vollständig ausgefüllt werden.";
                header("HTTP/1.0 400 Internal Server Error");
            }
            header("Content-Type: application/json");
            echo json_encode($this->res);
        } else {
            header("HTTP/1.0 403 Forbidden");
            echo "Forbidden";
        }
        exit;
    }
}

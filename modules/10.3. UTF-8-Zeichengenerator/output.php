<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="zeichenEingabe">
                <label>Dezimal Code:
                    <input type="number" value="10052" oninput="showZeichen(this)">
                </label>
            </div>
            <div class="zeichenAusgabe">
                <span id="resultZeichen"></span>
            </div>
            <div class="queueEingabe">
                <button onclick="goBack()"><span style="margin-left: -2px;">&#10852;</span></button>
                <button onclick="goForward()"><span style="margin-left: 1px;">&#10853;</span></button>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid utf-8-wrapper">
    <div class="row">
    </div>
</div>
<script>
    var zeichen;
    var zeichenQueue = [];
    var index = 0;
    var i = 1;
    var limit = 220;
    var contentCache = "";
    addZeichen();
    limit += 600;
    $(".utf-8-wrapper > .row").append(contentCache);
    addZeichen();
    $(document).ready(function() {
        $(window).scroll(function() {
            var scrollPosition = $(window).scrollTop();
            var contentHeight = $(".utf-8-wrapper").height();
            if (
                (scrollPosition / contentHeight) > 0.5 && contentHeight < 8000 ||
                (scrollPosition / contentHeight) > 0.6 && contentHeight < 12000 ||
                (scrollPosition / contentHeight) > 0.7 && contentHeight < 24000 ||
                (scrollPosition / contentHeight) > 0.9 && contentHeight > 24000
            ) {
                $(".utf-8-wrapper > .row").append(contentCache);
                addZeichen();
            }
            //console.log(scrollPosition/contentHeight);
        });
    });

    function addZeichen() {
        var content = "";
        for (; i < limit; i++) {
            var unicode = (32 + i).toString(16);;
            while (unicode.length < 4) {
                unicode = "0" + unicode;
            }
            content += '<div class="col-lg-1 col-md-3 col-sm-3 col-6"><a target="_blank" href="https://unicode-table.com/de/' + unicode + '"><div class="utf-8-item">' +
                "<p style=\"font-size: 60px;text-align: center;display: block; line-height: 53px;\">&#" + (32 + i) + ";</p>" +
                "<p style=\"font-size: 20px; text-align: center; display:block; margin-bottom: 0; background: #222; color: #f4f4f4;\">&#38;&#35;" + (32 + i) + "</p>" +
                '<p style="font-size: 20px; text-align: center; display:block; margin-bottom: 0; background: #222; color: #f4f4f4;" title="Unicode">' + unicode + "</p>" +
                "</div></a></div>";
        }
        limit += 600;
        contentCache = content;
    }

    function goBack() {
        if (index > 0) {
            var code = zeichenQueue[--index];
            document.getElementById("resultZeichen").innerHTML = "&#" + code;
            $(".zeichenEingabe input").val(code);
        }
    }

    function goForward() {
        if (index < zeichenQueue.length - 1) {
            var code = zeichenQueue[++index];
            document.getElementById("resultZeichen").innerHTML = "&#" + code;
            $(".zeichenEingabe input").val(code);
        }
    }

    function showZeichen(that) {
        code = $(that).val();
        if (!isNaN(parseInt(code))) {
            $(that).removeClass("wrong");
            document.getElementById("resultZeichen").innerHTML = "&#" + parseInt(code);
            zeichenQueue.push(code);
            index = zeichenQueue.length - 1;
        } else {
            $(that).addClass("wrong");
        }
    }

    setInterval(function() {
        if (!($(".zeichenEingabe input").is(":focus") || $(".queueEingabe button").is(":focus"))) {
            $(".zeichenEingabe input").removeClass("wrong");
            var code = (32 + Math.floor((Math.random() * 20000) + 1));
            document.getElementById("resultZeichen").innerHTML = "&#" + code;
            $(".zeichenEingabe input").val(code);
            zeichenQueue.push(code);
            index = zeichenQueue.length - 1;
        }
    }, 500);
</script>
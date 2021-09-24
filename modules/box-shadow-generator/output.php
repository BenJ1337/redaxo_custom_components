<div style="height: auto; width: 100%; padding:  50px 0; margin: 20px auto;">
    <div class="box">
    </div>
    <div class="slidecontainer">
        <label>
            Styles:
        </label>
        <textarea id="output"></textarea>
        <label> X-Achse:
            <input type="range" min="1" max="100" class="slider" id="x">
        </label>
        <label> Y-Achse:
            <input type="range" min="1" max="100" class="slider" id="y">
        </label>
        <label> Blur:
            <input type="range" min="1" max="100" class="slider" id="blur">
        </label>
        <label> Border-radius:
            <input type="range" min="1" max="50" class="slider" id="borderRadius">
        </label>
        <label> Breite:
            <input type="range" min="1" max="300" class="slider" id="width">
        </label>
        <label> Höhe:
            <input type="range" min="1" max="300" class="slider" id="height">
        </label>
    </div>
</div>

<style>
    .box {
        width: 100px;
        height: 100px;
        margin: auto;
        background: #222;
        border: 1px dashed #FFF;
    }

    .slidecontainer {
        max-width: 350px;
        margin: 75px auto;
        padding: 12px;
        background: #f7f7f7;
        border-radius: 6px;
    }

    .slidecontainer label,
    .slidecontainer textarea {
        width: 100%;
    }

    .slidecontainer textarea {
        height: 107px;
    }

    .slider {
        -webkit-appearance: none;
        appearance: none;
        width: 100%;
        height: 15px;
        background: #dbdbdb;
        outline: none;
        opacity: 0.7;
        -webkit-transition: .2s;
        transition: opacity .2s;
    }

    .slider:hover {
        opacity: 1;
    }

    .slider::-webkit-slider-thumb,
    .slider::-moz-range-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 15px;
        height: 15px;
        background: #222;
        border: none;
        cursor: pointer;
    }
</style>
<script>
    var x = 10;
    var y = 10;
    var width = 100;
    var height = 100;
    var blur = 10;
    var borderRadius = 10;
    $('#x').val(x);
    $('#y').val(y);
    $('#blur').val(blur);
    $('#borderRadius').val(borderRadius);
    $('#width').val(width);
    $('#height').val(height);

    setOutput();

    $(".box").css("box-shadow", x + "px " + y + "px " + blur + "px #111");
    $(".box").css("border-radius", borderRadius + "px");
    $(".box").css("width", width + "px");
    $(".box").css("height", height + "px");

    $('#x').on('input', function() {
        x = $(this).val();
        $(".box").css("box-shadow", x + "px " + y + "px " + blur + "px #111");
        setOutput();
    });
    $('#y').on('input', function() {
        y = $(this).val();
        $(".box").css("box-shadow", x + "px " + y + "px " + blur + "px #111");
        setOutput();
    });
    $('#blur').on('input', function() {
        blur = $(this).val();
        $(".box").css("box-shadow", x + "px " + y + "px " + blur + "px #111");
        setOutput();
    });
    $('#borderRadius').on('input', function() {
        borderRadius = $(this).val();
        $(".box").css("border-radius", borderRadius + "%");
        setOutput();
    });
    $('#width').on('input', function() {
        width = $(this).val();
        $(".box").css("width", width + "px");
        setOutput();
    });
    $('#height').on('input', function() {
        height = $(this).val();
        $(".box").css("height", height + "px");
        setOutput();
    });

    function setOutput() {
        output = "box-shadow: " + x + "px " + y + "px " + blur + "px #111;" +
            "\nborder-radius: " + borderRadius + "%;" +
            "\nheight: " + height + "px;" +
            "\nwidth: " + width + "px;";
        $("#output").val(output);
    }
</script>
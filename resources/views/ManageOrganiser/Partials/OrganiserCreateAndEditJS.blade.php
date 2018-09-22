{!! HTML::script('vendor/simplemde/dist/simplemde.min.js') !!}
{!! HTML::style('vendor/simplemde/dist/simplemde.min.css') !!}

<script>
$(function () {
    $('.colorpicker').minicolors({
        changeDelay: 500,
        change: function () {
            var replaced = replaceUrlParam('{{route('showOrganiserHome', ['organiser_id'=>$organiser->id])}}', 'preview_styles', encodeURIComponent($('#OrganiserPageDesign form').serialize()));
            document.getElementById('previewIframe').src = replaced;
        }
    });
});

$(document).ready(function(){
    var charge_tax = $("input[type=radio][name='charge_tax']:checked").val();
    if (charge_tax == 1) {
        $('#tax_fields').show();
    } else {
        $('#tax_fields').hide();
    }

    $('input[type=radio][name=charge_tax]').change(function() {
        if (this.value == 1) {
            $('#tax_fields').show();
        }
        else {
            $('#tax_fields').hide();
        }
    });

    $('.editable').each(function() {
        var simplemde = new SimpleMDE({
            element: this,
            spellChecker: false,
            status: false
        });
        simplemde.render();
    })
});
</script>
<style>
    .editor-toolbar {
        border-radius: 0 !important;
    }
    .CodeMirror, .CodeMirror-scroll {
        min-height: 100px !important;
    }
</style>

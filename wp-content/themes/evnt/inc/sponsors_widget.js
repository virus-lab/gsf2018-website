jQuery(document).ready(function ($) {

    $(".sponsor-widget-color-picker").wpColorPicker();

    var src = $(".evnt-button-attribute .hide_it .uploaded_img ");
    $(".evnt-button-attribute .hide_it ").each(function () {
        if ($('#' + this.id + ' .uploaded_img ').attr('src') !== '') {
            $(this).removeClass("hide_it")

        }
    });

    var file_frame;
    var widid;
    var widname;
    var show_next_btn;

    $(document).on("click", '.evnt_upload_image', function (e) {
        e.preventDefault();

        widid = $(this).data('widid');
        widname = $(this).data('widname');
        show_next_btn = $(this).data('show_next_btn');

        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select or upload image :)',
            library: {// remove these to show all
                type: 'image' // specific mime
            },
            button: {
                text: 'Select'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        file_frame.on('select', function () {
            var attachment = file_frame.state().get('selection').first().toJSON();
            $("img." + widid + "" + widname).attr('src', attachment.url);
            $(".sponsor-image_" + widid + widname).removeClass("hide_it");
            $("input." + widid + "" + widname).val(attachment.url);
            $("div." + widid + "" + widname).removeClass("hide_it");
            $("div." + widid + "" + widname).removeClass("show_it");
            $(".evnt_addmore").attr("data-nextbtn", show_next_btn);
        });

        file_frame.open();

    });

    $(document).on("click", '.evnt_addmore', function (e) {

        var widid = $(this).attr("data-widid");
        var widname = $(this).attr("data-nextbtn");
        $("div.upload_file_" + widid + "" + widname).removeClass("hide_it");
        $("div.upload_file_" + widid + "" + widname).addClass("show_it");
        $("div." + widid + "" + widname).removeClass("hide_it");
        $("div." + widid + "" + widname).addClass("show_it");
    });

    $(document).on('click', ".delete", function () {
        var delete_field = $(this).attr("data-val");
//        $("div.upload_btn-" + delete_field).addClass("hide_it");
        $(".sponsor-image_" + widid + widname).addClass("hide_it");
        $("img." + delete_field).attr("src", "");
        $("input." + delete_field).val("");

    });

});

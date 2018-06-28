$(document).ready(function () {
    $('#hp_save_btn').click(function (e) {
        $('#hp_changed_load_img').show();
        $.ajax({
            url: $('#hp_changed_url').val(),
            context: document.body,
            data: {hp: $('#current_hp').val()},
            dateType: 'json'
        }).done(function (data) {
            $('#hp_changed_load_img').hide();
            $('#hp_changed_ok_img').show();
            setTimeout(function () {
                $('#hp_changed_ok_img').hide();
            }, 500);
        });
    });

    $('.btn_spell_point_use').click(function (e) {
        var _this = $(this);
        var level = $(this).data('level');
        $.ajax({
            url: $('#spell_use_url').val(),
            context: document.body,
            data: {level: level},
            dateType: 'json'
        }).done(function (data) {
            data = JSON.parse(data);
            if (data.code == 200)
                $('#spell-point-used-level-' + level + '-counter').html(data.used);
        });
    });
    $('.btn_spell_point_rest').click(function (e) {
        $.ajax({
            url: $('#spell_rest_url').val(),
            context: document.body,
            data: {},
            dateType: 'json'
        }).done(function (data) {
            window.location.reload();
        });
    });
    $('.use_talent_btn').click(function (e) {
        var talent_id = $(this).data('talent');
        $.ajax({
            url: $('#use_talent_url').val(),
            context: document.body,
            data: {talent_id: talent_id},
            dateType: 'json'
        }).done(function (data) {
            window.location.reload();
        });
    });
    $('.rest_talent_btn').click(function (e) {
        var talent_id = $(this).data('talent');
        $.ajax({
            url: $('#rest_talent_url').val(),
            context: document.body,
            data: {talent_id: talent_id},
            dateType: 'json'
        }).done(function (data) {
            window.location.reload();
        });
    });
});
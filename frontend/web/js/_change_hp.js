var alertMsg = function (text, type) {
    if (typeof(type) == 'undefined')
        type = 0;
    if (type == 1) type = 'info';
    if (type == 0) type = 'success';
    if (type == 2) type = 'warning';
    if (type == 3) type = 'danger';
    var msg = $('#msg_container').find('.alert');
    var msg = $("<div></div>").addClass('alert alert-' + type + ' right-msg').text(text).hide();
    msg.append('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
    $('#msg_container').prepend($(msg));
    $(msg).fadeIn(1000);
    setTimeout(function () {
        $(msg).fadeOut(1500);
    }, 1500);

};
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
var _change_hp = function (data) {
    if (data.character_id == $('#current_hit_points').data('character-id')) {
        $('#damageModal').modal('hide');
        $('#change_hp_input').val(0);
        alertMsg('Здоровье изменено', 1);
        $('#current_hit_points').text(data.hp);
    }
};
$(document).ready(function () {
    /*on modal show focus field*/
    /*on enter in this field send request*/
    $('#damageModal').on('shown.bs.modal', function () {
        $("#change_hp_input").focus();
        $('#change_hp_input').select();
    });
    $('#change_hp_input').keypress(function (event) {
        if (event.which == 13) {
            event.preventDefault();
            change_hp();
        }
    });
    $(document).ajaxError(function (event, jqxhr, settings, thrownError) {
        $('#damageModal').modal('hide');
        alertMsg('Error', 3);
    });

    var change_hp = function () {
        var change_hp_url = $('#hp_changed_url').val();
        $.ajax({
            url: change_hp_url,
            context: document.body,
            data: {hp: $('#change_hp_input').val()},
            dateType: 'json'
        }).done(function (data) {
            data = JSON.parse(data);
            if (data.status.code == 200) {
                $('#damageModal').modal('hide');
                $('#change_hp_input').val(0);
                alertMsg('Сохранено', 1);
                $('#current_hit_points').text(data.data.hp);
                socket.send(JSON.stringify({
                    method: 'change_hp',
                    character_id: data.data.character_id,
                    new_hp: data.data.hp
                }));
            } else {
                $('#damageModal').modal('hide');
                $('#change_hp_input').val(0);
                alertMsg('Error while saving', 3);
            }
        })
    };
    $(document).on("click", ".btn_spell_point_use", function () {
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
                $('.spell-point-used-level-' + level).html(data.exist);
        });
    });
    $('#btn_change').click(function (e) {
        change_hp();
    });
    $(document).on("click", "#use_talent_btn", function () {
        var to_use = 1;
        var talent_id = $(this).data('talent-id');
        if ($(this).data('scalable') == 1) {
            to_use = $('#talent_' + talent_id + '_use_count_input').val();
        }
        $.ajax({
            url: $('#use_talent_url').val(),
            context: document.body,
            data: {talent_id: talent_id, to_use: to_use},
            dateType: 'json'
        }).done(function (data) {
            data = JSON.parse(data);
            if (data.status.code == 200) {
                alertMsg('Использованно', 1);
                $('#talent_' + talent_id + '_use_left').text(data.data.left);
            } else {
                alertMsg(data.status.text, 3);
            }
        });
    })
});
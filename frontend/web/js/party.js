
var _change_hp = function (data) {
    $('#character_' + data.character_id + '_hit_points_value').text(data.hp);
    $('#character_' + data.character_id + '_hit_points_progress_value').attr('aria-valuenow', data.hp);
    $('#character_' + data.character_id + '_hit_points_progress_value').css('width', data.percHp + '%');
    $('#character_' + data.character_id + '_hit_points_progress_value').className = 'progress-bar progress-bar-' + data.hpStatusText;
};
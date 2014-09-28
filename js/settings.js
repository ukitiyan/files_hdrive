/**
 * ownCloud - Files H-Drive
 *
 * @copyright 2014 Begood Technology Corp. <owncloud@begood-tech.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */
(function(){

function updateStatus(statusEl, result){
	statusEl.removeClass('success error loading-small');
	if (result && result.status == 'success' && result.data.message) {
		statusEl.addClass('success');
		return true;
	} else {
		statusEl.addClass('error');
		return false;
	}
}

OC.HdriveConfig={
	save:function(tr, callback) {
		var statusSpan = $(tr).closest('tr').find('.status span');

		var mountpoint = $(tr).find('.mountpoint input').val();
		var host = $(tr).find('.host input').val();
		var share = $(tr).find('.share input').val();
		var group = [];
		var multiselect = $(tr).find('.chzn-select').val();
		if (multiselect == null) {
			return false;
		}
		statusSpan.addClass('loading-small').removeClass('error success');
		$.each(multiselect, function(index, value) {
			var pos = value.indexOf('(group)');
			var applicable = value.substr(0, pos);
			group.push(applicable);
		});
		$.ajax({type: 'POST',
			url: OC.filePath('files_hdrive', 'ajax', 'save.php'),
			data: {
				mountpoint: mountpoint,
				host: host,
				share: share,
				group: group.join(',')
			},
			success: function(result) {
				$(tr).find('.mountPoint input').data('mountpoint', mountpoint);
				status = updateStatus(statusSpan, result);
				if (callback) {
					callback(status);
				}
				$(tr).find('.applicable').data('applicable-groups', groups);
			},
			error: function(result){
				status = updateStatus(statusSpan, result);
				if (callback) {
					callback(status);
				}
			}
		});
		return status;
	}
};


$(document).ready(function() {
	$('.chzn-select').chosen();

	$('#hdrive').on('paste', 'td', function() {
		var tr = $(this).parent();
		setTimeout(function() {
			OC.HdriveConfig.save(tr);
		}, 20);
	});

	var timer;

	$('#hdrive').on('keyup', 'td input', function() {
		clearTimeout(timer);
		var tr = $(this).parent().parent();
		if ($(this).val) {
			timer = setTimeout(function() {
				OC.HdriveConfig.save(tr);
			}, 2000);
		}
	});

	$('#hdrive').on('change', '.applicable .chzn-select', function() {
		OC.HdriveConfig.save($(this).parent().parent());
	});

});

})();

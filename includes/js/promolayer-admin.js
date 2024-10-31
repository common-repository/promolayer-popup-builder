(function ($) {
	'use strict';
	$(document).ready(function ($) {
		//Get message from child
		window.addEventListener("message", function(ev) {

			if (ev.data.message === "fromPromolayer" && promolayer_object.secret === ev.data.secret) {
				const data = {
					action: 'promolayer_connect',
					secret: ev.data.secret,
					userId: ev.data.userId,
					nonce: promolayer_object.nonce
				}

				$.ajax({
					type:'POST',
				  url:promolayer_object.ajaxurl,
					data:data,
					success: function (response) {
						if (response.status === 'success') {
							ev.source.close();
							location.reload();
						}else{
							alert('Failed to connect.')
						}
					},
					dataType: 'json'
				});
			}
		});


		$(".pl-button").on("click", function (e) {

			const connected = $(this).data('connected');

			if(connected === 'no'){
				const url = $(this).attr('href');
				e.preventDefault()
				openLoginWindow(url)
			}

			//setInterval(checkStatus, 10000);
		});

		$("#disconnectPromolayer").on("click", function (e) {
			disconnectPromolayer();
		});

		function checkStatus() {
			var data = {
				'action': 'promolayer_is_connected',
				'nonce': promolayer_object.nonce
			};
			$.post(promolayer_object.ajaxurl, data, function (response) {
				var response = JSON.parse(response)
				if (response.status === '1') {
					location.reload();
				}
			});
		}

		function disconnectPromolayer() {
			var data = {
				'action': 'promolayer_disconnect',
				'nonce': promolayer_object.nonce
			};
			$.post(promolayer_object.ajaxurl, data, function (response) {
				location.reload();
			});
		}

		function openLoginWindow(url) {
			const width = 800
			const height = 600
			const subx = (window.screen.availWidth - width) / 2;
			const suby = (window.screen.availHeight - height) / 2;
			const position = `top=${suby},left=${subx},width=${width},height=${height}`
			const subWindow = window.open(url, null, position)

		}
	});
})(jQuery);

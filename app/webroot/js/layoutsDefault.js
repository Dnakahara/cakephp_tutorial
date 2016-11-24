function addressSelected(){
	$('#address-input').val($("#address-select option:selected").text()); 
	$('#address-select').css('display','none');
	$('#address').css('display','block');
	$('#address-select-options').html('<option value="" selected="selected">Not Selected</option>');
}

$(function(){
	$('#address-select').change(addressSelected);

	$('#zipcode-form').submit(function(event) {
		// HTMLでの送信をキャンセル
		event.preventDefault();

		// 操作対象のフォーム要素を取得
		var $form = $(this);

		// 送信ボタンを取得
		// （後で使う: 二重送信を防止する。）
		var $button = $form.find('button');

		// 送信
		$.ajax({
			url: $form.attr('action'),
			type: $form.attr('method'),
			data: $form.serialize(),
			timeout: 10000,  // 単位はミリ秒
			dataType: 'json',
			
			// 送信前
			beforeSend: function(xhr, settings) {
			     // ボタンを無効化し、二重送信を防止
			     $button.attr('disabled', true);
			},
			// 応答後
			complete: function(xhr, textStatus) {
			     // ボタンを有効化し、再送信を許可
			     $button.attr('disabled', false);
			},
			// 通信成功時の処理
			success: function(result, textStatus, xhr) {
				if(result.length === 1){
					if(result[0]['Zipcode']['street'] === "以下に掲載がない場合"){
						result[0]['Zipcode']['street'] = "";
					}
					$('#address-input').val(result[0]['Zipcode']['pref']+result[0]['Zipcode']['city']+result[0]['Zipcode']['street']);
				}else if(result.length >= 2){
					var options = '<option value="" selected="selected">Not Selected</option>';
					for(var i = 0; i < result.length; ++i){
						if(result[i]['Zipcode']['street'] === "以下に掲載がない場合"){
							result[i]['Zipcode']['street'] = "";
						}
						var val = result[i]['Zipcode']['pref']+result[i]['Zipcode']['city']+ result[i]['Zipcode']['street'];
						options += '<option value="' + val + '">' + val + '</option>';
					}
					$('#address').css('display','none');
					$('#address-select-options').html(options);
					$('#address-select').css('display','block');
				}else{
					$('#address-input').val('該当する住所はありません');
					console.log('empty');
				}
			},
			// 通信失敗時の処理
			error: function(xhr, textStatus, error) {
				console.error('error');
			}
		});
	});
});

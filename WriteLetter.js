
$(function() {
  $('.imgdrag').draggable();
});

/* 模様画像をクリックしたら便せんのほうに画像を表示する */
$(function(){
	$('.imgsize').mousedown(function(){
		var i_src = $(this).attr('src');
		var i_id = $(this).attr('id');
		var i_name = $(this).attr('name');
//		$("<img id=d" + i_id + " src=" +i_src + " name=d" + i_name + " class='imgdrag' />").appendTo('#letter_area').draggable();
		$('#letter_area').append("<img id=d" + i_id + " src=" +i_src + " name=d" + i_name + " class='imgdrag' />");
		$('.imgdrag').draggable();
	});
});

/* 背景画像をクリックしたら便せんの背景をその画像に変更する */
$(function() {
	$('.bcgsize').mousedown(function(){
		var b_src = $(this).attr('src');
		$('.letter').css('background-image', 'url(' + b_src + ')');
	});
});

/* 決定ボタンを押したら，情報を送る */
$(function(){
	$('#lettersubmit').mousedown(function(){
		var html_doc = document.getElementById("letter_area");
		console.log(html_doc.innerHTML);	//HTML全体をconsoleに
		$.ajax ({
			type: 'POST',
			url: 'insert.php',
			cache: false,
			data: {body: $('#letter_area').html()},
			success: function(data, dataType){
				console.log(data);
				var res = JSON.parse(data);
				console.log(res[0].id);
				console.log('http://studio-app.sakura.ne.jp/IwateLetter/letter.php?id="' + res[0].id + '"');
				
				$('#url').append('<a href="http://studio-app.sakura.ne.jp/IwateLetter/letter.php?id=' + res[0].id + '">http://studio-app.sakura.ne.jp/IwateLetter/letter.php?id=' + res[0].id + '</a>').
				append('<br>このURLを送る相手のメール等に貼り付けてください');
			}, 
			error: function (XMLHttpRequest, textStatus, errorThrown){
				console.log("POST error");
			}
		});
		/*
		$.post(
			"insert.php",
			{
				body: $('#letter_area').html()
			},
		function(){
				alert("post completed.");
			}
		).done(	
			function(data, textStatus){
//				var res = JSON.parse(data);
//				console.log(data.id);
				console.log(data);
			}
		);
		*/
	});	
});

$(function(){
	$('#textsubmit').mousedown(function(){
		
		$("textarea").change( function() {
			var txtVal = $(this).val();
			txtVal = txtVal.replace(/\r\n/g, "</br>");
			txtVal = txtVal.replace(/(\n|\r)/g, "</br>");
			$('#div_letter').html('</br></br><p>'+ txtVal +'</p>');
		});
		
/*		var edit_t = document.getElementById("lettertext_e");
		edit_t = edit_t.value.replace(/\r\n/g, "<p/><p>");
		edit_t = edit_t.value.replace(/(\n|\r)/g, "<p/><p>");
		var letter_t = document.getElementById("div_letter");
		letter_t.innerHTML = "<br><p>" + edit_t.value + "</p>";	//編集した手紙本文をデザインした便せんの方に反映
//		var letter_t = document.getElementById("html_doc");
//		console.log(letter_t.innerHTML);
/*		$.post(
			' 送信先URL ',
			{
				 送信データを書く 
			},
			function(){
				alert("post completed.");
				
			}
		);
*/
		
		$("#overlay").fadeOut();
	});	
});

$(function() {
     $("#b_1").click(function() {
           $("#overlay").fadeIn();
 });
 	$("#backletter").click(function(){
 		$("#overlay").fadeOut();
 	});
});

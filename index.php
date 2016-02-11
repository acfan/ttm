<html>
	<head>
		<script type="text/javascript" src="js/jquery.js"></script>
		<meta charset="utf-8">
		<style type="text/css">

			div{
				position: absolute;
				top: 100px;
				left: 220px;


			}
			h1{
				position: absolute;
				left: 300px;
				white-space: nowrap;

			}
			form{
				top: 80;
				position: absolute;
				left: 180px;
				white-space: nowrap;
			}
			img{
				position: absolute;
				top: 120px;
				height:500px; 
			}
			textarea{
				position: absolute;
				white-space: nowrap;
				top: 650px;
				left: 10px;


			}
			input,submit,textarea{
				font-size: 23px;
			}
			#hi{
				position: absolute;
				top: 800px;
			}

		</style>
		<title>
			种子转换
		</title>
	</head>

	<?php

		include 'BEncode.php';
		include 'BDecode.php';

		session_start();
		if (!isset($_SESSION["id"])) {
		
			$_SESSION["id"]=mt_rand(0,10000);
			
		}
		//echo $_SESSION["id"];

		$src="";
		$file=$_FILES["torrent"];
		//var_dump($file);
		move_uploaded_file($file["tmp_name"], "torrent/".$file["name"]);
		$name="torrent/".$file["name"];
		//echo $name;
		
		$an=md5_file($name);

		$torrent_content = file_get_contents($name);
		$desc = BDecode($torrent_content);
		$info = $desc['info'];
		$hash = strtoupper(sha1( BEncode($info) ));
		$src="magnet:?xt=urn:btih:".$hash;
		

		$zip=new ZipArchive();
		if ($zip->open($an.".zip",ZipArchive::OVERWRITE)===TRUE) {
		# code...
	
			$zip->addFile($name);

			$zip->close();
			$_SESSION["name"]=$an.".zip";
	
		}

		

	?>
	<body>
	<div>
		<h1> 种子转换为神秘代码</h1>
		<form action="" method="POST" enctype="multipart/form-data">
			<input type="file" name="torrent">
			<input type="submit" value="提交">


		</form>
		<img id="image" alt=<?php echo $src ?> src=image.php?magnet=<?php echo $src."&id=".$_SESSION["id"] ?>>
		<textarea cols=75 >磁力链接：<?php echo $src ?></textarea>
	</div>
	<div id="hi">
		<img src=<?php echo "image/".$an.".jpg" ?>>


	</div>
	
	</body>
	

	<script type="text/javascript">
		$(document).ready(function(){
			
			$(":file").change(function(){
				var fi=$(":file").val();
				var arr=fi.split(".");
				var ex=arr.pop();
				if(!ex.match(/torrent/i)){
					
				
					alert("请选择种子文件(文件名如xxx.torrrent)");
					$(":file").val("");
				}



			})
			
			if($("textarea").val()){
				$("#image").attr("src",$("#hi>img").attr("src"));
				

			}
			$("#hi").css("display","none");

			$(":submit").click(function(){


				
				


			})
			$(document).keypress(function(e){

				if(e.which==13){
					$("form").submit();
					
					
				}

			})



		})

	</script>	
</html>
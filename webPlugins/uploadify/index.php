<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UploadiFive Test</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="uploadify.css">
<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
</style>
</head>

<body>
	<h1>Uploadify Demo</h1>
	<form>
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
		<div class="imgmsg"></div>
	</form>

	<script type="text/javascript">
		/*进行文章内嵌图片的上传*/
        function uploadify(){
            $('#lessonInImg').uploadify({
                'multi': false,
                'buttonText': '<span style="font-size:14px;line-height:23px;display:block;">上传图片</span>',
                'formData': {'name':'jack','_token':'okkk'},
                'swf'      : 'uploadify.php',
                'onUploadSuccess' : function(file, data, response) {
                    $('.imgmsg').html(data);
                }
            });
        }
        uploadify();
	</script>
</body>
</html>
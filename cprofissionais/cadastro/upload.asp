<%@LANGUAGE="VBSCRIPT" CODEPAGE="65001"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<%
	Dim objUpload
	Set objUpload = Server.CreateObject("Dundas.Upload.2")
	 
	objUpload.MaxFileSize = 150000
	objUpload.UseVirtualDir = True
	objUpload.UseUniqueNames = False
	 
	objUpload.Save "../imagens/profissionais/"
	 
	Set objUpload = Nothing
	 
	Response.Write "Upload efetuado com sucesso"
%>
</body>
</html>

  <html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>     




<body>
    
 
    
    
    
    <form id="TheForm" method="post" action="test.asp" target="TheWindow">
<input type="hidden" name="something" value="something" />
<input type="hidden" name="more" value="something" />
<input type="hidden" name="other" value="something" />
</form>

<script type="text/javascript">
window.open('', 'TheWindow');
document.getElementById('TheForm').submit();
</script>
    
    
    
    
</body>
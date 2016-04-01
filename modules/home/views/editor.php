<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>editor</title>
</head>
<body>
<h1>BBCode Editor</h1>
<div>
    <a href="javascript:void(0)" onclick='$("textarea").insertAtCursor("<br />");'><?php echo $this->e('br'); ?></a>
    <a href="javascript:void(0)" onclick='$("textarea").insertAroundCursor("<p>","</p>");'><?php echo $this->e('p'); ?></a>
    <a href="javascript:void(0)" onclick='$("textarea").insertAroundCursor("<img style=\"color:#fff;\" \nsrc=\"","\" />");'>test</a>
</div>
<textarea id="editor" rows=10 cols=50></textarea>
<script type="text/javascript" src="<?php echo $this->pathUrl('module.admin@assets/js/jquery-2.1.4.min.js'); ?>"></script>
<script>
jQuery.fn.extend({
	insertAtCursor: function(myValue) {
		return this.each(function(i) {
			if (document.selection) {
				this.focus();
				sel = document.selection.createRange();
				sel.text = myValue;
				this.focus();
			}
			else if (this.selectionStart || this.selectionStart == "0") {
				var startPos = this.selectionStart;
				var endPos = this.selectionEnd;
				var scrollTop = this.scrollTop;
				this.value = this.value.substring(0,startPos) + myValue + this.value.substring(endPos,this.value.length);
				this.focus();
				this.selectionStart = startPos + myValue.length;
				this.selectionEnd = startPos + myValue.length;
				this.scrollTop = scrollTop;
			}
			else {
				this.value += myValue;
				this.focus();
			}
		});
	},
	insertAroundCursor: function(myValueBefore, myValueAfter) {
		return this.each(function(i) {
			if (document.selection) {
				this.focus();
				sel = document.selection.createRange();
				sel.text = myValueBefore + sel.text + myValueAfter;
				this.focus();
			}
			else if (this.selectionStart || this.selectionStart == "0") {
				var startPos = this.selectionStart;
				var endPos = this.selectionEnd;
				var scrollTop = this.scrollTop;
				this.value = this.value.substring(0,startPos) + myValueBefore + this.value.substring(startPos,endPos) + myValueAfter + this.value.substring(endPos,this.value.length);
				this.focus();
				this.selectionStart = startPos + myValueBefore.length;
				this.selectionEnd = endPos + myValueBefore.length;
				this.scrollTop = scrollTop;
			}
			else {
				this.value += myValueBefore + myValueAfter;
				this.focus();
			}
		});
	},
	selectRange: function(start, end) {
	    return this.each(function(i) {
	        if (this.setSelectionRange) {
	            this.focus();
	            this.setSelectionRange(start, end);
	        }
			else if (this.createTextRange) {
				var range = this.createTextRange();
				range.collapse(true);
				range.moveEnd('character', end);
				range.moveStart('character', start);
				range.select();
			}
	    });
	}
});
</script>
</body>
</html>
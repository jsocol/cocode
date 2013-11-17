/**
 * Highlights a row or rows of text.
 * @param row(s) int|string Either an integer row number or a range (ie: 5-10) as a string.
 */
function highlightRow (row)
{
	var limits = [];
	// if there is no indexOf method or no '-'
	if (!row.indexOf || -1 == row.indexOf('-')) {
		row = Number(row);
		limits = [row,row]; 
	} else {
		limits = row.split('-');
		limits[0] = Number(limits[0]);
		limits[1] = Number(limits[1]);
	}
	
	for (var i=limits[0]; i <= limits[1]; i++){
		if ( $('#geshi-line-'+i) ) {
			$('#geshi-line-'+i).toggleClass('highlight', true);
		}
	}
}

/**
 * Unhighlights all rows.
 */
function unHighlightRows()
{
	$('ol li').toggleClass('highlight', false);
}

// Get everything ready
$(document).ready(function(){
	$('span.line-number').mouseover(function(){
		highlightRow($(this).html());
	}).mouseout(unHighlightRows);
	$('textarea.tab').keypress(catchKeys);
});

/**
 * Replace the default tab behavior with inserting a tab.
 */
function catchKeys ( e )
{
	var event = e || window.event;
	var key = e.keyCode || e.which;
	// 9 is the keyCode for tab
	if(9 == key){
		if(event.ctrlKey||event.altKey)return;
		
		var field = event.target;
		
		// Only supports Firefox at the moment
		if(field.selectionStart || field.selectionStart == '0'){
			event.preventDefault();
			
			var start = field.selectionStart;
			var end = field.selectionEnd;
			
			if(start==end){
				// no selection, just insert a tab
				field.value = field.value.substring(0,start)+'\t'+field.value.substring(end);
				field.setSelectionRange(end+1,end+1);
			}else{
				// selection, try to indent the whole line
				var sstart = field.value.lastIndexOf('\n',start);
				var send = field.value.indexOf('\n',end);
				if(-1 == sstart) sstart = 0;
				if(-1 == send) send = field.value.length-1;
				var indented = field.value.substring(sstart,send);
				indented = indented.replace(/\n/g,'\n\t');
				if(0==sstart) var b = '\t'; else var b = '';
				field.value = b+field.value.substring(0,sstart)+indented+field.value.substring(send);
				var n = indented.split(/\n/).length;
				field.setSelectionRange((sstart==0)?0:sstart+1,(sstart==0)?send+n+1:send+n);
			}
		}
		
		return false;
	}
}
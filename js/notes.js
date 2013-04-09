/**
 * Author: Mohammad Saleh Nouri
 * Date: 16/01/13
 * Time: 13:09
 */


function deleteNote(event){
    if (confirm('Are sure you want to delete the note?')){
        $.post('includes/delNote.php', {pId:event}, function (output) {
            if (parseInt(output)==1){
                $('#'+'divNote' +event).remove();
            }      }, "text");

    }
}
function loadNotes(pId, px, py, pw, ph) {

    container = $('#container');
    divName = 'divNote' + pId;
    noteName = 'txtNote' + pId;

    $('<div>', {id:divName, class:'itemDiv'})
        .appendTo('#container')
        .draggable({ cursor:'move', containment:'#container', scroll:true,
            distance:20,
            handle:'.drag_handle',
            stop:function () {
                $(this).css('opacity', '1');
                //update possition
                var xPos = $(this).position().left;
                var yPos = $(this).position().top;
                UpdateNote(pId, 'move', xPos + ', ' + yPos)
            },
            start:function () {
                $(this).css('opacity', '.6');
            }
        })
        .width(pw)
        .height(ph)
        .css({
            position:"absolute",
            left:px + "px",
            top:py + "px"
        })
        .resizable({
            alsoResize:noteName


        })
        .resizable({
            stop:function () {
                UpdateNote(pId, 'size', ($(this).width()) + ', ' + ($(this).height()));
                },
            resize: function(){
                $(this).children('.drag_handle').width($(this).width()+40);
            }
        });
    var Tools = '<img src="images/move2red.png" width="30" height="30" style="float:left" /><a href="#" onclick="deleteNote('+pId+');return false;"><img src="images/close.png" width="30" height="30" style="float:right;cursor:hand;" /></a><div class="menu">' +
        '<a  href="#" class="options" onclick="bold();"><b>B</b></a>' +
        '<a  href="#" class="options" onclick="italic();"><b><i>I</i></b></a>'+
        '<a  href="#" class="options" onclick="underline();"><b><u>U</u></b></a>' +
        '</div>';
    $('<div>', {class:'drag_handle' })
        .appendTo('#' + divName)
        .width((pw+40))
        .append (Tools);
        /*.mouseover(function(){
            $(this).addClass('showhandle');
        })
        .mouseleave(function(){
            $(this).removeClass('showhandle');
        })*/;
    $('<div>', {id:noteName, class:'item' })
        .appendTo('#' + divName)
        .attr('contenteditable', true)
        .click(function () {

            var div = $(this).parent().children('.drag_handle');
            div.addClass('showhandle');

                $(this).focus();
        })
        .focusout(function () {
            var div = $(this).parent().children('.drag_handle');
            div.removeClass('showhandle');
            UpdateNote(pId, 'edit', $(this).html());

        });
    $.ajaxSetup({async:false});
    $.post('includes/loadNotes.php', {noteId:pId}, function (data) {
        $('#' + noteName).append(data);
        return true;
    }, 'text');


}
function addNote() {
    container = $('#container');
    var pId;
    //insert to db
    $.post('includes/newNote.php', {userId:userId}, function (output) {
        pId = parseInt(output);
        if (pId <= 0) {
            return false;
        }
        loadNotes(pId, 300, 100, 150, 200);

    }, "text");


    return false
}
function UpdateNote(id, option, param) {

    $.post('includes/updateNote.php', {id:id, option:option, param:param}, function (output) {
    });


}
/**
 * Created with JetBrains PhpStorm.
 * Author: Mohammad Saleh Nouri
 * Date: 12/01/13
 * Time: 22:19
 */

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
                UpdateNote(pId, 'size', ($(this).width()) + ', ' + ($(this).height()))
            }
        });
    $('<div>', {class:'drag_handle' })
        .appendTo('#' + divName)
    $('<div>', {id:noteName, class:'item' })
        .appendTo('#' + divName)
        .attr('contenteditable', true)
        .click(function () {
            $(this).focus();
        })
        .focusout(function () {
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


    }, "text");

    if (pId <= 0) {
        return false;
    }
    loadNotes(pId, 300, 100, 150, 200);
    return false
}
function UpdateNote(id, option, param) {

    $.post('includes/updateNote.php', {id:id, option:option, param:param}, function (output) {
    });


}
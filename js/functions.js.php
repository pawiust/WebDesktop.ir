<?php
/**
 * Author: Mohammad Saleh Nouri
 * Date: 13/01/13
 * Time: 15:11
 */
session_start();
include '../includes/database.inc.php';
if (false){
    exit;
}

?>
/**
* Created with JetBrains PhpStorm.
* Author: Mohammad Saleh Nouri
* Date: 12/01/13
* Time: 22:19
*/

function noteInit(){
<?php
$db= Database::getInstance();
$query ="select * from tbl_notes where user =" .$_SESSION['id'];
echo '//' .$query;
$result = $db->get_query($query);

while ($row = mysql_fetch_assoc($result)){

    echo "loadNotes(".$row['id'].", ".$row['x'].", ". $row['y'].", ". $row['w'].", ". $row['h'].");";

}
?>
}

function loadNotes(pId, px, py, pw, ph){

container =  $('#container');



divName = 'divNote' + pId;

noteName= 'txtNote' + pId;

$('<div>', {id:divName, class:'itemDiv'})

    //.offset({left:px ,top:py})
    .appendTo('#container')

    .resizable({
    alsoResize: noteName
    })
    .draggable({ cursor:'move', containment:'#container', scroll:true,
    distance:20,
    stop:function () {
    $(this).css('background', '#ffaf0f');
    //update possition

    var xPos = $(this).position().left;
    var yPos = $(this).position().top;
    UpdateNote(pId ,'move',xPos + ', ' +yPos  )
    },
    start:function () {
    $(this).css('background', 'red');
    }
    })
    .width(pw)
    .height(ph)
    .css({
    position: "absolute",
    left: px + "px",
    top:py  + "px"
    })
    .resizable({
    stop: function (){
    UpdateNote(pId ,'size',($(this).width()) + ', ' +($(this).height())  )
    }
    });

    $('<textarea>', {id:noteName,class:'item' } )
        .appendTo('#'+divName)
        .css('background', '#ffaf0f')
        .focusin(function() {
        $(this).css('background','rgba(255,255,255,.5)');
        })
        .focusout(function(){

        UpdateNote(pId,'edit',$(this).val());
        $(this).css('background','none');

        });
        $.ajaxSetup({async: false});
        $.post ('includes/loadNotes.php',{noteId:pId}, function(data){
        $('#'+ noteName).val(data);
        return true;
        },'text');



        }
        function addNote(){
        container =  $('#container');
        var pId;
        //insert to db
        $.post('includes/newNote.php',{userId:userId},function(output){
        pId = parseInt(output);


        },"text");

        if (pId <=0) {
        return false ;
        }
        divName = 'divNote' + pId;
        noteName= 'txtNote' + pId;

        $('<div>', {id:divName, class:'itemDiv'})

            //.offset({left:px ,top:py})
            .appendTo('#container')

            .resizable({
            alsoResize: noteName
            })
            .draggable({ cursor:'move', containment:'#container', scroll:true,
            distance:20,
            stop:function () {
            $(this).css('background', '#ffaf0f');
            //update possition

            var xPos = $(this).position().left;
            var yPos = $(this).position().top;
            UpdateNote(pId ,'move',xPos + ', ' +yPos  )
            },
            start:function () {
            $(this).css('background', 'red');
            }
            })
            .width(150)
            .height(200)
            .css({
            position: "absolute",
            left:  "300px",
            top: "100px"
            })
            .resizable({
            stop: function (){
            UpdateNote(pId ,'size',($(this).width()) + ', ' +($(this).height())  )
            }
            });

            $('<textarea>', {id:noteName,class:'item' } )
                .appendTo('#'+divName)
                .css('background', '#ffaf0f')
                .focusin(function() {
                $(this).css('background','rgba(255,255,255,.5)');
                })
                .focusout(function(){

                UpdateNote(pId,'edit',$(this).val());
                $(this).css('background','none');

                })
                .focus();

                return false
                }
                function UpdateNote(id, option, param) {

                $.post('includes/updateNote.php',{id:id, option:option, param:param},function(output){
                });
                }





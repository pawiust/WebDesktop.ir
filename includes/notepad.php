<?php
/**
 * Author: Mohammad Saleh Nouri
 * Date: 19/01/13
 * Time: 22:50
 */
?>
<style>
    body{

        margin: 0;

    }
    #notecontainer{

        margin: 0;

        width: 700px;
    height: 500px;;
    background: #e9a230;
        -moz-border-radius: 20px; /* for Firefox */
        -webkit-border-radius: 20px; /* for Webkit-Browsers */
        border-radius: 10px; /* regular */
    }
    #listarea{
     width: 199px;
        float: left;
    }
    #padarea{
        position:absolute;
        left: 200px;
        width: 500px;
        top:-8px;
    }
    #top{
             background: url(../images/notepad/notepad_01.png) no-repeat;
             width: 500px;
             height: 61px;
         }
    #left{
        background: url(../images/notepad/notepad_02.png) no-repeat;
        width: 20px;
        height: 449px;
        float: left;
    }
    #mid{
        background: url(../images/notepad/notepad_03.png) no-repeat;
        width: 459px;
        height: 449px;
        float: left;
        overflow-y: scroll;
    }
    #right{
        background: url(../images/notepad/notepad_04.png) no-repeat;
        width: 21px;
        height: 449px;
        float: left;
    }
    #editarea{
        font-size: 18px;

    }
</style>
<body>
<div id="notecontainer">
<div id="listarea">

</div>
<div id="padarea">

   <div id="top"></div>
    <div id="left" ></div>
    <div id="mid" >
        <div id="editarea" contenteditable="true">Hello</div>
    </div>
    <div id="right" ></div>

</div>
</div>
</body>
</html>
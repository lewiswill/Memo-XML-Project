<?php

if (isset($_POST["submit"])) {

    $file = "memo.xml";
    $fp = fopen($file, "rb") or die("Error - cannot open XML file");
    // "rb" file mode ensures the XML is read in binary mode
    $str = fread($fp, filesize($file));
    
    $xml = new DOMDocument();
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;
    $xml->loadXML($str) or die("Error - cannot load XML data");

    // getting document element
    $root= $xml->documentElement;
    $nextIDNode=$root->childNodes->item(0); //next ID INCRECMENT
    $memos= $root->childNodes->item(1);

    // find first memo element
    $firstMemo=$memos->childNodes->item(0);
   
    // get values for new memo element
    $newID=(int)$root->childNodes->item(0)->nodeValue++; //next ID INCRECMENT
    $newTitle=$_POST["title"];
    $newSender=$_POST["sender"];
    $newrecipients=$_POST["recipients"];
    $newDate=$_POST["date"];
    $newMessage=$_POST["message"];
    $newUrl=$_POST["url"];

    // create the title element
    $titleNode=$xml->createElement("title");
    $titleTextNode=$xml->createTextNode("$newTitle");
    $titleNode->appendChild($titleTextNode);

    // create the sender element
    $senderNode=$xml->createElement("sender");
    $senderTextNode=$xml->createTextNode("$newSender");
    $senderNode->appendChild($senderTextNode);

    // create the recipients element
    $recipientsNode=$xml->createElement("recipients");
    $recipientsTextNode=$xml->createTextNode("$newrecipients");
    $recipientsNode->appendChild($recipientsTextNode);

    // create the date element
    $dateNode=$xml->createElement("date");
    $dateTextNode=$xml->createTextNode("$newDate");
    $dateNode->appendChild($dateTextNode);

    // create the message element
    $messageNode=$xml->createElement("message");
    $messageTextNode=$xml->createTextNode("$newMessage");
    $messageNode->appendChild($messageTextNode);

    // create the url element
    $urlNode=$xml->createElement("url");
    $urlTextNode=$xml->createTextNode("$newUrl");
    $urlNode->appendChild($urlTextNode);

    // create the new memo
    $newMemoNode=$xml->createElement("memo");
    $newMemoNode->setAttribute("id",$newID); //next ID INCRECMENT
    $newMemoNode->appendChild($titleNode);
    $newMemoNode->appendChild($senderNode);
    $newMemoNode->appendChild($recipientsNode);
    $newMemoNode->appendChild($dateNode);
    $newMemoNode->appendChild($messageNode);
    $newMemoNode->appendChild($urlNode);

    // adding the new memo to the data set
    $memos ->insertBefore($newMemoNode,$firstMemo);

   // output and save new XML file
   //echo "<xmp>NEW:\n". $xml->saveXML() ."</xmp>";
   $xml->save("memo.xml");

   // redirect back to main page
    echo "<script>
            alert('Memo was successfully added to the Memo Database!');
            window.location.href='memo.html';
          </script>";

} else {
    ?>
    <html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
    <link rel="stylesheet" href="memo.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src ="memoValidation.js"></script>
    <title>Add a new Memo</title>
    </head>
    <body>
    <!--NavBar Start-->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-center hidden-xs">
                    <li><a href="memo.html">View Memos</a></li>
                    <li><a href="addMemo.php">Add New Memo</a></li>
                </ul>
                </ul>
            </div>
        </div>
    </nav>  
    <!--NavBar End-->
    <div id="addMemoBackground">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="addMemoContent">
                    <h1>Add a new Memo</h1>
                    <hr>
                    <div class= "form-group">
                        <form name="addMemoForm" method="post" action="addMemo.php" onsubmit="return validateForm()">
                        Title: <input name="fTitle" type="text" class="form-control" name="title" placeholder="Enter the title of your Memo" id="idTitle"><span id="idTitle"></span><br>
                        Sender: <input name="fSender" type="text" class="form-control" name="sender" placeholder="Enter your name"><span id="idSender"></span><br>
                        Recipients: <input name="fRecipients" type="text" class="form-control" name="recipients" placeholder="Enter recipients, separate by Comma (,)"><br>
                        Date: <input name="fDate" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" type="date" class="form-control" name="date" placeholder="Please enter date (YYYY-MM-DD)"><br>
                        Message: <textarea name="fMessage" type="text" rows="4" class="form-control" name="message" placeholder="Enter your message here"></textarea><br>
                        Additional Reading: <input name="fUrl" type="text" class="form-control" name="url" placeholder="enter URL here"><br>
                        <hr>
                        <input type="submit" name="submit" value="Add Memo">
                        </form>
                    </div>  
                </div>
            </div>
        </div>
    </div>    
</div>


    <!-- JQuery used by Boostrap / Navbar-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvy-xsfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
    </html>
    <?php
}
?>
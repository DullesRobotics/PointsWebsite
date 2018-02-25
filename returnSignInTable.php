<?php
   require("secretSettings.php");
   /*
   function getIDurl($stringID){
        if (strlen($stringID) >= 6 && strlen($stringID) <= 10){
        return "https://skystorage.iscorp.com/pictures/tx/fortbend//0".$stringID.".JPG";
        }
        elseif (strlen($stringID) >= 0 && strlen($stringID) < 6) {
        return "http://iamattila.com/wp-content/uploads/2014/09/Spy1.png";
        } else {
        return NULL;
        }
   }
   */
   /*
   function getIdImageHTMLwithDim($StringId,$w,$h){
     $url = getIDurl($StringId) ?: $StringId;
       return "<img src=". $url . " height=" . $h . " width =" .$w.">";
   }
   */

   try
   {
      $conn = new PDO("mysql:host=$SERVERNAME;dbname=$DBNAME", $USERNAME, $PASSWORD);
      echo "Connected to database";
   }
   catch (PDOException $e) {
       echo "Failed to connect to database";
       exit;
   }

   $getMembers = $conn->prepare("SELECT * FROM Student_Info ORDER BY Last_Scan_Time DESC");
   //$getMembers = $conn->prepare("SELECT * FROM Members ORDER BY Average DESC");
   //echo "Got Table Members";
   $getMembers->execute();
   //echo "Executed";
   $data = $getMembers->fetchAll();
   //echo "Fetched";
   //border-collapse:collapse;
       ?>
       <style type="text/css">
     .tg  .spacer{border-right: none; border-left: none; opacity: 0;}
           .tg  {border-spacing:0;border-color:#aabcfe;margin:0px auto;}
           .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#669;background-color:#e8edff;}
           .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#039;background-color:#b9c9fe;}
           .tg .tg-fity{font-size:36px;font-family:"Arial Black", Gadget, sans-serif;;color:#000000;text-align:center;vertical-align:top}
           .tg .tg-7ttm{font-size:36px;text-align:center}
           .tg .tg-7ttj{font-size:36px;text-align:center}
           .tg .tg-qj3h{font-size:36px;text-align:center;vertical-align:top}
           .tg .tg-5ofl{font-size:36px;font-family:"Arial Black", Gadget, sans-serif;;color:#000000;text-align:center}
           .tg .tg-5ofk{font-size:20px;font-family:"Arial Black", Gadget, sans-serif;;background-color:#b1c2ff;color:#000000;text-align:center;vertical-align:top}
           .tg .tg-w08d{background-color:#D2E4FC;font-size:36px;text-align:center;vertical-align:top}
           .tg .tg-c3ly{background-color:#D2E4FC;font-size:36px;text-align:center}
           .tg .tg-c3lz{background-color:#D2E4FC;font-size:36px;text-align:center}
           @media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;}}
       </style>
       <table class="tg">
         <tr>
           <!--<th class="tg-5ofl">Position</th>-->
           <!--<th class="tg-5ofl"> </th>-->
           <th class="tg-5ofl">Name</th>
           <th class="tg-5ofl">Status</th>
         </tr>
           <?php
           $indexOn = 1;



           function isOfficer($firstName,$lastName){
               $officers = array('Karim Karim','Kenneth Mitra','Austin Joseph');
               //echo var_dump($officers);
               /*
               foreach ($officers as $current){
                   //echo "Current: ".$current."\n";
                   list($first,$last) = split(' ',$current);
                   //echo "First: ".$first."\n";
                   //echo "Last: ".$last."\n";
                   if ($first == $firstName && $last == $lastName) {
                       return true;
                   }
               }
               */
               return false;
           }
          $totalSignedIn = 0;
           foreach($data as $person){
             $totalSignedIn = $totalSignedIn + ($person['Signed_In']%2);
               echo "<tr>";
               /*if (strlen($person['Custom_Image']) > 0){
                   $imgHTML = "<img src=". $person['Custom_Image'] . " height=" . "57" . " width =" ."76".">";
               }else{
                   $imgHTML = getIdImageHTMLwithDim($person['Student_ID'], "57", "76");
               } */
      // $imgHTML = getIdImageHTMLwithDim($person['Student_ID'], "57", "76");
     if ($indexOn % 2 == 0){
         if ($indexOn == 2){

       //echo "<td class = \"tg-c3lz\"> <font color = \"#708090\">".$imgHTML." </font></td>";
       echo "<td class = \"tg-c3lz\"> <font color = \"#0066ff\">".$person['First_Name']." ".$person['Last_Name']." </font></td>";
         } else {
       if (isOfficer($person["First_Name"],$person["Last_Name"])){
           //echo "<td class = \"tg-c3ly\"> <font color = \"#000000\"> Officer</font></td>";
       } else {
           //echo "<td class = \"tg-c3ly\"> <font color = \"#000000\">".$indexOn." </font></td>";
       }
       //echo "<td class = \"tg-c3ly\"> <font color = \"#000000\">".$imgHTML." </font></td>";
       echo "<td class = \"tg-c3ly\"> <font color = \"#0066ff\">".$person['First_Name']." ".$person['Last_Name']." </font></td>";
         }
         if ($person['Signed_In']%2 == 0){
       echo "<td class = \"tg-c3ly\"> <font color = \"red\"> Signed Out </font> </td>";
         } else {
       echo "<td class = \"tg-c3ly\"> <font color = \"green\"> Signed In </font> </td>";
         }

     } else {
         if ($indexOn == 1){

       //echo "<td class = \"tg-7ttj\"> <font color = \" #FFD700\">".$imgHTML." </font></td>";
       echo "<td class = \"tg-7ttj\"> <font color = \" #0066ff\">".$person['First_Name']." ".$person['Last_Name']." </font></td>";
         } elseif ($indexOn == 3){
       if (isOfficer($person["First_Name"],$person["Last_Name"])){
           //echo "<td class = \"tg-7ttj\"> <font color = \"#8B4513\"> Officer </font></td>";
       } else {
         if ($person["Tag_ID"] != "spacer"){
           //echo "<td class = \"tg-7ttj\"> <font color = \"#8B4513\">".$indexOn." </font></td>";
         } else {
           echo "<td class = \"tg-7ttj\"> <font color = \"#0066ff\">  </font></td>";
         }
       }
       //echo "<td class = \"tg-7ttj\"> <font color = \" #8B4513\">".$imgHTML." </font></td>";
       echo "<td class = \"tg-7ttj\"> <font color = \" #0066ff\">".$person['First_Name']." ".$person['Last_Name']." </font></td>";
         } else {
           if (isOfficer($person["First_Name"],$person["Last_Name"])){
             //echo "<td class = \"tg-7ttm\"> <font color = \"#000000\"> Officer </font></td>";
         } else {
             //echo "<td class = \"tg-7ttm\"> <font color = \"#000000\">".$indexOn." </font></td>";
         }

         //echo "<td class = \"tg-7ttm\"> <font color = \"#000000\">".$imgHTML." </font></td>";
         echo "<td class = \"tg-7ttm\"> <font color = \"#0066ff\">".$person['First_Name']." ".$person['Last_Name']." </font></td>";

           }
           if ($person['Signed_In']%2 == 0){
         echo "<td class = \"tg-7ttm\"> <font color = \"red\"> Signed Out </font> </td>";
           } else {
         echo "<td class = \"tg-7ttm\"> <font color = \"green\"> Signed In </font> </td>";
           }
     }

        echo "</tr>";
       if ($indexOn == -1){
         echo "<td class = \"spacer\" >  <font color = \"#0066ff\">  </font></td>";
       }
       //} else {
         //echo "<td class = \"spacer\" >  <font color = \"#000000\">  </font></td>";

         //echo "</br>";
         //echo "<h1> ----------- </h1>";
         //echo "<tr class=\"spacer\"><td></td></tr>";
       //}

               $indexOn++;
           }
           echo "<tr>";
          // echo "<td class = \"tg-7ttm\"> </td>";
           echo "<td class = \"tg-7ttm\"> <font color = \"#000000\">"."Num Signed In" ."</font></td>";
           //echo "<td class = \"tg-7ttm\"> <font color = \"#000000\">".""." </font></td>";
           //echo "<td class = \"tg-7ttm\"> <font color = \"#000000\">".""." </font></td>";
           echo "<td class = \"tg-7ttm\"> <font color = \"#000000\">".$totalSignedIn." </font></td>";
           echo "</tr>";
           ?>
       </table>

 <?php

 $ch = curl_init(); 
 curl_setopt($ch, CURLOPT_URL, "http://ezlatemart.com/diamond/showAllUsers.php"); 

 curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,20);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
 
 $output1 = curl_exec($ch); 
 echo $output1;

 curl_setopt($ch, CURLOPT_URL, "http://balkrrishna.com/localUsers.php"); 

 curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,20);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 


 $output2 = curl_exec($ch); 
 echo $output2;

 echo"------------------------------------------------------------------------------------------------------------------";
 curl_setopt($ch, CURLOPT_URL, "http://www.walterwhitewaltwhitman.com/jerryzheng/show_all_buyer.php"); 

 curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,20);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
 

 $output3 = curl_exec($ch); 
 echo $output3;

 curl_close($ch); 